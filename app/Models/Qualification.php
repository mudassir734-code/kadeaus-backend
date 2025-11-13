<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Qualification extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = ['degree', 'institute', 'start_date', 'end_date', 'total_marks_CGPA', 'achieved_marks_CGPA', 'attachment', 'nurse_id', 'hospital_id', 'doctor_id', 'pharmacist_id', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function nurses()
    {
        return $this->belongsTo(Nurse::class);
    }

    public function hospitals()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function pharmacist()
    {
        return $this->belongsTo(Nurse::class);
    }
    // public function doctor()
    // {
    //     return $this->hasMany(Doctor::class);
    // }

}
