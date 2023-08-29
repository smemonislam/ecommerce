<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smtp extends Model
{
    use HasFactory;
    protected $fillable = ['mailer', 'host', 'port', 'username', 'password'];
}
