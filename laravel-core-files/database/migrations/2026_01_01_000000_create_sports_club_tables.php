<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id('member_id');
            $table->string('name', 100);
            $table->enum('gender', ['M', 'F']);
            $table->date('dob');
            $table->string('city', 50)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->timestamps();
        });

        Schema::create('member_phones', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('members', 'member_id')->onDelete('cascade');
            $table->string('phone', 20);
            $table->primary(['member_id', 'phone']);
        });

        Schema::create('dependents', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('members', 'member_id')->onDelete('cascade');
            $table->string('dep_name', 100);
            $table->string('relationship', 50);
            $table->date('dob')->nullable();
            $table->primary(['member_id', 'dep_name']);
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->string('name', 100);
            $table->enum('gender', ['M', 'F']);
            $table->date('dob')->nullable();
            $table->string('role', 50);
            $table->timestamps();
        });

        Schema::create('facilities', function (Blueprint $table) {
            $table->id('fac_id');
            $table->string('location', 100);
            $table->integer('capacity')->nullable();
            $table->foreignId('staff_id')->nullable()->constrained('staff', 'staff_id')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('coaches', function (Blueprint $table) {
            $table->id('coach_id');
            $table->string('name', 100);
            $table->enum('gender', ['M', 'F']);
            $table->date('dob')->nullable();
            $table->decimal('salary', 10, 2);
            $table->timestamps();
        });

        Schema::create('sports', function (Blueprint $table) {
            $table->id('sport_id');
            $table->string('sport_name', 100);
            $table->foreignId('fac_id')->nullable()->constrained('facilities', 'fac_id')->onDelete('set null');
            $table->foreignId('coach_id')->nullable()->constrained('coaches', 'coach_id')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('enrolls', function (Blueprint $table) {
            $table->foreignId('member_id')->constrained('members', 'member_id')->onDelete('cascade');
            $table->foreignId('sport_id')->constrained('sports', 'sport_id')->onDelete('cascade');
            $table->date('enroll_date');
            $table->primary(['member_id', 'sport_id']);
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id('pay_id');
            $table->foreignId('member_id')->constrained('members', 'member_id')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('pay_date');
            $table->timestamps();
        });

        Schema::create('equipment', function (Blueprint $table) {
            $table->id('equip_id');
            $table->string('equip_name', 100);
            $table->string('condition_', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('uses', function (Blueprint $table) {
            $table->foreignId('sport_id')->constrained('sports', 'sport_id')->onDelete('cascade');
            $table->foreignId('equip_id')->constrained('equipment', 'equip_id')->onDelete('cascade');
            $table->primary(['sport_id', 'equip_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('uses');
        Schema::dropIfExists('equipment');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('enrolls');
        Schema::dropIfExists('sports');
        Schema::dropIfExists('coaches');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('dependents');
        Schema::dropIfExists('member_phones');
        Schema::dropIfExists('members');
    }
};
