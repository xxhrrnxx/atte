<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Shift;
use App\Models\Rest;

class RestController extends Controller
{
    public function breakin() {
        $shift = Shift::getShift();
        $shiftId = $shift->id;
        $dt = new Carbon();
        $time = $dt->toTimeString();

        Rest::create([
            'shift_id' => $shiftId,
            'start_time' => $time
        ]);

        return redirect('/')->with([
            'message' => '休憩を開始しました',
            'is_shift_start' => true,
            'is_shift_end' => true,
            'is_rest_start' => true,
            'is_rest_end' => false,
        ]);
    }

    public function breakout() {
        $shift = Shift::getShift();
        $shiftId = $shift->id;
        $dt = new Carbon();
        $time = $dt->toTimeString();

        Rest::where('shift_id',$shiftId)->latest()->first()->update([
            'end_time' => $time
        ]);

        return redirect('/')->with([
            'message' => '休憩を終了しました',
            'is_shift_start' => true,
            'is_shift_end' => false,
            'is_rest_start' => false,
            'is_rest_end' => true,
        ]);
    }
}