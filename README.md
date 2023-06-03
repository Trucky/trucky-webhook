# Trucky Webhook for Laravel >10.x

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
    "type": "job.created"
    "data": {
        ....
    }
}
```

### Raw Event Types

- application.accepted
- application.created
- application.rejected
- application.retired
- application.updated
- garage.created
- garage.deleted
- garage.updated
- job.created
- job.cancelled
- job.completed
- job.deleted
- member.kicked
- member.left
- role.created
- role.updated
- vehicle.created
- vehicle.updated
- vehicle.deleted


## Events

When a Webhook call is received, the Controller relaunch two Events: a `Trucky\Webhook\TruckyGenericEvent` and a specific event typized for each `type`

You can choose if listen to the Generic Event or listen to each specific event you want to handle

Under the namespace `Trucky\Webhook\Events` you will find the specific events relaunched from the Webhook call.

Each Event class contains a `$payload` property containing the Event Body.

### Available Events

- ApplicationAccepted
- ApplicationCreated
- ApplicationRejected
- ApplicationRetired
- ApplicationUpdated
- GarageCreated
- GarageDeleted
- GarageUpdated
- JobCreated
- JobCancelled
- JobCompleted
- JobDeleted
- MemberKicked
- MemberLeft
- RoleCreated
- RoleUpdated
- VehicleCreated
- VehicleUpdated
- VehicleDeleted

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

and register it in the `EventServiceProvider`

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

