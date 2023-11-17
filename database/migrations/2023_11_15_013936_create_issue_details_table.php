<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_details', function (Blueprint $table) {
            $table->id();
            $table->integer('issue_id');
            $table->integer('book_id')->nullable();
            $table->timestamp('issue_date')->nullable();
            $table->dateTime('return_date')->nullable();
            $table->float('fee')->default(0);
            $table->text('address')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('issue_details');
    }
}
