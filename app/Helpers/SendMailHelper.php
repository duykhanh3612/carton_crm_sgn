<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class SendMailHelper
{
    /**
     * @param null $view Template Email
     * @param array $user User Array
     * @param null $subject Subject Email
     * @return bool
     */
    public static function sendMail($view = null, $user = [], $subject = null, $data = null, $fromName = null)
    {
        try {
            $email = !empty($user['email']) ? $user['email'] : '';
            $fullName = !empty($user['last_name']) ? @$user['last_name'] . ' ' . @$user['first_name'] : '';
            if (empty($email)) {
                return false;
            }
            if (empty($view)) {
                return false;
            }
            if (empty($data) && empty($fullName)) {
                return false;
            }
            Mail::send($view, ['record' => $user , 'data' => $data], function ($m) use ($email, $fullName, $subject, $fromName) {
                $m->from(config('mail.from.address'), $fromName ? $fromName : config('mail.from.name'));
                $m->to($email, $fullName)->subject($subject);
            });
        } catch (\Throwable $tr) {
            LogHelper::write($tr->getMessage());
            return false;
        }

        return true;
    }
    
    public static function sendNotificationMail($emailTemplate = null, $emailData = null, $emailSubject = null)
    {
        if (empty($emailTemplate) || empty($emailData['notification_email'])) {
            return false;
        }
        $emails = explode(',', $emailData['notification_email']);
        foreach ($emails as $email) {
            $email = trim($email);
            if ($email) {
                Mail::send($emailTemplate, ['emailData' => $emailData], function ($m) use ($email, $emailSubject) {
                    $m->from(config('mail.from.address'), config('mail.from.name'));
                    $m->to($email)->subject($emailSubject);
                });
            }
        }
        return true;
    }
}
