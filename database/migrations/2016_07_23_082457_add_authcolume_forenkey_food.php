<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthcolumeForenkeyFood extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('foods', function (Blueprint $table) {
            $table->integer('auth_id')->unsigned()->default(6);
        });
        Schema::table('foods', function(Blueprint $table) {
            $table->foreign('auth_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn('auth_id');
            $table->dropForeign('foods_auth_id_foreign');
        });
    }

}
