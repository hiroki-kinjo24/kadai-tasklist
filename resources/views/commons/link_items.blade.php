@if (Auth::check())
    {{-- タスク管理ページへのリンク --}}
     <li><a class="link link-hover" href="{{ route('tasks.index') }}">Task</a></li>
    {{-- ログアウトへのリンク --}}
     <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif