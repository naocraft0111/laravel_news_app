<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NewsEntry;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // ログイン中のユーザー
        $user = Auth::user();

        // NewsEntryのうち、user_idが現在ログイン中のユーザーのIDと一致するものを取得
        $news_list = $user->newsEntry()
                    ->orderBy("id", "desc")
                    ->paginate(10);
                    
        return view('home', compact(
            'user',
            'news_list'
        ));
    }
}
