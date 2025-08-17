<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Step1Request;
use App\Http\Requests\Step2Request;
use App\Http\Requests\StoreWeightLogRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class WeightLogController extends Controller
{
    public function weight_logs()
    {
    $logs = WeightLog::orderBy('date', 'desc')->paginate(8);
    $user = Auth::user();


    $goalWeight = $user->goal_weight;

    $latestLog = $user->weightLogs()->latest()->first(); 
    $latestWeight = $latestLog ? $latestLog->weight : null;

    $difference = ($latestWeight && $goalWeight) ? $latestWeight - $goalWeight : null;


    return view('weight_logs', compact('logs', 'goalWeight', 'latestWeight', 'difference'));
    }

    public function create()
    {
        return view('create');
    }

    public function goal_setting()
    {
        return view('goal_setting');
    }

    public function step1()
    {
        return view('register.step1');
    }

    public function step2Form(Step1Request $request)
    {
        return view('register.step2', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),

        ]);
    }

    public function step2Submit(Step2Request $request)
    {
        // セッションからSTEP1の情報を取得
        $account = $request->session()->get('register');

        if (!$account) {
            return redirect()->route('register.step1.form')->withErrors('アカウント情報が見つかりません。');
        }

        // ユーザー作成
        $user = User::create([
            'name' => $account['name'],
            'email' => $account['email'],
            'password' => Hash::make($account['password']),
            'current_weight' => $request->input('current-weight'),
            'goal_weight' => $request->input('goal-weight'),
        ]);

        Auth::login($user);
        $request->session()->forget('register');

        return redirect()->route('weight_logs.index')->with('success', '登録完了しました！');
    }

    public function login()
    {
        return view('login');
    }

    public function loginSubmit(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            return redirect()->intended('/weight_logs');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function search(Request $request)
    {
        $query = WeightLog::query();

        if ($request->start_date) {
            $query->where('date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->where('date', '<=', $request->end_date);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $user = Auth::user();
        $goalWeight = $user->goal_weight;
        $latestLog = $user->weightLogs()->latest()->first();
        $latestWeight = $latestLog ? $latestLog->weight : null;
        $difference = ($latestWeight && $goalWeight) ? $latestWeight - $goalWeight : null;

        return view('weight_logs', compact('logs', 'goalWeight', 'latestWeight', 'difference'));
    }
    public function store(StoreWeightLogRequest $request)
    {
        $minutes = $request->exercise_time;
        $hours = floor($minutes / 60);
        $minutes_only = $minutes % 60;
        $exercise_time = sprintf('%02d:%02d:00', $hours, $minutes_only);

        \App\Models\WeightLog::create([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $exercise_time,
            'exercise_content' => $request->exercise_content,
            'user_id' => auth()->id(), // ← ここ重要
        ]);
        return redirect()->route('weight_logs.index')->with('success', 'ログを追加しました！');
    }
    public function updateGoal(Request $request)
    {
        $request->validate([
            'goal_weight' => 'required|numeric|min:1',
        ]);
        $user = Auth::user();
        $user->goal_weight = $request->goal_weight;
        $user->save();

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました！');
    }
    public function updateLog(StoreWeightLogRequest $request, $id)
    {
        $log = WeightLog::findOrFail($id);

        $minutes = $request->exercise_time;
        $hours = floor($minutes / 60);
        $minutes_only = $minutes % 60;
        $exercise_time = sprintf('%02d:%02d:00', $hours, $minutes_only);


        $log->update([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $exercise_time,
            'exercise_content' => $request->exercise_content
        ]);

        return redirect()->route('weight_logs.index')->with('success', 'ログを更新しました！');
    }
    public function step1Submit(Step1Request $request)
    {
        // 入力内容をセッションに保存
        $request->session()->put('register', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        // STEP2 にリダイレクト
        return redirect()->route('register.step2.form');
    }
}