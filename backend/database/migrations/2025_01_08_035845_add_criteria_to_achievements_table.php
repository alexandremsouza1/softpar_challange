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
        Schema::table('achievements', function (Blueprint $table) {
            $table->integer('task_count')->nullable()->after('points');
            $table->integer('time_limit')->nullable()->after('task_count');
            $table->integer('weekly_task_count')->nullable()->after('time_limit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn('task_count');
            $table->dropColumn('time_limit');
            $table->dropColumn('weekly_task_count');
        });
    }
};
