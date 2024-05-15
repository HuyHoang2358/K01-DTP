<?php

namespace App\Http\Controllers;

use App\Services\FirebaseService;
use App\Traits\RespondsWithHttpStatus;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Exception\MessagingException;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseController extends Controller
{
    use RespondsWithHttpStatus;
    protected mixed $database;
    protected mixed $messaging;
    public function __construct()
    {
        $this->database = FirebaseService::connect()->createDatabase();
        $this->messaging = FirebaseService::connect()->createMessaging();
    }
    public function addData(){
        $location = $this->database->getReference('/location');
        $status = $this->database->getReference('/status');

        $location_values = $location->getValue();
        $location_value = end($location_values);
        $location_value = array_values($location_value)[0];
        $status_values = $status->getValue();
        $status_value = end($status_values);
        $status_value = array_values($status_value)[0];

        // slit string to array by ","
        $location_value = explode(",", $location_value);

      /*  echo  "<pre>";
        print_r ($location_value);

        echo "</pre>";
        echo  "<pre>";
        print_r ($status_value);
        echo "</pre>";*/
        return $this->success("", [
            'location' => $location_value,
            'status' => $status_value
        ], 200);

    }

    /**
     * @throws GuzzleException
     */
    public function getFCMToken(){
        // send request to url to get token
        $url = 'https://66161c7bb8b8e32ffc7c6500.mockapi.io/fcmtoken';
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody());
        return $data[0]->token;
    }

    /**
     * @throws MessagingException
     * @throws FirebaseException
     * @throws GuzzleException
     */
    public function publish(): void
    {
        $token = $this->getFCMToken();
        echo $token;
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create('Thay đổi đường đi', 'Thay đổi lộ trình đi lại'))
            ->withData([
                'marker' => json_encode([12.293219986580471, 109.20896338383817]),
                'polyline' => json_encode([
                    [ 109.201717806098003, 12.2833316258331 ],
                    [ 109.204263428035006, 12.2854572222996 ],
                    [ 109.205319108517998, 12.2905919495005 ],
                    [ 109.208488774521001, 12.292844716111199 ]
                ]),
            ]);

        $this->messaging->send($message);
        echo "<pre>";
        print_r($message);
        echo "</pre";

        echo "Message sent";
    }

    /**
     * @throws GuzzleException
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function publishRoute(Request $request){
        $points = $request->input('points');

        $pp = [];
        foreach ($points as $point){
            $pp[] = [$point['lng'], $point['lat']];
        }
        $token = $this->getFCMToken();
        echo $token;
        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create('Thay đổi đường đi', 'Thay đổi lộ trình đi lại'))
            ->withData([
                'marker' => json_encode(end($pp)),
                'polyline' => json_encode($pp),
            ]);

        $this->messaging->send($message);
        return $this->success("Message sent",[
            'marker' => json_encode(end($pp)),
            'polyline' => json_encode($pp),
        ] , 200);
    }
}
