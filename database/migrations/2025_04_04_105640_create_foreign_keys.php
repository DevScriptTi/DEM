<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('baladiyas', function (Blueprint $table) {
            $table->foreignId('wilaya_id')
                  ->nullable()
                  ->constrained('wilayas')
                  ->onDelete('cascade');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->foreignId('baladiya_id')
                  ->nullable()
                  ->constrained('baladiyas')
                  ->onDelete('cascade');

            $table->foreignId('speciality_id')
                  ->nullable()
                  ->constrained('specialities')
                  ->onDelete('cascade');
        });

        Schema::table('doctor_helpers', function (Blueprint $table) {
            $table->foreignId('doctor_id')
                  ->nullable()
                  ->constrained('doctors')
                  ->onDelete('cascade');
        });

        Schema::table('pharmacies', function (Blueprint $table) {
            $table->foreignId('baladiya_id')
                  ->nullable()
                  ->constrained('baladiyas')
                  ->onDelete('cascade');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->foreignId('baladiya_id')
                  ->nullable()
                  ->constrained('baladiyas')
                  ->onDelete('cascade');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('doctor_id')
                  ->nullable()
                  ->constrained('doctors')
                  ->onDelete('cascade');

            $table->foreignId('patient_id')
                  ->nullable()
                  ->constrained('patients')
                  ->onDelete('cascade');
        });

        Schema::table('queues', function (Blueprint $table) {
            $table->foreignId('doctor_id')
                  ->nullable()
                  ->constrained('doctors')
                  ->onDelete('cascade');

            $table->foreignId('current_demand_id')
                  ->nullable()
                  ->constrained('demands')
                  ->onDelete('cascade');
        });

        Schema::table('demands', function (Blueprint $table) {
            $table->foreignId('queue_id')
                  ->nullable()
                  ->constrained('queues')
                  ->onDelete('cascade');

            $table->foreignId('patient_id')
                  ->nullable()
                  ->constrained('patients')
                  ->onDelete('cascade');
        });

        Schema::table('prescriptions', function (Blueprint $table) {
            $table->foreignId('pharmacy_id')
                  ->nullable()
                  ->constrained('pharmacies')
                  ->onDelete('cascade');

            $table->foreignId('doctor_id')
                  ->nullable()
                  ->constrained('doctors')
                  ->onDelete('cascade');

            $table->foreignId('patient_id')
                  ->nullable()
                  ->constrained('patients')
                  ->onDelete('cascade');
        });

        Schema::table('medicines', function (Blueprint $table) {
            $table->foreignId('prescription_id')
                  ->nullable()
                  ->constrained('prescriptions')
                  ->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('key_id')
                  ->nullable()
                  ->constrained('keys')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('baladiyas', function (Blueprint $table) {
            $table->dropForeign(['wilaya_id']);
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['baladiya_id']);
            $table->dropForeign(['speciality_id']);
        });

        Schema::table('doctor_helpers', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
        });

        Schema::table('pharmacies', function (Blueprint $table) {
            $table->dropForeign(['baladiya_id']);
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['baladiya_id']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['patient_id']);
        });

        Schema::table('queues', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['current_demand_id']);
        });

        Schema::table('demands', function (Blueprint $table) {
            $table->dropForeign(['queue_id']);
            $table->dropForeign(['patient_id']);
        });

        Schema::table('prescriptions', function (Blueprint $table) {
            $table->dropForeign(['pharmacy_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['patient_id']);
        });

        Schema::table('medicines', function (Blueprint $table) {
            $table->dropForeign(['prescription_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['key_id']);
        });
    }
};
