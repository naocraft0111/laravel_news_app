<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ManageUserController extends Controller
{
    // ユーザー管理機能
    // 一覧を表示
    function showUserList(){
        $user_list = User::orderBy("id", "desc")->paginate(10);
        return view("admin.user_list", compact("user_list"));
    }

    // ユーザー詳細
    function showUserDetail($id){
        $user = User::find($id);
        return view("admin.user_detail", compact("user"));
    }

    // ユーザー登録フォーム
    function showUserCreateForm(){
        return view("admin.user_create");
    }

}
