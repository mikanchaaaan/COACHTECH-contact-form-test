@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('button')
<div class="button">
    <a href="/register" class="button_inner">register</a>
</div>
@endsection

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
    <div class="login__content--inner">
        <form action="/login" class="form" method="post">
            @csrf
            <!-- メールアドレス入力 -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <!-- パスワード入力 -->
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="例: coachtech1106" />
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="sunmit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection