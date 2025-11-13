<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Nurse extends Model
{
    use SoftDeletes, HasFactory, Notifiable;

    protected $fillable = ['hospital_id', 'department_id', 'working_hours', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function qualifications()
    {
        return $this->hasOne(Qualification::class);
    }

}
