<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\User;
use App\ChCookie;

class UserController extends Controller
{
    public function createCookie()
    {

    }

    public function checkAccess(Request $request)
    {
        $userCookie = $request->cookie('neupchan');
        if($userCookie === NULL) return -1;
        $channelCookie = ChCookie::where('cookie', $userCookie->cookie)->where('state', 1)->first();
        if($channelCookie === NULL) return -1;
        return 1;
    }

    public function checkCookie(Request $request)
    {
        $userCookie = $request->cookie('neupchan');
        if($userCookie == NULL)
        {
            $channelCookies = ChCookie::where('state', 0)->first();
            //var_dump($channelCookies);
            if($channelCookies == NULL)
            {
                //No cookie return 0
                return 0;
            }
            else
            {
                $this->giveCookie($request, $channelCookies->id);
                return $channelCookies;
            }
        }
        else
        {
            //Check OK
            $cookieStr = $userCookie['cookie'];
            $cookieObj = ChCookie::where('cookie', $cookieStr)->first();
            if($cookieObj === NULL)
            {
                return -1;
            }
            $userObj = User::where('cookie_id', $cookieObj->id)->first();
            $userObj->shortCookie = $cookieObj->short_cookie;
            User::find($userObj->id)->update(['last_login_ip' => $request->ip()]);
            return $userObj;
        }

    }

    public function giveCookie(Request $request, $cookieID)
    {
        $cookieObj = ChCookie::find($cookieID);
        $infoArr = [
            "cookie_id" => $cookieObj->id,
            "first_login_ip" => $request->ip(),
            "last_login_ip" => $request->ip(),
            "ban_level" => 0,
            "admin_flag" => 0,
        ];
        User::create($infoArr);
        $cookieObj->state = 1;
        $cookieObj->save();
    }
}
