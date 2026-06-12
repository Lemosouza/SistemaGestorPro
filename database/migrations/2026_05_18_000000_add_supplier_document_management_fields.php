<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            if (!Schema::hasColumn('suppliers', 'category')) {
                $table->string('category')->nullable()->after('document');
            }
            if (!Schema::hasColumn('suppliers', 'contact_name')) {
                $table->string('contact_name')->nullable()->after('category');
            }
            if (!Schema::hasColumn('suppliers', 'contact_email')) {
                $table->string('contact_email')->nullable()->after('contact_name');
            }
            if (!Schema::hasColumn('suppliers', 'contact_phone')) {
                $table->string('contact_phone', 20)->nullable()->after('contact_email');
            }
            if (!Schema::hasColumn('suppliers', 'address')) {
                $table->string('address')->nullable()->after('contact_phone');
            }
            if (!Schema::hasColumn('suppliers', 'notes')) {
                $table->text('notes')->nullable()->after('address');
            }
        });

        Schema::table('documents', function (Blueprint $table) {
            if (!Schema::hasColumn('documents', 'file_path')) {
                $table->string('file_path')->nullable()->after('document_type');
            }
            if (!Schema::hasColumn('documents', 'original_name')) {
                $table->string('original_name')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('documents', 'expiration_date')) {
                $table->date('expiration_date')->nullable()->after('upload_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            foreach (['expiration_date', 'original_name', 'file_path'] as $column) {
                if (Schema::hasColumn('documents', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('suppliers', function (Blueprint $table) {
            foreach (['notes', 'address', 'contact_phone', 'contact_email', 'contact_name', 'category'] as $column) {
                if (Schema::hasColumn('suppliers', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
