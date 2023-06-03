<?php

namespace Trucky\Webhook\Events;

class TruckyGenericEvent extends BaseEvent
{
    public string $type;

    public function __construct(string $type, array $payload)
    {
        parent::__construct($payload);

        $this->type = $type;
    }
}
