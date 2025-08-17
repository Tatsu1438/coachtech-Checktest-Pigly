@extends('layouts.login-layout')

@section('css')
@endsection

@section('content')
    <div>
        <div></div>
        <div class="login-box" style="display: flex; justify-content: space-between;">
            <div></div>
            <div>
                <div class="title">
                    <h1 style=" font-size: 60px;">PiGLy</h1>
                    <p class="entry">ログイン</p>
                </div>
                <form action="{{ route('login.submit') }}" method="POST" novalidate>
                @csrf
                    <div>
                        <div>
                            <label for="email">メールアドレス</label>
                        </div>
                        <div>
                            <input type="email" name="email" id="email" placeholder="メールアドレスを入力">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div style="margin-top: 20px;">
                            <label for="password">パスワード</label>
                        </div>
                        <div style="margin-bottom: 30px;">
                            <input type="password" name="password" id="password" placeholder="パスワードを入力">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1" style="color: red;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <div></div>
                        <div>
                            <div style="display: flex; justify-content: space-between;">
                                <div></div>
                                <div>
                                    <button class="login-btn" type="submit">ログイン</button>
                                </div>
                                <div></div>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <div></div>
                                <div>
                                    <div style="width: 176px; height: 24px;">
                                        <a href="{{ route('register.step1.form') }}">アカウント作成はこちら</a>
                                    </div>
                                </div>
                                <div></div>
                            </div>
                        </div>
                        <div></div>
                    </div>
                </form>
            </div>
            <div></div>
        </div>
        <div></div>
    </div>
@endsection