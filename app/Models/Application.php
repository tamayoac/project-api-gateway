<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Application extends Model
{
    use HasFactory;

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class, 'application_users', 'application_id', 'user_id');
    }
}
