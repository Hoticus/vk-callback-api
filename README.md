# Open source platform based on Symfony for working with VK callbacks
[![Release](https://img.shields.io/github/v/release/Hoticus/vk-callback-api?label=Release)](https://github.com/Hoticus/vk-callback-api/releases)
[![License](https://img.shields.io/github/license/Hoticus/vk-callback-api?label=License)](https://github.com/Hoticus/vk-callback-api/blob/dev/LICENSE)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Hoticus/vk-callback-api/badges/quality-score.png)](https://scrutinizer-ci.com/g/Hoticus/vk-callback-api)
## Configuration
All configuration variables below must be defined in ```.env.local```.
### Required
* ```VK_CONFIRMATION_TOKEN``` - String to be returned from a server to verify the server endpoint
* ```VK_GROUP_ID``` - Group ID
### Optional
* ```VK_SECRET_KEY``` - String that will verify that the callbacks have come from the VK server

Example of ```.env.local```:
```
VK_CONFIRMATION_TOKEN=7ghd812h
VK_GROUP_ID=22822305
VK_SECRET_KEY=27lrnNPEoDboLbxznEtSsQ36XLMBTsseVUFq1109aZQVaNzlFc
```
All information about these parameters can be found on [this page](https://vk.com/dev/callback_api).
## Adding new events
You can add events in ```src/Controller/APIController.php``` in the switch statement:
``` php
switch ($request_content['type']) {
    case 'confirmation':
        // ...
        break;
    case 'event_name':
        // something that will happen when this event happens
        break;
    default:
        // ...
        break;
}
```
All event names can be found on [this page](https://vk.com/dev/groups_events).
## What is next?
The whole world of [Symfony](https://symfony.com) development is open to you!
