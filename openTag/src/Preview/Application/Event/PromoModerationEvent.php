<?php

namespace App\Preview\Application\Event;

class PromoModerationEvent
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }
}
