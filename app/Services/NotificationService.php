<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

function backOff(){
    static $num = 0;
    $time = 300 * pow(2,$num);
    $num++;
    return $time;
}

class NotificationService {
    public function sendNotificationToUser($userId,$userToken,$subject,$body,$imageUrl,$subSubject)
    {
        $clientToken = bcrypt(env("NOTIFICATION_KEY"));
        $response = Http::retry(3,backOff())
                    ->withToken($clientToken)
                    ->timeout(120)
                    ->acceptJson()
                    ->post(env('NOTIFICATION_BASE_ENDPOINT',"http://localhost:8080/api/notifications")."/send",[
                        'userId' => $userId,
                        'userToken' =>$userToken,
                        'subject' => $subject,
                        'body' => $body,
                        'imageUrl' => $imageUrl,
                        'subSubject' => $subSubject
                    ]);
        if($response->ok()){
            return  $response->json();
        }
        return null;

    }
}
