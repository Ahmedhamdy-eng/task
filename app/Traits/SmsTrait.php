<?php

namespace App\Traits;

trait SmsTrait
{

    public function sendSms($name, $mobile, $msg, $lang)
    {
      
        $url = 'https://dashboard.mobile-sms.com/api/sms/send?api_key=aTJuUTJzRElWMUJMUFpMeEVoeW93OWJCSkZsMWRmUGhYc2Rsa3VveVdXYWtsNXlJeGNOSERZWWMxMm9u5feda9be3e6d2&name=' . $name . '&message=' . $msg . '&numbers=' . $mobile . '&sender=' . $name . '&language=' . $lang;
       

        $client = new \GuzzleHttp\Client();

        $response = $client->request('get', $url);
       
    }

}    