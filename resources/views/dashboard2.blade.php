@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="prose ml-4">
            <h2 class="text-lg">タスク 一覧</h2>
        </div>
    
        @if (isset($tasks))
            <table class="table table-zebra w-full my-4">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>ステータス</th>
                        <th>タスク</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        {{-- メッセージ作成ページへのリンク --}}
        {{-- <a class="btn btn-primary" href="{{ route('tasks.create') }}">新規タスクの追加</a> --}}
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>タスク管理ソフトにようこそ</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">レッツ新規登録！</a>
                </div>
            </div>
        </div>
    @endif
@endsection
