<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->integer('total_book')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->default(0)->comment('0 is rent out, 1 is return completed and 2 is pending');
            $table->integer('approved_by')->comment('Admin user will approve to rent a book to the member');
            $table->dateTime('approved_at')->nullable();
            $table->integer('received_by')->comment('Admin user will approve to rent a book to the member');
            $table->dateTime('received_at')->nullable();
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
        Schema::dropIfExists('issues');
    }
}
