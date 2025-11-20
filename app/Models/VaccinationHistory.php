<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccinationHistory extends Model
{
    use SoftDeletes, Notifiable, HasFactory;

    protected $fillable = [
        'user_id',
        'vaccine_name',
        'type',
        'administered_date',
        'next_due_date',
        'hospital',
        'proof_file',
        'note',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function boosters()
    {
        return $this->hasMany(VaccinationBooster::class, 'vaccination_id');
    }


}

