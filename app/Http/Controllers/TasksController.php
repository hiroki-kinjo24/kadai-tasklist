<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Task;

//追加
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    
    
    public function index()
    {
        
        if (\Auth::check()) { // 認証済みの場合
            
            // 認証済みユーザーを取得
            $user = \Auth::user();
            //ユーザーの投稿の一覧を作成日時の降順で取得 
            $tasks = $user->tasks()->orderBy('created_at', 'asc')->paginate(11);
            
            // メッセージ一覧を取得
            //$tasks = Task::all();

            // メッセージ一覧ビューでそれを表示
            return view('dashboard', [ 
                'tasks' => $tasks,
            ]);
            
        }
        else {
            return view('dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
       // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new Task;

        // メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
     // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        // メッセージを作成
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = Auth::user()->id;
        $task->save();

        //トップページへリダイレクトさせる
        return redirect('/');
        
        // メッセージ一覧を取得
        /*
        $tasks = Task::all();
         // メッセージ一覧ビューでそれを表示
        return view('tasks.index', [ 
            //'user' => $user,
            'tasks' => $tasks
        ]);
        */
        
    }

    /**
     * Display the specified resource.
     */
    
    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値でメッセージを検索して取得
            $task = Task::findOrFail($id);
            
        if ($task->user_id == Auth::user()->id){
            // メッセージ詳細ビューでそれを表示
            return view('tasks.show', [
                'task' => $task,
            ]);
        }
        
        else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    
    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        /*
        // メッセージ編集ビューでそれを表示
        return view('auth.edit', ['task' => $task,]);
        */
        
        if ($task->user_id == Auth::user()->id){
            // メッセージ編集ビューでそれを表示
            return view('auth.edit', ['task' => $task,]);
        }
        
        else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    
    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content' => 'required|max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        // メッセージを更新
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        // トップページへリダイレクトさせる
        //return redirect('tasks.index');
       
        // メッセージ一覧を取得
        $tasks = Task::all();
         // メッセージ一覧ビューでそれを表示
        return view('tasks.index', [ 
            //'user' => $user,
            'tasks' => $tasks
        ]);
    }


    /**
     * Remove the specified resource from storage.
    */
    
    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        // メッセージを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
