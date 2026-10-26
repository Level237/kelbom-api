<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Alignement schéma avec onboarding stand simplifié (P0).
     * Pour les bases déjà migrées avant la refonte des fichiers create_*.
     */
    public function up(): void
    {
        if (Schema::hasTable('users') && $this->indexExists('users', 'users_name_unique')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropUnique(['name']);
            });
        }

        if (Schema::hasTable('stands')) {
            $legacyColumns = array_filter(
                ['logo', 'cover'],
                fn (string $column) => Schema::hasColumn('stands', $column)
            );

            if ($legacyColumns !== []) {
                Schema::table('stands', function (Blueprint $table) use ($legacyColumns) {
                    $table->dropColumn($legacyColumns);
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('name');
            });
        }

        if (Schema::hasTable('stands')) {
            Schema::table('stands', function (Blueprint $table) {
                if (! Schema::hasColumn('stands', 'logo')) {
                    $table->string('logo')->nullable();
                }
                if (! Schema::hasColumn('stands', 'cover')) {
                    $table->string('cover')->nullable();
                }
            });
        }
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $connection = Schema::getConnection();
        $driver = $connection->getDriverName();

        if ($driver === 'sqlite') {
            $indexes = $connection->select("PRAGMA index_list('{$table}')");

            return collect($indexes)->contains(fn ($row) => ($row->name ?? null) === $indexName);
        }

        if ($driver === 'mysql') {
            $database = $connection->getDatabaseName();
            $result = $connection->select(
                'SELECT 1 FROM information_schema.statistics WHERE table_schema = ? AND table_name = ? AND index_name = ? LIMIT 1',
                [$database, $table, $indexName]
            );

            return count($result) > 0;
        }

        return false;
    }
};
