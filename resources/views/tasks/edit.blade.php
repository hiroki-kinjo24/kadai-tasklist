@extends('layouts.app')

@section('content')
    @if ($task->user_id == Auth::user()->id)
        <div class="prose ml-4">
            <h2 class="text-lg">id: {{ $task->id }} のタスク編集ページ</h2>
        </div>
    
        <div class="flex justify-center">
            <form method="POST" action="{{ route('users.update', $task->id) }}" class="w-1/2">
                @csrf
                @method('PUT')
                
                    <div class="form-control my-4">
                        <label for="title" class="label">
                            <span class="label-text">ステータス:</span>
                        </label>
                        <input type="text" name="status" value="{{ $task->status }}" class="input input-bordered w-full">
                    </div>
    
                    <div class="form-control my-4">
                        <label for="content" class="label">
                            <span class="label-text">タスク:</span>
                        </label>
                        <input type="text" name="content" value="{{ $task->content }}" class="input input-bordered w-full">
                    </div>
    
                <button type="submit" class="btn btn-primary btn-outline">更新</button>
            </form>
        </div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>権限がありません</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('dashboard') }}">back top</a>
                </div>
            </div>
        </div>
    @endif

@endsection