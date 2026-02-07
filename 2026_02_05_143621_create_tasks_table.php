<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('status')->default('pending');
        $table->date('due_date')->nullable();
        $table->timestamps();
    });
