<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->string('responsible_person')->nullable();
            $table->date('deadline')->nullable();
            $table->string('project')->nullable();
            $table->tinyinteger('time_tracking')->nullable();
            $table->timestamp('reminder_date')->nullable();
            $table->string('reminder_notes')->nullable();
            $table->tinyinteger('reminder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
