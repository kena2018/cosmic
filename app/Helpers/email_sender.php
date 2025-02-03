<?php
namespace App\Helpers;

use Config;
use Mail;
use Log;
// use App\Models\EmailLog;
use Exception;


class Email_sender
{

    public static function setMailConfig(){

        $mailConfig = [
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => '587',
            'encryption' => 'tls',
            'username' => 'testck230392@gmail.com',
            'password' =>'lahwfgiwrlhseywo',
            'timeout' => null,
            // 'stream' => [
            //     'tls' => [
            //         'verify_peer'       => false,
            //         'verify_peer_name'  => false,
            //         'allow_self_signed' => true,
            //     ],
            // ],
            'auth_mode'  => null,
            'verify_peer'       => false,
        ];
        config(['mail.mailers.smtp' => $mailConfig]);
        config(['mail.from.address' => 'testck230392@gmail.com']);
        
        return $mailConfig;
    }
    // public static function sendEmail($view = null, $settings = null)
    // {
    //     if (!empty($settings) && $view != null) {
    //         $sent = Mail::send($view, $settings, function ($message) use ($settings) {
    //             $message->from($settings['from'], $settings['sender']);
    //             $message->to($settings['to'], $settings['receiver'])
    //             /*$message->bcc('chirag@velocitylabs.in', "Chirag Parmar")*/
    //             ->subject($settings['subject']);
    //         });
    //         //Log::info($settings);
    //     }
    // }

    // public static function sendOtpToUser($data = null){
    //     if ($data != null) {

    //         $settings                 = [];
    //         $settings['data']         = $data;
    //         $settings["subject"]      = "ReflowX Account Verification";
    //         $settings['emailType']    = 'ReflowX Account Verification';
    //         $settings['from']         = "no-reply@reflowx.com";
    //         $settings['to']           = $data['email'];
    //         $settings['sender']       = 'ReflowX';
    //         $settings['receiver']     = $data['name'];
    //         $settings['txtBody']      = view('email.registerotp', $settings)->render();
    //         unset($settings['txtBody']);
    //         Self::sendEmail('email.registerotp', $settings);

    //     }
    // }

    // public static function sendForgotePasswordMailToUser($data = null)
    // {
            
    //     if ($data != null) {

    //         $settings                 = [];
    //         $settings['data']         = $data;
    //         $settings["subject"]      = "Password Reset Request";
    //         $settings['emailType']    = 'Password Reset Request';
    //         $settings['from']         = "no-reply@reflowx.com";
    //         $settings['to']           = $data['email'];
    //         $settings['sender']       = 'ReflowX';
    //         $settings['receiver']     = $data['name'];
    //         $settings['txtBody']      = view('Auth.reset-password', $settings)->render();
    //         unset($settings['txtBody']);
    //         Self::sendEmail('Auth.reset-password', $settings);

    //     }
    // }
}