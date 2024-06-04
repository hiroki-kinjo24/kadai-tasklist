<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Micropost;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            // ユーザーの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザーの投稿も取得するように変更しますが、現時点ではこのユーザーの投稿のみ取得します）
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }
}