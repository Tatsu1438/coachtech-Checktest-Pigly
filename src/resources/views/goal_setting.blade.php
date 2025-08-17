@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('content')
    <div style="display: flex; justify-content: space-between; margin-top: 100px;">
        <div></div>
        <div class="goal-setting-box" style="display: flex; justify-content: space-between; align-items: center; width: 470px; height: 298px;">
            <div></div>
            <div style=>
                <h1 class="goal-setting-title">目標体重設定</h1>
                <form action="{{ route('weight_goal.update') }}" method="POST">
                    @csrf
                    <div style="position: relative; display: inline-block;">
                        <input style=" width: 380px; height: 43px;" type="number" name="goal_weight">
                        <span class="kg">kg</span>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <div></div>
                        <div style=" margin-top: 50px;">
                            <button style="border-radius: 8px; border: none; margin-right: 30px; width: 150px; height: 50px;" type="button" onclick="history.back()">戻る</button>
                            <button  class="update-btn" style="width: 150px; height: 50px;" type="submit">更新</button>
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