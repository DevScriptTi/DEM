<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('status', ['pending', 'completed', 'rejected', 'on diagnostic']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('demands');
    }
};
