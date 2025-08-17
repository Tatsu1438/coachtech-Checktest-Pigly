@extends('layouts.login-layout')

@section('css')
@endsection

@section('content')
    <div>
        <div></div>
        <div style="display: flex; justify-content: space-between;">
            <div></div>
            <div>
                <div class="step1-box">
                    <div class="title">
                        <h1 style=" font-size: 60px;">PiGLy</h1>
                        <p class="entry">新規会員登録</p>
                        <p>STEP1 アカウント情報の登録</p>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <div></div>
                        <div>
                            <form action="{{ route('register.step2.form') }}" method="GET">
                            @csrf
                                <div>
                                    <div>
                                        <label for="username">お名前</label>
                                    </div>
                                    <div style="margin-bottom: 30px;">
                                        <input type="text" name="name" id="username" placeholder="名前を入力">
                                        @if($errors->has('name'))
                                            @foreach($errors->get('name') as $error)
                                                <p style="color: red; font-size: 0.9rem;">{{ $error }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <label for="email">メールアドレス</label>
                                    </div>
                                    <div style="margin-bottom: 30px;">
                                        <input type="email" name="email" id="email" placeholder="メールアドレスを入力">
                                        @if($errors->has('email'))
                                            @foreach($errors->get('email') as $error)
                                                <p style="color: red; font-size: 0.9rem;">{{ $error }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <label for="password">パスワード</label>
                                    </div>
                                    <div style="margin-bottom: 30px;">
                                        <input type="password" name="password" id="password" placeholder="パスワードを入力">
                                        @if($errors->has('password'))
                                            @foreach($errors->get('password') as $error)
                                                <p style="color: red; font-size: 0.9rem;">{{ $error }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <div></div>
                                    <div>
                                        <div>
                                            <button class="login-btn" type="submit">次に進む</button>
                                        </div>
                                    </div>
                                    <div></div>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <div></div>
                                    <div>
                                        <div>
                                            <a href="{{ route('login') }}">ログインはこちら</a>
                                        </div>
                                    </div>
                                    <div></div>
                                </div>
                            </form>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div></div>
        </div>
        <div></div>
    </div>
@endsection