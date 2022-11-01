<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsEntry;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;

class ManageEntryController extends Controller
{
    // 記事の作成
    function showCreateForm(){
        return view("news.create_form");
    }

    // 記事の登録
    function create(Request $request){
        $input = $request->only('title', 'description', 'body');

        $validator = Validator::make($input, [
            'title' => 'required|string|max:200',
            'description' => 'string|max:200',
            'body' => 'required|string',
        ]);

        // バリデーション失敗
        if($validator->fails()){
            return redirect('news/create')
                ->withErrors($validator)
                ->withInput();
        }

        // バリデーション成功
        $news = new NewsEntry();
        $news->title = $input["title"];
        $news->description = $input["description"];
        $news->body = $input["body"];
        $news->user_id = Auth::id();
        $news->thumbnail_url = "";
        $news->image_url = "";
        $news->save();

        return redirect("home")->withStatus("記事を作成しました");
    }

    // 記事の編集
    function showEditForm($id){
        $user = Auth::user();
        $news = $user->newsEntry()->find($id);

        if(!$news){
            return redirect("home")->withStatus("記事がありません");
        }

        return view("news.edit_form", compact("news"));
    }

    // 記事の更新
    function update(Request $request, $id){
        $user = Auth::user();
        $news = $user->newsEntry()->find($id);

        if(!$news){
            return redirect("home")->withStatus("記事がありません");
        }

        // 入力値の受け取り
        $input = $request->only('title', 'description', 'body');

        $validator = Validator::make($input, [
            'title' => 'required|string|max:200',
            'description' => 'string|max:200',
            'body' => 'required|string',
        ]);

        // バリデーション失敗
        if($validator->fails()){
            return redirect('news/edit/' . $news->id)
                ->withErrors($validator)
                ->withInput();
        }

        // バリデーション成功
        $news->title = $input["title"];
        $news->description = $input["description"];
        $news->body = $input["body"];
        $news->user_id = Auth::id();
        $news->save();

        // 画像のアップロード
        $uploadInput = $request->only("image", "thumbnail");

        $uploadValidator = Validator::make($uploadInput, [
            'image' => 'file|image|mimes:jpeg,png',
            'thumbnail' => 'file|image|mimes:jpeg,png',
        ]);
        // アップロード失敗
        if($uploadValidator->fails()){
            return redirect('news/edit/' . $news->id)
                ->withErrors($uploadValidator)
                ->withInput();
        }

        // 画像が更新されたかどうか
        $is_change_image = false;

        // イメージのアップロード
        if(isset($uploadInput["image"])){
            $path = $uploadInput["image"]->store("public/news_uploads/" . $news->id);
            if($path){
                $news->image_url = $path;
                $is_change_image = true;
            }
        }

        // サムネイルのアップロード
        if(isset($uploadInput["thumbnail"])){
            $path = $uploadInput["thumbnail"]->store("public/news_uploads/" . $news->id);
            if($path){
                $news->thumbnail_url = $path;
                $is_change_image = true;
            }
        }

        // 保存する
        if($is_change_image){
            $news->save();
        }
        return redirect("home")->withStatus("記事を更新しました");
    }

    // 記事の削除
    function delete($id){
        $user = Auth::user();
        $news = $user->newsEntry()->find($id);

        if(!$news){
            return redirect("home")->withStatus("記事がありません");
        }
        $news->delete();
        return redirect("home")->withStatus("記事を削除しました");
    }
}
