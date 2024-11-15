<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'user_id',
        'national_id'
    ];
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function application(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
