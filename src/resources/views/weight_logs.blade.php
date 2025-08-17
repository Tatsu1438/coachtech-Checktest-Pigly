@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/weight_log.css') }}">
    <link rel="stylesheet" href="{{ asset('css/weight_log_modal.css') }}">
@endsection

@section('content')
    <div style="display: flex;">
        <div style=" width: 20%;"></div>
        <div>
            <div class="weight-box" style="background-color: #FFFFFF; margin-top: 50px; display: flex; padding: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px; justify-content: space-between;">
                <div style="width: 230px;">
                    <p>目標体重</p>
                    <div style="width: 126px; height: 60px; font-size: 40px;">
                        <p style="width: 200px;">{{ $goalWeight ? $goalWeight . ' kg' : '-' }}</p>
                    </div>
                </div>
                <div style="width: auto; border: solid;"></div>
                <div style="width: 230px;">
                    <p>目標まで</p>
                    <div style="width: 126px; height: 60px; font-size: 40px;">
                        <p style="width: 200px;">{{ $difference !== null ? $difference . ' kg' : '-' }}</p>
                    </div>
                </div>
                <div style="width: auto; border: solid;"></div>
                <div style="width: 230px;">
                    <p>最新体重</p>
                    <div style="width: 126px; height: 60px; font-size: 40px;">
                        <p style="width: 200px;">{{ $latestWeight ? $latestWeight . ' kg' : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div style=" width: 20%;"></div>
    </div>

    <div style="display: flex;">
        <div style=" width: 150px;"></div>

        <div style="width: 1120px; height: 900px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px;">
            <div style="display: flex; justify-content: space-between;">
                <div style=" width: 20px;"></div>
                <div style="padding: 30px;">
                    <div style=" display: flex; justify-content: space-between; width: 1000px;">
                        <form action="{{ route('weight_logs.search') }}" method="GET">
                            <input style="width: 200px; height: 43px;" type="date" name="start_date" id="start_date" value="{{ request('start_date') }}">
                            <span>〜</span>
                            <input style="width: 200px; height: 43px;" type="date" name="end_date" id="end_date" value="{{ request('end_date') }}">

                            <button style="width: 100px; height: 43px; background: #919191; border: none; border-radius: 8px;" type="submit">検索</button>
                            @if(request('start_date') || request('end_date'))
                                <a href="{{ route('weight_logs.search') }}"
                                style="display:inline-block; text-align:center; line-height:43px; width:100px; height:43px; background:#ddd; border-radius:8px; text-decoration:none; color:black;">
                                    リセット
                                </a>
                            @endif
                        </form>
                        <div>
                            <button style=" margin-bottom: 20px; border-radius: 8px; border: none; width: 160px; height: 45px; background: linear-gradient(10deg, rgba(163, 166, 225, 0.5), rgba(255, 171, 217, 0.7));" type="button" id="openWeightModal">データ追加</button>
                        </div>
                    </div>
                        @if(request('start_date') || request('end_date'))
                            <p style="margin-top: 10px;">
                                {{ request('start_date') ? \Carbon\Carbon::parse(request('start_date'))->format('Y年m月d日') : '指定なし' }}
                                〜
                                {{ request('end_date') ? \Carbon\Carbon::parse(request('end_date'))->format('Y年m月d日') : '指定なし' }}
                                の検索結果：{{ $logs instanceof \Illuminate\Pagination\AbstractPaginator ? $logs->total() : $logs->count() }}件
                            </p>
                        @endif
                    <table style="width: 1000px; height: 715px;" border="1">
                        <thead>
                            <tr style="border-bottom: solid;">
                                <th>日付</th>
                                <th>体重 (kg)</th>
                                <th>消費カロリー (kcal)</th>
                                <th>運動時間</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->date }}</td>
                                    <td>{{ $log->weight }}</td>
                                    <td>{{ $log->calories }}</td>
                                    <td>{{ $log->exercise_time }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="editBtn"
                                            data-id="{{ $log->id }}"
                                            data-date="{{ $log->date }}"
                                            data-weight="{{ $log->weight }}"
                                            data-calories="{{ $log->calories }}"
                                            data-exercise_time="{{ $log->exercise_time }}"
                                            data-exercise_content="{{ $log->exercise_content }}"
                                            style="border: none; background: transparent; cursor: pointer;">
                                            ✏️
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center" style="margin-top: 20px;">
                        {{ $logs->links() }}
                    </div>
                </div>
                <div style=" width: 20px;"></div>
            </div>
        </div>
        <div style=" width: 150px;"></div>
    </div>

    <div id="weightModal" class="modal">
        <div class="modal-content">
            <span id="closeModal">&times;</span>
            <h2>Weight Logを追加</h2>
            <form action="{{ route('weight_logs.store') }}" method="POST">
                @csrf
                <div>
                    <label for="date">日付<span style=" font-size: 15px; border-radius: 2px; width: 34px; height: 18px; color: white; margin-left: 10px; border: none; background: red;">必須</span></label>
                    <input type="date" name="date" id="date" required>
                    @error('date')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="weight">体重<span style=" font-size: 15px; border-radius: 2px; width: 34px; height: 18px; color: white; margin-left: 10px; border: none; background: red;">必須</span></label>
                    <input type="number" name="weight" id="weight" step="0.1" required>
                    @error('weight')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="calories">摂取カロリー<span style=" font-size: 15px; border-radius: 2px; width: 34px; height: 18px; color: white; margin-left: 10px; border: none; background: red;">必須</span></label>
                    <input type="number" name="calories" id="calories" required>
                    @error('calories')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="exercise_time">運動時間<span style=" font-size: 15px; border-radius: 2px; width: 34px; height: 18px; color: white; margin-left: 10px; border: none; background: red;">必須</span></label>
                    <input type="number" name="exercise_time" id="exercise_time" required>
                    @error('exercise_time')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="exercise_content">運動内容</label>
                    <input type="text" name="exercise_content" id="exercise_content">
                    @error('exercise_content')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div style="display: flex;justify-content: space-between; margin-top: 30px;">
                    <div></div>
                    <div style="display: flex;justify-content: space-between;">
                        <div>
                            <button style=" background: #919191; border-radius: 8px; border: none; margin-right: 30px; width: 150px; height: 50px;"
                                    type="button"
                                    onclick="window.location='{{ route('weight_logs.index') }}'">
                                戻る
                            </button>
                        </div>
                        <div>
                            <button style="background: linear-gradient(10deg, rgba(163, 166, 225, 0.5), rgba(255, 171, 217, 0.7));  border-radius: 8px; border: none; margin-right: 30px; width: 150px; height: 50px;" type="submit">登録</button>
                        </div>
                    </div>
                    <div></div>
                </div>
            </form>
        </div>
    </div>


    <div id="editModal" class="modal">
        <div class="modal-content">
            <span  style="position: absolute;top: 10px; right: 15px; font-size: 24px; font-weight: bold; cursor: pointer;" id="closeEditModal">&times;</span>
            <h2>Weight Log</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_date">日付</label>
                    <input type="date" name="date" id="edit_date" required>
                    @error('date')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="edit_weight">体重 (kg)</label>
                    <input type="number" name="weight" id="edit_weight" step="0.1" required>
                    @error('weight')
                        <p style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="edit_calories">摂取カロリー (kcal)</label>
                    <input type="number" name="calories" id="edit_calories" required>
                    @error('calories')
                        <p style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="edit_exercise_time">運動時間 (分)</label>
                    <input type="number" name="exercise_time" id="edit_exercise_time" required>
                    @error('exercise_time')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="edit_exercise_content">運動内容</label>
                    <input type="text" name="exercise_content" id="edit_exercise_content">
                    @error('exercise_content')
                        <p  style="color: red;" class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <div></div>
                    <div style="display: flex; justify-content: space-between;">
                        <div>
                            <button style=" background: #919191; border-radius: 8px; border: none; margin-right: 30px; width: 150px; height: 50px;"
                            type="button"
                            onclick="window.location='{{ route('weight_logs.index') }}'">
                            戻る
                            </button>
                        </div>
                        <div>
                            <button type="submit" style="background: linear-gradient(10deg, rgba(163, 166, 225, 0.5), rgba(255, 171, 217, 0.7));  border-radius: 8px; border: none; margin-right: 30px; width: 150px; height: 50px;">更新</button>
                        </div>
                    </div>
                    <div></div>
                </div>
            </form>
        </div>
    </div>


    <script>
        const modal = document.getElementById('weightModal');
        const openBtn = document.getElementById('openWeightModal');
        const closeBtn = document.getElementById('closeModal');

        const editModal = document.getElementById('editModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const editForm = document.getElementById('editForm');

        openBtn.onclick = () => { modal.style.display = 'flex'; }
        closeBtn.onclick = () => { modal.style.display = 'none'; }

        // エラー時にモーダルを自動で開く
        @if($errors->any())
            @if(session('form') === 'edit')
                editModal.style.display = 'flex';
            @else
                modal.style.display = 'flex';
            @endif
        @endif

        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.addEventListener('click', () => {
                editModal.style.display = 'flex';

                document.getElementById('edit_date').value = btn.dataset.date;
                document.getElementById('edit_weight').value = btn.dataset.weight;
                document.getElementById('edit_calories').value = btn.dataset.calories;
                document.getElementById('edit_exercise_time').value = btn.dataset.exercise_time;
                document.getElementById('edit_exercise_content').value = btn.dataset.exercise_content;

                editForm.action = `/weight_logs/${btn.dataset.id}`;
            });
        });

        closeEditBtn.onclick = () => { editModal.style.display = 'none'; }

        window.onclick = (e) => {
            if (e.target == modal) modal.style.display = 'none';
            if (e.target == editModal) editModal.style.display = 'none';
        }
    </script>

@endsection
