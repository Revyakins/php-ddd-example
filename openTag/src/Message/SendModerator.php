<?php

namespace App\Message;

class SendModerator
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
