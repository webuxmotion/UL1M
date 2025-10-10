<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'workshop_admin', 'user'])->default('user')->after('password');
            $table->foreignId('workshop_id')->nullable()->constrained()->onDelete('set null')->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['workshop_id']);
            $table->dropColumn(['role', 'workshop_id']);
        });
    }
};
