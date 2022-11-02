<?php

namespace App\Http\Controllers;

use App\Models\NewsEntry;
use Illuminate\Http\Request;
use App\Models\User;

class UserPageController extends Controller
{
    // ユーザーページ
    function show(Request $request, $name){

        $user = User::where("display_name", $name)->first();
        if(!$user){
            return abort(404);
        }

        // NewsEntryのうち、user_idが現在ログイン中のユーザーのIDと一致するものを取得
        $news_list = $user->newsEntry()
                    ->orderBy("id", "desc")
                    ->paginate(10);

        if($request->has("embed")){
            return view("user_page_embed", compact(
                "news_list",
                "user"
            ));
        }

        return view("user_page", compact("user", "news_list"));
    }

    // ユーザーページ記事詳細
    function showDetail(Request $request, $name ,$id){

        $news = NewsEntry::find($id);
        if(!$news){
            return abort(404);
        }
        $user = $news->user()->first();

        // display_nameが違う(不正なアクセス!)
        if($user->display_name != $name){
            return abort(404);
        }

        if($request->has("embed")){
            return view("user_news_detail_embed", compact(
                "news",
                "user"
            ));
        }

        return view("user_news_detail", compact("news", "user"));
    }
}
