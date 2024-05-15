<?php

namespace App\Services;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;

class FirebaseService
{
    public static function connect(): Factory
    {
      /*  echo base_path('\storage\app\firebase\demok01-e6355-firebase-adminsdk-tctmy-5c2e5d44c4.json');
        exit;*/

        $firebase = (new Factory)
            ->withServiceAccount(base_path('\storage\app\firebase\demok01-e6355-firebase-adminsdk-tctmy-5c2e5d44c4.json'))
            ->withDatabaseUri("https://demok01-e6355-default-rtdb.asia-southeast1.firebasedatabase.app/");

        return $firebase;
    }
}
