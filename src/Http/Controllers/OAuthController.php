<?php

namespace Novay\Smrpas\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    use \Novay\Smrpas\Traits\ControllerTrait;

    public function handle($response, $user) 
    {
        $user = User::updateOrCreate(['email' => $user['email']], [
            'name' => $user['name'], 
            'password' => 'no-password'
        ]);

        $user->token_smrpas()->delete();
        $user->token_smrpas()->create([
            'access_token' => $response['access_token'],
            'expires_in' => $response['expires_in'],
            'refresh_token' => $response['refresh_token']
        ]);

        \Auth::login($user);
        auth()->user()->update([
            'last_login' => new \DateTime, 
            'last_login_ip' => request()->ip(),
        ]);
        
        return redirect(config('smrpas.oauth_server.home'));
    }
}