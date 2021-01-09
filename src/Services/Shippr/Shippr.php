<?php


namespace App\Services\Shippr;


use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Shippr
{
    private const KEYAPI_PROD = "3d3bcffc3139e3aae5e1219468b143842cfc67959b14d10d407ca296d91512fc1db655d8314193cbb3cad11624b48ea8";
    private const URLAPI_PROD = "https://api.shippr.io/v1";
    public const CREATED = "CREATED";
    public const ASSIGNED = "ASSIGNED";
    public const UPCOMING = "UPCOMING";
    public const PICKED_UP = "PICKED_UP";
    public const DELIVERED = "DELIVERED";
    public const CANCELED = "CANCELED";
    public function __construct()
    {
        //ContainerBagInterface $params
        //$this->params = $params;
        //$this->keyAPI = $this->params->get("shippr_api_key");

    }

    public function getHealth(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this::URLAPI_PROD.'/health/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Authorization: Bearer ".$this::KEYAPI_PROD;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function getDeliveries(int $page=1, string $status){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this::URLAPI_PROD.'/deliveries');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, "page=$page&status=$status");


        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Authorization: Bearer ".$this::KEYAPI_PROD;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function createDelivery($time_window_start, $time_window_end,
                                   $desired_pickup_time, $has_retrun)
    {
        //'{"time_window_start": "2021-01-24T14:15:22Z","time_window_end": "2021-01-24T14:15:22Z","desired_pickup_time": "2021-01-18T04:20:00.000+02:00","pickup_location": {"first_name": "Anduin","last_name": "Wrynn","company": "Kenobi, Skywalker and Solo food products","phone": "0499422942","address": "Abbey Road 1, Saint-Gilles, Belgium","comment": "The princess is in another castle","email": "recipient@example.com"},"destinations": [{"location": {"first_name": "Anduin","last_name": "Wrynn","company": "Kenobi, Skywalker and Solo food products","phone": "0499422942","address": "Abbey Road 1, Saint-Gilles, Belgium","comment": "The princess is in another castle","email": "recipient@example.com"},"package_type": "SMALL","reference_number": "string","time_window_start": "2019-08-24T14:15:22Z","time_window_end": "2019-08-24T14:15:22Z"}],"has_return": true}';
        $data_params = '{
            "time_window_start": "2021-01-24T14:15:22Z",
            "time_window_end": "2021-01-24T14:15:22Z",
            "desired_pickup_time": "2021-01-18T04:20:00.000+02:00",
            "pickup_location": {
            "first_name": "Anduin",
            "last_name": "Wrynn",
            "company": "Kenobi, Skywalker and Solo food products",
            "phone": "0499422942",
            "address": "Abbey Road 1, Saint-Gilles, Belgium",
            "comment": "The princess is in another castle",
            "email": "recipient@example.com"
            },
            "destinations": [
            {
              "location": {
                "first_name": "Anduin",
                "last_name": "Wrynn",
                "company": "Kenobi, Skywalker and Solo food products",
                "phone": "0499422942",
                "address": "Abbey Road 1, Saint-Gilles, Belgium",
                "comment": "The princess is in another castle",
                "email": "recipient@example.com"
              },
              "package_type": "SMALL",
              "reference_number": "string",
              "time_window_start": "2019-08-24T14:15:22Z",
              "time_window_end": "2019-08-24T14:15:22Z"
            }
            ],
            "has_return": true
        }';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this::URLAPI_PROD.'/deliveries');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_params);


        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Authorization: Bearer ".$this::KEYAPI_PROD;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function getDelivery(string $uuid)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this::URLAPI_PROD."/deliveries/{$uuid}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Authorization: Bearer ".$this::KEYAPI_PROD;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    public function cancelDelivery(string $uuid)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this::URLAPI_PROD."/deliveries/{$uuid}/actions/cancel");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');


        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

        $headers = array();
        $headers[] = "Authorization: Bearer ".$this::KEYAPI_PROD;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }


}