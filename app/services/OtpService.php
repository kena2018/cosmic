<?php

namespace App\Services;

use Twilio\Rest\Client;

class OtpService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    /**
     * Send OTP to the user's mobile number.
     *
     * @param string $phoneNumber
     * @param string $otp
     * @return mixed
     */
    public function sendOtp($phoneNumber, $otp)
    {
        try {
            $message = $this->twilio->messages->create(
                $phoneNumber,
                [
                    'from' => env('TWILIO_PHONE_NUMBER'),
                    'body' => "Your OTP code is: $otp",
                ]
            );

            return $message;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
