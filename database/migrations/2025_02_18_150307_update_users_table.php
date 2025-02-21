<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
            $table->string('cpf', 14)->unique();
            $table->string('telefone', 20);
            $table->boolean('administrador')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('email_verified_at');
            $table->dropColumn('cpf');
            $table->dropColumn('telefone');
            $table->dropColumn('administrador');
        });
    }
};
