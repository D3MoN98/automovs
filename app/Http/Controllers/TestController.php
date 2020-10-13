<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Msg91;

class TestController extends Controller
{

    public function send_sms()
    {
        try {
            $variables = [
                'contact_no' => 6291839827,
                'name' => "Sudipta Jana",
                'email' => "sjgalaxy98@gmail.com",
                'address' => "23/4B Banamali Nasker Road",
                'seller_name' => "Automovs",
                'seller_contact_no' => 8397198237,
                'vehicle_name' => "Marcedeses",
                'vehicle_url' => route('vehicle.show', ['id' => 1])
            ];

            $result = Msg91::sms("916291839827", '5efc5019d6fc0527d9149104', $variables, 'AUTOMV');

            // dd($result);


            // //Your authentication key
            // $authKey = "276339A6u0r8gEhQ5cd8e766";

            // //Multiple mobiles numbers separated by comma
            // $mobileNumber = "6291839827";

            // //Sender ID,While using route4 sender id should be 6 characters long.
            // $senderId = "AUTOMV";

            // //Your message to send, Add URL encoding here.
            // $message = urlencode("WTF");

            // //Define route
            // $route = "default";
            // //Prepare you post parameters
            // $postData = array(
            //     'authkey' => $authKey,
            //     'mobiles' => $mobileNumber,
            //     'message' => $message,
            //     'sender' => $senderId,
            //     'route' => $route
            // );

            // //API URL
            // $url = "http://api.msg91.com/api/sendhttp.php";

            // // init the resource
            // $ch = curl_init();
            // curl_setopt_array($ch, array(
            //     CURLOPT_URL => $url,
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_POST => true,
            //     CURLOPT_POSTFIELDS => $postData
            //     //,CURLOPT_FOLLOWLOCATION => true
            // ));


            // //Ignore SSL certificate verification
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


            // //get response
            // $output = curl_exec($ch);

            // //Print error if any
            // if (curl_errno($ch)) {
            //     echo 'error:' . curl_error($ch);
            // }

            // curl_close($ch);

            // echo $output;

            // $recipients = [array("mobiles" => 918420304842, "name" => "Sudipta Jana")];

            // $json_data = array('recipients' => $recipients, 'flow_id' => "5efc5019d6fc0527d9149104", 'sender' => "AUTOMV");

            // $curl = curl_init();

            // curl_setopt_array($curl, array(
            //     CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_ENCODING => "",
            //     CURLOPT_MAXREDIRS => 10,
            //     CURLOPT_TIMEOUT => 30,
            //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //     CURLOPT_CUSTOMREQUEST => "POST",
            //     CURLOPT_POSTFIELDS => json_encode($json_data),
            //     CURLOPT_SSL_VERIFYHOST => 0,
            //     CURLOPT_SSL_VERIFYPEER => 0,
            //     CURLOPT_HTTPHEADER => array(
            //         "authkey: 276339A6u0r8gEhQ5cd8e766",
            //         "content-type: application/json"
            //     ),
            // ));

            // $response = curl_exec($curl);
            // $err = curl_error($curl);

            // curl_close($curl);

            // if ($err) {
            //     echo "cURL Error #:" . $err;
            // } else {
            //     echo $response;
            // }
        } catch (Exception $e) {
        }
    }
}