<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class RenameCertificateTable extends Migration
{
    public function up(): void
    {
        Schema::rename('certificati', 'certificates');
    }

    public function down(): void
    {
        Schema::rename('certificates', 'certificati');
    }
}
