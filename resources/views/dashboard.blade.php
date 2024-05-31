@extends('layouts.app')

@section('content')
      <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>タスク管理ソフトにようこそ</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    @if (Auth::check())
                        <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">ログイン済み</a>
                    @else
                        <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">レッツ新規登録！</a>
                    @endif
                </div>
            </div>
        </div>
    
@endsection