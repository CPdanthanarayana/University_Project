<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_no',
        'type',
        'capacity',
        'driver',
        'fuel',
        'insurance_expiry',
        'status'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }


}
