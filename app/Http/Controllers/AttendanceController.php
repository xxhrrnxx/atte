<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Rest;

class AttendanceController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $shift = Shift::getShift();
        $dt = new Carbon();
        $date = $dt->toDateString();
        $today = Carbon::today();
        $oldTimestamp = Shift::where('user_id', $id)->latest()->first();
        $attendance = Shift::where('user_id', $id)->where('date', $date)->first();

        if (empty($shift)) {
            return view('home');
        }

        if ($shift->start_time) {
            return view('home')->with(['is_shift_start' => true]);
        }

        if ($shift->end_time) {
            var_dump('aaa');
            return view('home')->with(
                [
                    'is_shift_start' => true,
                    'is_shift_end' => true,
                    'is_rest_start' => true,
                    'is_rest_end' => true,
                ]
            );
        }

        $rest = Rest::whereNull('end_time')->first();

        if ($oldTimestamp->start_time) {
            if (isset($rest)) {
                return view('home')->with(['is_rest_end' => true]);
            } else {
                return view('home')->with(
                    [
                        'is_rest_start' => true,
                        'is_shift_end' => true
                    ]
                );
            }
        }

        return view('home');
    }

    public function timein()
    {
        $id = Auth::id();
        $dt = new Carbon();
        $date = $dt->toDateString();
        $time = $dt->toTimeString();

        Shift::create(
            [
                'user_id' => $id,
                'date' => $date,
                'start_time' => $time
            ]
        );

        return redirect('/')->with('message', '出勤打刻が完了しました');
    }

    public function timeout()
    {
        $id = Auth::id();
        $dt = new Carbon();
        $date = $dt->toDateString();
        $time = $dt->toTimeString();

        $endTime = Shift::where('user_id', $id)->latest()->first()->update(
            [
                'end_time' => $time
            ]
        );
        
        return redirect('/')->with(
            [
                'message', '退勤打刻が完了しました'
            ]);
    }

    public function attendance(request $request)
    {
        $num = (int) $request->num;
        $user = Auth::user();
        $dt = new Carbon();
        if ($num == 0) {
            $date = $dt;
        } else if ($num > 0) {
            $date = $dt->addDays($num);
        } else {
            $date = $dt->subDays(-$num);
        }

        $fix_date = $date->toDateString();
        $shifts = Shift::where('date', $fix_date)->Paginate(5);
        $a = Shift::getAttendance($shifts);

        return view(
            'attendance',
            [
                'shifts' => $shifts,
                'fix_date' => $fix_date,
                'num' => $num,
            ]
        );
    }
}