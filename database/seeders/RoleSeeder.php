<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Réinitialiser le cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Créer les permissions (pour plus tard)
        // $permissions = [
        //     'stand.create', 'stand.update', 'stand.delete',
        //     'product.create', 'product.update', 'product.delete',
        //     'lead.view', 'lead.respond',
        //     'message.send',
        // ];
        // foreach ($permissions as $perm) {
        //     Permission::create(['name' => $perm]);
        // }

        // Créer les rôles
        $roles = [
            'admin',
            'buyer',
            'seller',
            'delivery_person',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Assigner toutes les permissions à admin (quand les perms seront créées)
        // $adminRole = Role::findByName('admin');
        // $adminRole->givePermissionTo(Permission::all());
    }
}
