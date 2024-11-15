<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Institute extends Model
{
    use HasFactory;
    protected $fillable = [
        'location',
        'email',
        'phone',
        'user_id',
        'institute_name'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function faculty(): HasMany
    {
        return $this->hasMany(Faculty::class);
    }
    public function control(): HasOne
    {
        return $this->hasOne(Control::class);
    }
}
