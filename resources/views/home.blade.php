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

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="">
        <div class="text-center">
          <p class="fs-4 fw-bold">
            <?php $user = Auth::user(); ?>{{ $user->name }}さんお疲れ様です！
          </p>
          <p>{{ session('message') }}</p>


          <div class="row">
            <div class="col-sm-6 py-5">
              <div class="card">
                <div class="card-body py-5">
                  <form class="timestamp" action="/attendance/start" method="post">
                    @csrf

                    @if(!isset($is_shift_start))
                    <input type="submit" value="勤務開始" class="fw-bold">
                    @else
                    <p>
                      <font color="gray" class="fw-bold">勤務開始</font>
                    </p>
                    @endif

                  </form>
                </div>
              </div>
            </div>

            <div class="col-sm-6 py-5">
              <div class="card">
                <div class="card-body py-5">
                  <form class="timestamp" action="/attendance/end" method="post">
                    @csrf
                    @if(!isset($is_shift_end))
                    <input type="submit" value="勤務終了" class="fw-bold">
                    @else
                    <p>
                      <font color="gray" class="fw-bold">勤務終了</font>
                    </p>
                    @endif
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body py-5">
                  <form class="timestamp" action="/break/start" method="post">
                    @csrf
                    @if(!isset($is_rest_start))
                    <input type="submit" value="休憩開始" class="fw-bold">
                    @else
                    <p>
                      <font color="gray" class="fw-bold">休憩開始</font>
                    </p>
                    @endif
                  </form>
                </div>
              </div>
            </div>


            <div class="col-sm-6">
              <div class="card">
                <div class="card-body py-5">
                  <form class="timestamp" action="/break/end" method="post">
                    @csrf
                    @if(!isset($is_rest_end))
                    <input type="submit" value="休憩終了" class="fw-bold">
                    @else
                    <p>
                      <font color="gray" class="fw-bold">休憩終了</font>
                    </p>
                    @endif
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <nav class="bg-light position-absolute bottom-0 w-100 text-center py-3 fw-bold">
    <h2 class="">Atte,inc.</h2>
  </nav>


</x-app-layout>