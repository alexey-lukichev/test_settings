<?php

namespace App\Http\Controllers;

use App\Models\SettingsChange;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingsChangeController extends Controller
{
    public function requestChange(Request $request)
    {
        $validated = $request->validate([
            'setting_id' => 'required|exists:settings,id',
            'new_value' => 'required',
            'method' => 'required|in:sms,email,telegram'
        ]);

        // Генерация кода подтверждения
        $confirmationCode = Str::random(6);

        // Создание записи о смене настройки
        SettingsChange::create([
            'user_id' => Auth::id(),
            'setting_id' => $validated['setting_id'],
            'new_value' => $validated['new_value'],
            'confirmation_code' => $confirmationCode,
            'method' => $validated['method'],
            'is_confirmed' => false,
        ]);

        // Отправка уведомления в зависимости от метода
        // $this->sendNotification($validated['method'], $confirmationCode);

        return response()->json(['message' => 'Код подтверждения отправлен.']);
    }

    public function confirmChange(Request $request)
    {
        $validated = $request->validate([
            'confirmation_code' => 'required',
            'setting_id' => 'required|exists:settings,id',
        ]);

        $change = SettingsChange::where('confirmation_code', $validated['confirmation_code'])
            ->where('setting_id', $validated['setting_id'])
            ->where('is_confirmed', false)
            ->firstOrFail();

        // Сохранение нового значения
        $setting = Setting::find($validated['setting_id']);
        $setting->value = $change->new_value;
        $setting->save();

        // Обновление статуса изменения
        $change->is_confirmed = true;
        $change->save();

        return response()->json(['message' => 'Настройка успешно изменена.']);
    }
}
