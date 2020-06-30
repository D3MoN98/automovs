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
                'name' => 'Sudipta Jana',
                'email' => 'sjgalaxy98@gmail.com',
                'address' => '23/4b Banamali Nasker Road, Kolkata - 700060',
                'buyer_contact_no' => 6291839827,
                'vehicle_name' => 'Honda - CB Hornet',
                'vehicle_url' => 'https://automovs.com/vehicle/2'
            ];
            $result = Msg91::sms('918777717436', '5ef22ae0d6fc050d32185fa2', $variables, 'AUTOMV');
            dd($result);
        } catch (Exception $e) {

        }
    }

}
