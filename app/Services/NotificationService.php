<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

function backOff(){
    static $num = 0;
    $time = 300 * pow(2,$num);
    $num++;
    return $time;
}

class NotificationService {
    private $clientToken;

    public function __construct()
    {
        $this->clientToken =  bcrypt(env("NOTIFICATION_KEY"));
    }


    public function sendNotificationToUser($userId,$userToken,$subject,$body,$imageUrl,$subSubject)
    {
        try{
            $response = Http::retry(3,backOff())
                    ->withToken($this->clientToken)
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
        catch(\Exception $err){
            return null;
        }


    }

    public function getUserNotificationCount($userId)
    {

        try{
            $response = Http::retry(3,backOff())
                    ->withToken($this->clientToken)
                    ->acceptJson()
                    ->get(env('NOTIFICATION_BASE_ENDPOINT',
                    "http://localhost:8080/api/notifications")."/get-count/".$userId);


            if($response->ok()){
                return  $response->json();
            }
            return null;
        }
        catch(\Exception $err){
            Log::info('From Jephter'.$err->getMessage());
            return null;
        }

    }
    public function getUserNotifications($userId)
    {

        try{
            $response = Http::retry(3,backOff())
                    ->withToken($this->clientToken)
                    ->acceptJson()
                    ->get(env('NOTIFICATION_BASE_ENDPOINT',
                    "http://localhost:8080/api/notifications")."/show/".$userId);

            if($response->ok()){
                return  $response->json();
            }
            return null;
        }
        catch(\Exception $err){
            return null;
        }

    }
    // This method is just use to modify the seen attributes of notifications
    public function readUserNotifications($userId)
    {

        try{
            $response = Http::retry(3,backOff())
                    ->withToken($this->clientToken)
                    ->acceptJson()
                    ->get(env('NOTIFICATION_BASE_ENDPOINT',
                    "http://localhost:8080/api/notifications")."/read/".$userId);

            if($response->ok()){
                return  $response->json();
            }
            return null;
        }
        catch(\Exception $err){
            return null;
        }

    }
    public function getAllNotificationsOnSystem()
    {

        try{
            $response = Http::retry(3,backOff())
                    ->withToken($this->clientToken)
                    ->acceptJson()
                    ->get(env('NOTIFICATION_BASE_ENDPOINT',
                    "http://localhost:8080/api/notifications")."/show");

            if($response->ok()){
                return  $response->json();
            }
            return null;
        }
        catch(\Exception $err){
            return null;
        }

    }
}
