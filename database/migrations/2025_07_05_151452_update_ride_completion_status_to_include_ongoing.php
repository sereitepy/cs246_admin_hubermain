<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            // MySQL syntax for modifying ENUM
            DB::statement("ALTER TABLE rides MODIFY COLUMN go_completion_status ENUM('pending', 'ongoing', 'completed', 'cancelled') DEFAULT 'pending'");
            DB::statement("ALTER TABLE rides MODIFY COLUMN return_completion_status ENUM('pending', 'ongoing', 'completed', 'cancelled') DEFAULT 'pending'");
        } else {
            // SQLite doesn't support MODIFY COLUMN and doesn't enforce ENUM types
            // SQLite stores ENUM as TEXT, so it already accepts 'ongoing' as a value
            // No changes needed for SQLite
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            // Revert back to original enum values
            DB::statement("ALTER TABLE rides MODIFY COLUMN go_completion_status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending'");
            DB::statement("ALTER TABLE rides MODIFY COLUMN return_completion_status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending'");
        } else {
            // No changes needed for SQLite
        }
    }
};
