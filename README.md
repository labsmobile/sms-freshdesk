<p align="center">
  <img src="https://avatars.githubusercontent.com/u/152215067?s=200&v=4" height="80">
</p>

# LabsMobile-Freshdesk

![](https://img.shields.io/badge/version-1.0.0-blue.svg)
 
Send SMS messages through the LabsMobile platform and the Freshdesk plugin. Configure your user to communicate the events you need to a script so you can send SMS notifications from Freshdesk.

## Documentation

Labsmobile API documentation can be found [here][apidocs].

## Features
  - SMS ticket status notifications

## Requirements

- A user in Freshdesk. More information in [freshdesk.com][freshdesk].
- A script that receives events from Freshdesk (Webhook) and communicates with the LabsMobile API. More information in [API SMS de LabsMobil][apidocs].
- A user account with LabsMobile. Click on the link to create an account [here][signUp].

## Installation

1. Download script, this script must be hosted in a web service and thus obtain a URL where it will be publicly accessible.

2. Create a new automation rule. Access the section Administration/Automations/Ticket Updates and click on New rule. You must indicate a rule name and finally Preview and save.

3. Configure the new rule when an Agent answers any ticket.

4. Add the webhook action with the POST method and entering the URL where the script from step 1 has been published. Finally it is necessary to configure the JSON format and the content with all the variables.

5. Generate an API token in the Security and passwords section of your LabsMobile account. This API token is the one that will be used as the password in the script credentials along with the username email.

6. Enable link shortening in the Preferences section of your LabsMobile account. In this way, any ticket link will be shortened to the minimum possible to optimize the characters present in the text of the SMS.

In this case, the LabsMobile API is used, in order to notify via SMS when any open ticket is answered or resolved. In this way, it is possible to send SMS with the current status of the ticket and a direct access to consult its content.

## Help

If you have questions, you can contact us through the support chat or through the support email support@labsmobile.com.

[apidocs]: https://apidocs.labsmobile.com/
[signUp]: https://www.labsmobile.com/en/signup
[freshdesk]: https://www.freshworks.com/freshdesk/