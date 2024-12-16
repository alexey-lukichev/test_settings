<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserMain extends Model
{
    use HasFactory;

    public function settings(): HasMany
    {
        return $this->hasMany(Setting::class);
    }

    public function settingsChanges(): HasMany
    {
        return $this->hasMany(SettingsChange::class);
    }
}
