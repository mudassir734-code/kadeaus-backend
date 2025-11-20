<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class VaccinationTracking extends Model
{
    use SoftDeletes, Notifiable, HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'primary_dose_date',
        'status',
        'hospital',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vaccinationBooster()
    {
        return $this->hasMany(VaccinationBooster::class, 'vaccination_tracking_id');
    }
}
