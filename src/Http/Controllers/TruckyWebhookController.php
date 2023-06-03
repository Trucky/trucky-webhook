<?php

namespace Trucky\Webhook\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Trucky\Webhook\Events\TruckyGenericEvent;

class TruckyWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $eventType = Str::studly(str_replace('.', '_', $payload['type']));

        $eventClass = '\Trucky\Webhook\Events\\' . $eventType;
        $data = $payload["data"];

        Event::dispatch(new TruckyGenericEvent($payload['type'], $data));

        Event::dispatch(
            new $eventClass(
                $data
            )
        );
    }
}
