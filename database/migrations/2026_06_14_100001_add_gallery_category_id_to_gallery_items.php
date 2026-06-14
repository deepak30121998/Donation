<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->foreignId('gallery_category_id')
                ->nullable()
                ->after('title')
                ->constrained('gallery_categories')
                ->nullOnDelete();
        });

        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table) {
            $table->dropForeign(['gallery_category_id']);
            $table->dropColumn('gallery_category_id');
            $table->string('category')->default('all');
        });
    }
};
