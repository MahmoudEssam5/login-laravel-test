<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerifyController extends Controller
{
    public function verify($token ,$user_id)
    {
        $user = User::where('id',$user_id)->first();

        if($user->verify_token === $token ){
            Auth::login($user);
            $user->update([
                'email_verified_at' => date('Y-m-d H:i:s')
            ]);
            return redirect()->route('dashboard');
        }

        return abort(404);
    }
}
