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
            $table->integer('id')->primary();
            $table->integer("pet_id")->nullable();
            $table->timestamp('appointment_date');
            $table->integer("service_id")->nullable();
            $table->decimal("total_price");
            $table->timestamps();

            $table->foreign("pet_id")->references("id")->on("pets");
            $table->foreign("service_id")->references("id")->on("services");
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
