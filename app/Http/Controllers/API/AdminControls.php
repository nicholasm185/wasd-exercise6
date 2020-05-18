<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminControls extends BaseController
{
    public function imAdmin(Request $request){
        $user = $request->user();
        return $this->sendResponse($user, 'you have admin privileges!');
    }

    public function listUsers(){
        $users = User::all();
        return $this->sendResponse($users, 'list of users');
    }
}
