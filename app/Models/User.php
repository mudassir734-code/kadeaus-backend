<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'phone', 'dob', 'gender', 'password', 'address', 'country', 'city', 'state', 'zipcode', 'added_by'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function hospital()
    {
        return $this->hasOne(Hospital::class);
    }

    public function nurse()
    {
        return $this->hasOne(Nurse::class);
    }

    public function parmacist()
    {
        return $this->hasOne(Pharmacist::class);
    }

    public function prescriptionReport()
    {
        return $this->hasOne(PrescriptionReport::class);
    }

    public function qualification()
    {
        return $this->hasOne(Qualification::class);
    }

    public function receptionis()
    {
        return $this->hasOne(Receptionist::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
