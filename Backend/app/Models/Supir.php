<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_register',
        'nama_lengkap',
        'alamat',
        'jenis_kelamin'
    ];
}
