<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTopController extends Controller
{
    // 管理画面TOP
    function show(){
        return view("admin.admin_top");
    }
}
