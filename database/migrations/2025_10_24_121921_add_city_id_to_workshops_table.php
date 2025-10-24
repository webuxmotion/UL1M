<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Workshop;
use App\Models\City;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add city_id column (nullable temporarily)
        Schema::table('workshops', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('name')->constrained()->onDelete('restrict');
        });

        // Migrate existing city names to cities table
        $workshops = Workshop::all();
        foreach ($workshops as $workshop) {
            if ($workshop->city) {
                // Find or create city
                $city = City::firstOrCreate(['name' => $workshop->city]);
                $workshop->city_id = $city->id;
                $workshop->save();
            }
        }

        // Remove old city column
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropColumn('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back city column
        Schema::table('workshops', function (Blueprint $table) {
            $table->string('city')->after('name');
        });

        // Migrate data back
        $workshops = Workshop::with('city')->get();
        foreach ($workshops as $workshop) {
            if ($workshop->city) {
                $workshop->city = $workshop->city->name;
                $workshop->save();
            }
        }

        // Drop city_id column
        Schema::table('workshops', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
