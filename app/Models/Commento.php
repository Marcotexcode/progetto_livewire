<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commento extends Model
{
    use HasFactory;

    protected $table = 'commenti';

    protected $guarded = [];

    public function utente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
