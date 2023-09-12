<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('appointment_date');
            $table->decimal("total_price");
            $table->unsignedBigInteger("pet_id")->nullable();
            $table->unsignedBigInteger("service_id")->nullable();
            $table->timestamps();

            $table->foreign("service_id")->references("id")->on("services");
            $table->foreign("pet_id")->references("id")->on("pets");


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_appointments');
    }
};
