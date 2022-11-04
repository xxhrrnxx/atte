<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<x-app-layout class="position-relative">
    <x-slot name="header">
        <nav class="navbar navbar-expand-sm navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4"
                aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h2 class="navbar-brand">Atte</h2>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/attendance/0') }}">日付一覧</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </x-slot>

    <div class="d-flex justify-content-center my-5">
        <a href="{!! '/attendance/' . ($num - 1) !!}" class="arrow px-5 pt-2">＜</a>
        <p class="fs-3">{{ $fix_date }}</p>
        <a href="{!! '/attendance/' . ($num + 1) !!}" class="arrow px-5 pt-2">＞</a>
    </div>
    <div class="mx-5    ">
        <table class="table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>勤務開始</th>
                    <th>勤務終了</th>
                    <th>休憩時間</th>
                    <th>勤務時間</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $shift)
                <tr>
                    <td class="py-4">{{ $shift->users->name }}</td>
                    <td class="py-4">{{ $shift->start_time }}</td>
                    <td class="py-4">{{ $shift->end_time }}</td>
                    <td class="py-4">{{ $shift->rest_sum }}</td>
                    <td class="py-4">{{ $shift->work_time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{ $shifts->links() }}
    </div>
    <nav class="bg-light position-absolute bottom-0 w-100 text-center py-3 fw-bold">
        <h2 class="">Atte,inc.</h2>
    </nav>
</x-app-layout>