<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

/**
 * @property \Kreait\Firebase\Contract\Auth $auth
 */
class FirebaseAuthController extends Controller
{
    public function __construct()
    {
        $this->auth = Firebase::auth();
    }
}
