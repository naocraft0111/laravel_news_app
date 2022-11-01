<?php

namespace App\Http\Controllers;

use App\Models\NewsEntry;
use Illuminate\Http\Request;
use App\Models\User;

class UserPageController extends Controller
{
    // ユーザーページ
    function show($name){

        $user = User::where("display_name", $name)->first();
        if(!$user){
            return abort(404);
        }

        // NewsEntryのうち、user_idが現在ログイン中のユーザーのIDと一致するものを取得
        $news_list = $user->newsEntry()
                    ->orderBy("id", "desc")
                    ->paginate(10);

        return view("user_page", compact("user", "news_list"));
    }

    // ユーザーページ記事詳細
    function showDetail($name, $id){

        $news = NewsEntry::find($id);
        if(!$news){
            return abort(404);
        }
        $user = $news->user()->first();

        // display_nameが違う(不正なアクセス!)
        if($user->display_name != $name){
            return abort(404);
        }

        return view("user_news_detail", compact("news", "user"));
    }
}
