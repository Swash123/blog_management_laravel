<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('comments', function (Blueprint $table) {
            // Add your new column after an existing column
            $table->unsignedBigInteger('replied_to')->nullable()->after('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('your_table', function (Blueprint $table) {
            // If you need to rollback, define how to reverse the changes here
            $table->dropColumn('replied_to');
        });
    }
};
