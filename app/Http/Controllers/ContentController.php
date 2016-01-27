<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Contents;
use App\Subjects;
use App\Categories;
use App\ChCookie;

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
        $data =$request->all();
        $vdtor = Validator::make($data, [
            'content' => 'required|min:15',
            'file' => 'image|max:4096',
        ]);
        if($vdtor->fails())
            return Redirect::to("/cat/$cat_id")->withErrors($vdtor);
        $tmpCookie = $request->cookie('neupchan');
        $data['cookie'] = $request->cookie('neupchan');
        $cookieObj = ChCookie::where('cookie', $tmpCookie->cookie)->first();
        $userObj = User::where('cookie_id', $cookieObj->id)->first();
        $contentObj = new Contents();
        $contentObj->content = nl2br($data['content']);
        $contentObj->po_id = $userObj->id;
        $uploadFile = $request->file('file');
        if($uploadFile)
        {
            if(!$uploadFile->isValid())
                return Redirect::to("/cat/$cat_id")->withErrors($uploadFile->getErrorMessage());
            var_dump($uploadFile);
            $fileName = $uploadFile->getRealPath() . $request->cookie('neupchan')->cookie . time();
            $fileName = md5($fileName) . "." . $uploadFile->guessExtension();
            echo $fileName;
            $contentObj->image = $fileName;
            Storage::put('images/' . $fileName, file_get_contents($uploadFile->getRealPath()));
        }
        $contentObj->save();
        //var_dump($contentObj);
        Contents::find($contentObj->content_id)->update([
            'subject_id' => $contentObj->content_id
        ]);
        $subjectObj = new Subjects();
        $subjectObj->subject_id = $contentObj->id;
        $subjectObj->cat_id = $cat_id;
        $subjectObj->last_reply_time = time();
        $subjectObj->po_id = $userObj->id;
        $subjectObj->save();
        //var_dump($subjectObj);
        return Redirect::to("/cat/$cat_id")->with('post', 1);
    }

    public function getContentByCatID(Request $request, $cat_id)
    {
        $page_id = $request->get('p');
        $catObj = Categories::find($cat_id);
        $data['cat_name'] = $catObj->cat_name;
        $data['fullContent'] = Contents::getCatgoryFullContentByPageID($cat_id, 1);
        return View::make('catview', $data);
    }

    public function getImage(Request $request, $image_hash)
    {
        $file = Storage::get('images/'. $image_hash);
        $mimeType = Storage::mimeType('images/' . $image_hash);
        $response = \Illuminate\Support\Facades\Response::make($file, 200);
        $response->header("Content-Type", $mimeType);
        return $response;
    }
}
