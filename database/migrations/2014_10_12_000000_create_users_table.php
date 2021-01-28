<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('child', ['1_child', '2_child', 'none'])->nullable();
            $table->string('mobile')->nullable();
            $table->string('emergency_contact_no')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('birth_date')->nullable();
            $table->enum('marital_status', ['single', 'married'])->nullable();
            $table->string('designation')->nullable();
            $table->string('nationality')->nullable();
            $table->text('about_us')->nullable();
            $table->string('emirates_id')->nullable();
            $table->integer('trainer_id')->nullable();
            $table->integer('trainer_slot')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('payment_params')->nullable();
            $table->string('parent_id')->default(0);
            $table->string('workplace')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('hotel_room_no')->nullable();
            $table->string('duration_of_stay')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->integer('guest_sessions')->default(0);
//            $table->string('how_did_you_hear_about_us')->nullable();
            $table->enum('gender', ['male', 'female'])->default()->nullable();
            $table->enum('status', [0, 1])->default(0)->comment('0->Unactive, 1->Active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }

}
