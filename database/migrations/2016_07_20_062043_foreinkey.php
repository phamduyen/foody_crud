<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Foreinkey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::table('password_resets', function(Blueprint $table) {
            $table->foreign('email')
                    ->references('email')
                    ->on('users')
                    ->onDelete('restrict')
                    ->onUpdate('restrict');
        });
        Schema::table('foods', function(Blueprint $table) {
            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('role')
                    ->references('id')
                    ->on('roles')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('password_resets', function(Blueprint $table) {
            $table->dropForeign('password_resets_email_foreign');
        });
        Schema::table('foods', function(Blueprint $table) {
            $table->dropForeign('foods_category_id_foreign');
        });
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_role_foreign');
        });
    }
}
