<?php

namespace Trucky\Webhook\Events;

/**
 * Trucky Generic Event fired for all events
 */
class TruckyGenericEvent extends BaseEvent
{
    /**
     * Event Data
     * @var array
     */
    public array $data;

    /**
     * Event Type
     * @var string
     */
    public string $event;

    /**
     * Summary of __construct
     * @param string $event
     * @param array $data
     */
    public function __construct(string $event, array $data)
    {
        parent::__construct($data);

        $this->event = $event;
        $this->data = $data;
    }
}
