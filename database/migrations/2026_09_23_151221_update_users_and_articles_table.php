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
            $table->string('avatar')->nullable()->after('bio');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->longText('content')->change();
            $table->string('status')->default('published')->after('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->string('content', 255)->change();
            $table->dropColumn('status');
        });
    }
};
