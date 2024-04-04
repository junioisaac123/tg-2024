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
            $table->string('username', 20)->unique()->default(((int) (microtime(true) * 1000)))->after('id');
            $table->string('last_name', 45)->nullable()->after('first_name');
            $table->string('phone', 20)->nullable()->after('last_name');
            $table->string('document_type', 20)->nullable()->after('phone');
            $table->string('document_number', 20)->nullable()->after('document_type');
            $table->integer('elo')->default(0)->after('document_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $columnsToDrop = ['username', 'last_name', 'phone', 'document_type', 'document_number', 'elo'];
        Schema::table('users', function (Blueprint $table) use ($columnsToDrop) {
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
