<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\UserController;
use App\User;
use App\Contents;
use App\Subjects;
use App\Categories;

class ContentController extends Controller
{
    public function getIndex(Request $request)
    {
        $data = [];
        $userControllerObj = new UserController();
        $cookie = $userControllerObj->checkCookie($request);
        $data['categories'] = Categories::getCategories();
        if($cookie === 0)
        {
            return View::make('index', $data);
        }
        else if($cookie === -1)
        {
            $response = new Response('Your cookie is invalid, We have cleared it for you, Refresh to re-login to NEUP-Channel');
            return $response->withCookie('neupchan', "", -1);
        }
        else if($cookie->shortCookie === NULL) //User id get
        {
            $shortCookie = $cookie->short_cookie;
            $data['firstLogin'] = true;
        }
        else
        {
            $shortCookie = $cookie->shortCookie;
            $data['lastLoginIP'] = $cookie->last_login_ip;
        }
        $data['shortCookie'] = $shortCookie;
        //return View::make('index', $data)->withCookie(cookie('neupchan', $cookie, 90 * 24 * 60));
        $response = new Response(view('index', $data));
        if(isset($data['firstLogin']))
        {
            return $response->withCookie('neupchan', $cookie, 90 * 24 * 60);
        }
        else
        {
            return $response;
        }
    }

    public function getContentByCatIDAndSubID(Request $request, $cat_id, $sub_id)
    {

    }

    public function postContent(Request $request, $cat_id, $sub_id)
    {

    }

    public function postSubject(Request $request, $cat_id)
    {

    }

    public function getContentByCatID(Request $request, $cat_id)
    {
        $page_id = $request->get('p');
        
    }
}
