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
        if (Schema::hasColumn('users', 'name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('name', 45)->change();
                $table->renameColumn('name', 'first_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'first_name')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('first_name', 255)->change();
                $table->renameColumn('first_name', 'name');
            });
        }
    }
};
