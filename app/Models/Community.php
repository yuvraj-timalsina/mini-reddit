<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description'];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class);
    }
}
