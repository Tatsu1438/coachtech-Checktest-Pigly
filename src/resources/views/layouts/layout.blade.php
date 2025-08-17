<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech-checktest-pigly</title>
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header-box" style=" width: auto; height: auto; border: solid; ">
            <div style="">
                <h1 class="title" style="width: 125px; height: 51px; margin: 10px; margin-left: 40px;">Pigly</h1>
            </div>

            <div class="header-btn-box" style=" align-items: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
                <div style="display: flex; justify-content: space-between;">
                    <form action="{{ route('goal-setting') }}" method="GET">
                        @csrf
                        <button type="submit" style="margin-top: 10px; padding: 10px 20px 10px 20px; margin-right: 10px;">目標体重設定</button>
                    </form>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style=" margin-top: 10px; padding: 10px 20px 10px 20px; margin-right: 20px;">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>
    @yield('content')
    </main>
</body>
</html>