<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordReset extends Model
{
    use HasFactory;use SoftDeletes;
    protected $table='password_resets';
    protected $fillable=[
        'email',
        'token',
    ];
}
