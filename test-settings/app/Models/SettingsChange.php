<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettingsChange extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'setting_id', 'new_value', 'confirmation_code', 'method', 'is_confirmed'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserMain::class);
    }

    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class);
    }
}
