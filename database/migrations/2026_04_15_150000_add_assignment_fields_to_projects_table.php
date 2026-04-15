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
        Schema::table('projects', function (Blueprint $table) {
            if (! Schema::hasColumn('projects', 'description')) {
                $table->text('description')->nullable()->after('title');
            }

            if (! Schema::hasColumn('projects', 'status')) {
                $table->string('status')->nullable()->after('description');
            }

            if (! Schema::hasColumn('projects', 'department')) {
                $table->string('department')->nullable()->after('status');
            }

            if (! Schema::hasColumn('projects', 'start_date')) {
                $table->date('start_date')->nullable()->after('department');
            }

            if (! Schema::hasColumn('projects', 'end_date')) {
                $table->date('end_date')->nullable()->after('start_date');
            }

            if (! Schema::hasColumn('projects', 'assigned_employee_ids')) {
                $table->json('assigned_employee_ids')->nullable()->after('end_date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (Schema::hasColumn('projects', 'assigned_employee_ids')) {
                $table->dropColumn('assigned_employee_ids');
            }

            if (Schema::hasColumn('projects', 'end_date')) {
                $table->dropColumn('end_date');
            }

            if (Schema::hasColumn('projects', 'start_date')) {
                $table->dropColumn('start_date');
            }

            if (Schema::hasColumn('projects', 'department')) {
                $table->dropColumn('department');
            }

            if (Schema::hasColumn('projects', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('projects', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
