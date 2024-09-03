<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->unsigned();
        });
    }

    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
        });
    }
};
