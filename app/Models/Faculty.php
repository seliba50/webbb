<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_name',
        'institute_id'
    ];
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    public function course(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
