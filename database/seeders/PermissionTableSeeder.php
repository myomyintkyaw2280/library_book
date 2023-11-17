<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',

           'book-list',
           'book-create',
           'book-edit',
           'book-delete',

           'member-list',
           'member-create',
           'member-edit',
           'member-delete',

           'category-list',
           'category-create',
           'category-edit',
           'category-delete',

           'issue-list',
           'issue-create',
           'issue-edit',
           'issue-delete',

           'issue-detail-list',
           'issue-detail-create',
           'issue-detail-edit',
           'issue-detail-delete',

           'user-list',
           'user-create',
           'user-edit',
           'user-delete'
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
