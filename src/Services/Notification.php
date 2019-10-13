<?php

namespace App\Services;

class Notification {

    /**
     * @var
     *
     */
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function sendNotification(){

    }
}