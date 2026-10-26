<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('kind', 20)->nullable()->after('parent_id');
        });

        Schema::table('stands', function (Blueprint $table) {
            $table->string('kind', 20)->default('product')->after('stand_name');
        });

        $kinds = [
            'produits' => 'product',
            'intrants-agricoles' => 'product',
            'services' => 'service',
            'alimentation-et-hotellerie' => 'service',
            'immobilier' => 'service',
            'evenements' => 'service',
            'sante-et-medical' => 'service',
            'construction' => 'service',
        ];

        foreach ($kinds as $slug => $kind) {
            DB::table('categories')->where('slug', $slug)->update(['kind' => $kind]);
        }
    }

    public function down(): void
    {
        Schema::table('stands', function (Blueprint $table) {
            $table->dropColumn('kind');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('kind');
        });
    }
};
