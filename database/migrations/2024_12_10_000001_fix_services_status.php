<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update NULL or empty status to 'inactive'
        DB::table('services')
            ->whereNull('status')
            ->orWhere('status', '')
            ->update(['status' => 'inactive']);
    }

    public function down(): void
    {
        // No destructive down action needed
    }
};

