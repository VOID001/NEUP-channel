<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    //
    protected $primaryKey = "content_id";
    protected $fillable = ['subject_id'];
    public static function getCatgoryFullContentByPageID($cat_id, $page_id)
    {
        $itemsPerPage = 5;
        $contentPerSubject = 3;
        $resultArr = [];
        $subjectObj = Subjects::where('cat_id', $cat_id)->orderBy('last_reply_time', 'desc')->get();
        foreach($subjectObj as $subject)
        {
            $contentObj = Contents::where('content_id', $subject->subject_id)->first();
            $userObj = User::find($subject->po_id);
            $cookieObj = ChCookie::where('id', $userObj->id)->first();
            $shortCookie = $cookieObj->short_cookie;
            $tmpArr = [
                'subject_id' => $contentObj->content_id,
                'subject_text' => $contentObj->content,
                'subject_cookie' => $shortCookie,
                'subject_create_time' => $subject->created_at,
                'subject_img' => $contentObj->image,     //Leave it for future use
                'contents' => [],
            ];
            $contentObj = Contents::where(
                'subject_id', $subject->subject_id
            )->where('content_id', '!=', $subject->subject_id)->orderBy('content_id', 'desc')->get();
            foreach($contentObj as $content)
            {
                $userObj = User::find($content->po_id);
                $cookieObj = ChCookie::where('id', $userObj->id)->first();
                $shortCookie = $cookieObj->short_cookie;
                $tmpContent = [
                    'content_id' => $content->content_id,
                    'content_text' => $content->content,
                    'content_cookie' => $shortCookie,
                    'content_create_time' => $content->created_at,
                    'content_img' => $content->image        //Leave it blank for future support
                ];
                array_push($tmpArr['contents'], $tmpContent);
            }
            array_push($resultArr, $tmpArr);
        }
        //var_dump($resultArr);
        return $resultArr;
    }
}
