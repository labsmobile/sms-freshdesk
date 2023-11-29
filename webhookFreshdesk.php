<?php 
//echo "Hello!! Webhook";
//The file_get_contents() function is used in order to obtain the endpoint data
$data = file_get_contents('php://input');
//A variable is assigned to store the object
$ticket = json_decode($data);
//print_r($ticket);

//Declare the variables that will be used in the body of the message.
$id = $ticket->id;                //<-- Variable responsible for storing the ticket ID
$status = $ticket->ticket_status; //<-- Variable responsible for storing the status of the ticket
$url = $ticket->public_url;       //<-- Variable responsible for storing the ticket url
$mobile = $ticket->mobile;        //<-- Variable in charge of storing the user's mobile phone
$leng = $ticket->ticket_type_leng;//<-- Variable in charge of storing the language

//Function in charge of validating the language of the ticket in order to send the message in the correct language
function &language_Body($status, $leng, $id, $mobile, $url){ 
  if ($leng === "Spanish") {
    $state = ["ABIERTO", "ESPERANDO RESPUESTA", "EN PROGRESO", "RESUELTO", "CERRADO" ];
    switch ($status) {
      case 'Open':
        $status_leng = $state[0];
        break;
      case 'Pending':
        $status_leng = $state[1];
        break;
      case 'Waiting':
        $status_leng = $state[1];
        break;
      case 'Resolved':
        $status_leng = $state[3];
        break;
      case 'Closed':
        $status_leng = $state[4];
        break;
    }
    $body = array(
      "message"=> "Hola, Hemos dado respuesta a tu ticket de soporte #{$id} con estado {$status_leng}. Consulta tu ticket aqui {$url}",
      "tpoa"=> "Sender",
      "recipient"=> array([
        "msisdn" => $mobile
      ])
    );
  }elseif ($leng === "English") {
    $state = ["OPENED", "WAITING ANSWER", "IN PROGRESS", "RESOLVED", "CLOSED" ];
    switch ($status) {
      case 'Open':
        $status_leng = $state[0];
        break;
      case 'Pending':
        $status_leng = $state[1];
        break;
      case 'Waiting':
        $status_leng = $state[1];
        break;
      case 'Resolved':
        $status_leng = $state[3];
        break;
      case 'Closed':
        $status_leng = $state[4];
        break;
    }
    $body = array(
      "message"=> "Hello, We have responded to your ticket #{$id} with {$status_leng} status. Check your ticket here {$url}",
      "tpoa"=> "Sender",
      "recipient"=> array([
        "msisdn" => $mobile
      ])
    );
  }
  return $body;
}

$body =& language_Body($status, $leng, $id, $mobile, $url);
print_r($body);

//The call will be made to the LabsMobile API for sending
$auth_basic = base64_encode("myusername:mytoken"); //<-- The user and password or user and token of the LasbsMobile account must be specified
$curl = curl_init();


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.labsmobile.com/json/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($body),
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic ".$auth_basic,
    "Cache-Control: no-cache",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>