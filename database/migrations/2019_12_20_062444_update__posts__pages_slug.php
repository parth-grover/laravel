<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsPagesSlug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('slug',255)->after('thumbnail')->nullable();
			$table->dropColumn('category_id');
        });
		
		Schema::table('pages', function (Blueprint $table) {
            $table->string('slug',255)->after('status')->nullable();
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('slug');
			$table->bigInteger('category_id');
        });
		
		Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
