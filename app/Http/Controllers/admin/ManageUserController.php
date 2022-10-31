<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
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

    // ユーザー登録機能
    function create(Request $request){
        $input = $request->only('name', 'email', 'display_name', 'password', 'password_confirmation');

        $validator = Validator::make($input, [
            'name' => 'required|string|max:30',
            'email' => 'required|string|max:30|email|unique:users,email',
            'password' => 'required|confirmed|string|max:100',
            'display_name' => 'required|string|max:30|regex:/^[a-z0-9]+/|unique:users,display_name',
        ]);

        // バリデーション失敗
        if($validator->fails()){
            return redirect('admin/user/create')
                ->withErrors($validator)
                ->withInput();
        }

        // バリデーション成功
        $user = new User();
        $user->name = $input["name"];
        $user->email = $input["email"];
        $user->display_name = $input["display_name"];
        $user->password = bcrypt($input["password"]);
        $user->save();

        return redirect('admin/user/' . $user->id);
    }
}
