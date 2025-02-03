<?php
// app/Notifications/LoginNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoginNotification extends Notification
{
    use Queueable;

    public $user;
    public $loginTime;
    public $deviceType;
    public $userIp;

    public function __construct($user, $loginTime, $deviceType, $userIp)
    {
        $this->user = $user;
        $this->loginTime = $loginTime;
        $this->deviceType = $deviceType;
        $this->userIp = $userIp;
    }

    public function via($notifiable)
    {
        return ['mail']; // You can add other channels like database, SMS, etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->subject('Login Notification')
            ->line('You have logged in at ' . $this->loginTime)
            ->line('Device Type: ' . $this->deviceType)
            ->line('IP Address: ' . $this->userIp)
            ->line('Name: ' . $this->user->name)
            ->line('Email: ' . $this->user->email)
            ->line('Contact: ' . ($this->user->contect ?? 'N/A'))
            ->line('If this wasn’t you, please contact support immediately.');
    }
}
