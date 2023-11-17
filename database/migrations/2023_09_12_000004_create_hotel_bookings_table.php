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
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer("pet_id")->nullable();
            $table->timestamp('check_in_date');
            $table->timestamp('check_out_date');
            $table->decimal("total_price");
            $table->integer("type_id")->nullable();
            $table->timestamps();

            $table->foreign("pet_id")->references("id")->on("pets");
            $table->foreign("type_id")->references("id")->on("hotel_types");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_bookings');
    }
};
