@extends('layouts.login-layout')

@section('css')
@endsection

@section('content')
    <div>
        <div></div>
        <div class="login-box">
            <div class="title">
                <h1 style=" font-size: 60px;">PiGLy</h1>
                <p class="entry">新規会員登録</p>
                <p>STEP2 体重データの入力</p>
            </div>
            <div style="display: flex; justify-content: space-between;">
                <div></div>
                <div>
                    <form action=" {{route('register.step2.submit')}} " method="POST">
                        @csrf
                        <div>
                            <div>
                                <label for="current-weight">現在の体重</label>
                            </div>
                            <div style="margin-bottom: 20px;">
                                <input type="text" name="current-weight" id="current-weight" placeholder="現在の体重を入力">
                                @if($errors->has('current-weight'))
                                    @foreach($errors->get('current-weight') as $error)
                                        <p style="color: red; font-size: 0.9rem;">{{ $error }}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div>
                            <div>
                                <label for="goal-weight">目標の体重</label>
                            </div>
                            <div style="margin-bottom: 30px;">
                                <input type="text" name="goal-weight" id="goal-weight" placeholder="目標の体重を入力">
                                @if($errors->has('goal-weight'))
                                    @foreach($errors->get('goal-weight') as $error)
                                        <p style="color: red; font-size: 0.9rem;">{{ $error }}</p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="name" value="{{ $name ?? old('name') }}">
                        <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                        <input type="hidden" name="password" value="{{ $password ?? old('password') }}">

                        <div style="display: flex; justify-content: space-between;">
                            <div></div>
                            <div>
                                <button type="submit" class="login-btn">アカウント作成</button>
                            </div>
                            <div></div>
                        </div>
                    </form>
                </div>
                <div></div>
            </div>
        </div>
        <div></div>
    </div>
@endsection