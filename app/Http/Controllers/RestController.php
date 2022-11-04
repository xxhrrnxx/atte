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
        $id = Auth::id();
        $shiftId = $shift->id;
        $dt = new Carbon();
        $time = $dt->toTimeString();

                Rest::create([
                    'shift_id' => $shiftId,
                    'start_time' => $time
                ]);
                return redirect()->back()->with('message', '休憩を開始しました');
    }

    public function breakout() {
        $shift = Shift::getShift();
        $shiftId = $shift->id;
        $dt = new Carbon();
        $time = $dt->toTimeString();
        $breakOut = Rest::where('shift_id',$shiftId)->latest()->first()->update([
            'end_time' => $time
        ]);

        return redirect()->back()->with('message', '休憩が終了しました');
    }
}