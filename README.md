# Trucky Webhook for Laravel >8.x

## Installation

`composer require trucky/webhook`

## Configuration

If you want to configure the Webhook listen URL, eject the config file with

`php artisan vendor:publish --provider=Trucky\Webhook\TruckyWebhookServiceProvider --tag=config`

## HTTP

The Webhook listens by default on `/trucky/webhook` for POST requests

## Webhook format

Every Webhook request has a `type` property denoting what is you receveiving in the `data` property

```json
{
    "type": "job_created"
    "data": {
        ....
    }
}
```

### Raw Event Types

- application_accepted
- application_created
- application_rejected
- application_retired
- garage_created
- garage_deleted
- garage_updgraded
- job_created
- job_cancelled
- job_completed
- job_deleted
- job_event_created
- member_kicked
- member_left
- user_joined_company
- member_role_assigned
- role_created
- role_updated
- role_deleted
- vehicle_created
- vehicle_updated
- vehicle_deleted
- vehicle_need_maintenance
- vehicle_maintenance_complete

## Events

When a Webhook call is received, the Controller relaunch two Events: a `Trucky\Webhook\TruckyGenericEvent` and a specific event typized for each `event` type

You can choose if listen to the Generic Event or listen to each specific event you want to handle

Under the namespace `Trucky\Webhook\Events` you will find the specific events relaunched from the Webhook call.

Each Event class contains a `data` property containing the Event Body.

### Available Events under \Trucky\Webhooks namespace

- TruckyGenericEvent
- ApplicationAccepted
- ApplicationCreated
- ApplicationRejected
- ApplicationRetired
- GarageCreated
- GarageDeleted
- GarageUpgraded
- JobCreated
- JobCancelled
- JobCompleted
- JobDeleted
- JobEventCreated
- MemberKicked
- MemberLeft
- UserJoinedCompany
- MemberRoleAssigned
- RoleCreated
- RoleUpdated
- RoleDeleted
- VehicleCreated
- VehicleUpdated
- VehicleDeleted
- VehicleAssigned
- VehicleNeedMaintenance
- VehicleMaintenanceComplete

## Create your Event Listeners and register them

Listener:

```php
<?php

namespace App\Listeners;

use Trucky\Webhook\Events\JobCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JobCreatedEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(JobCreated $event): void
    {
        //
        // dd($event);
    }
}
```

and register it in the `EventServiceProvider` of your Laravel application

```php
protected $listen = [
...
    // for the generic event
    TruckyGenericEvent::class => [
        TruckyGenericEventListener::class
    ],
    // for specific events
    JobCreated::class => [
        JobCreatedEventListener::class
    ]
]
```

