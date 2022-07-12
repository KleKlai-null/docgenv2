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
        Schema::create('return_slips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('document_series_no');
            $table->string('department');
            $table->string('mr_no');
            $table->foreignUuid('withdrawal_slip_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('withdrawal_slip_no');
            $table->string('prepared_by');
            $table->string('approved_by');
            $table->string('received_by');
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
        Schema::dropIfExists('return_slips');
    }
};
