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
        Schema::table('departments', function (Blueprint $table) {
            if (!Schema::hasColumn('departments', 'name')) {
                $table->string('name')->unique()->after('id');
            }

            if (!Schema::hasColumn('departments', 'category')) {
                $table->string('category')->nullable()->after('name');
            }

            if (!Schema::hasColumn('departments', 'active')) {
                $table->boolean('active')->default(true)->after('category');
            }

            if (!Schema::hasColumn('departments', 'notes')) {
                $table->text('notes')->nullable()->after('active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            if (Schema::hasColumn('departments', 'notes')) {
                $table->dropColumn('notes');
            }

            if (Schema::hasColumn('departments', 'active')) {
                $table->dropColumn('active');
            }

            if (Schema::hasColumn('departments', 'category')) {
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('departments', 'name')) {
                $table->dropUnique(['name']);
                $table->dropColumn('name');
            }
        });
    }
};
