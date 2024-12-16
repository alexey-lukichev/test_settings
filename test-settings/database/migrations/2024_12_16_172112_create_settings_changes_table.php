<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsChangesTable extends Migration
{
    public function up(): void
    {
        Schema::create('settings_changes', function (Blueprint $table): void
        {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('setting_id')->constrained()->onDelete('cascade');
            $table->string('new_value');
            $table->string('confirmation_code');
            $table->enum('method', ['sms', 'email', 'telegram']);
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings_changes');
    }
};
