<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // adiciona coluna two_factor_secret depois de use_senha
            $table->text('two_factor_secret')
                  ->nullable()
                  ->after('use_senha');

            // adiciona coluna two_factor_recovery_codes depois de two_factor_secret
            $table->text('two_factor_recovery_codes')
                  ->nullable()
                  ->after('two_factor_secret');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['two_factor_secret', 'two_factor_recovery_codes']);
        });
    }
};
