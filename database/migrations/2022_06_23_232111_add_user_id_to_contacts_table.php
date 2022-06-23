<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (! Schema::hasColumn('contacts', 'user_id')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable();

                $table->foreign('user_id')
                    ->on('users')
                    ->references('id')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
