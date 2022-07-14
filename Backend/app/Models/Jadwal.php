<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'supir_id',
        'rute_id',
        'berangkat',
        'tiba',
        'status',
    ];

    // protected $guarded = [];

    const NGY = "NGY";
    const OTW = "OTW";
    const AAD = "AAD";
    const CANCEL = "CANCEL";
}
