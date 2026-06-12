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
        Schema::table('page_sections', function (Blueprint $table) {
            $table->unsignedInteger('order')->default(0)->after('is_active');
        });

        // Seed initial order by insertion sequence within each page group
        $pages = DB::table('page_sections')->distinct()->pluck('page');
        foreach ($pages as $page) {
            $ids = DB::table('page_sections')->where('page', $page)->orderBy('id')->pluck('id');
            foreach ($ids as $i => $id) {
                DB::table('page_sections')->where('id', $id)->update(['order' => $i + 1]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
