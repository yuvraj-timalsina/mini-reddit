<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'name', 'description'];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }
}
