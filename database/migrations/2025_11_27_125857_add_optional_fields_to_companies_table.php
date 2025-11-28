<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('company_logo')->nullable()->after('company_code');
            $table->string('landline_no')->nullable()->after('contact_no');
            $table->string('pan_no')->nullable()->after('gst_no');
            $table->string('cin_no')->nullable()->after('pan_no');
            $table->string('iec')->nullable()->after('cin_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'company_logo',
                'landline_no',
                'pan_no',
                'cin_no',
                'iec',
            ]);
        });
    }
};
