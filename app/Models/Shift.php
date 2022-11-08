<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time'];

    public function rests()
    {
        return $this->hasMany('App\Models\Rest');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', "user_id");
    }

    public static function getShift()
    {
        $id = Auth::id();
        $dt = new Carbon();
        $date = $dt->toDateString();
        $shift = Shift::where('user_id', $id)->where('date', $date)->first();
        return $shift;
    }

    public static function getAttendance($shifts)
    {
        foreach ($shifts as $index => $shift) {
            $sum = 0;
            $rests = $shift->rests;
            foreach ($rests as $rest) {
                $restStartTime = new Carbon($rest->start_time);
                $restEndTime = new Carbon($rest->end_time);
                $restTime = $restStartTime->diffInSeconds($restEndTime);
                $sum = $sum + $restTime;
            }

            $workStartTime = new Carbon($shift->start_time);
            $workEndTime = new Carbon($shift->end_time);
            $stayTime = $workStartTime->diffInSeconds($workEndTime);
            $workingTime = $stayTime - $sum;

            $restHours = floor($sum / 3600);
            $restMinutes = floor(($sum / 60) % 60);
            $restSeconds = floor($sum % 60);
            $sum = sprintf("%02d:%02d:%02d", $restHours, $restMinutes, $restSeconds);

            $workHours = floor($workingTime / 3600);
            $workMinutes = floor(($workingTime / 60) % 60);
            $workSeconds = floor($workingTime % 60);
            $workingTime = sprintf("%02d:%02d:%02d", $workHours, $workMinutes, $workSeconds);

            $shifts[$index]->work_time = $workingTime;
            $shifts[$index]->rest_sum = $sum;
        }

        return $shifts;
    }
}