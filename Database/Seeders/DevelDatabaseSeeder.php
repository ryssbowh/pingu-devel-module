<?php

namespace Pingu\Devel\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Pingu\Menu\Entities\Menu;
use Pingu\Menu\Entities\MenuItem;
use Pingu\Permissions\Entities\Permission;

class DevelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = MenuItem::findByName('admin-menu.devel');
        if(!$item){
            $perm = Permission::findOrCreate(['name' => 'view routes', 'section' => 'Devel']);
            $menu = Menu::findByName('admin-menu');
            $item = MenuItem::create([
                'name' => 'Devel',
                'active' => 1,
                'deletable' => 0
            ], $menu);

            $item2 = MenuItem::create([
                'name' => 'Routes',
                'deletable' => 0,
                'active' => 1,
                'permission_id' => $perm->id,
                'url' => 'devel.admin.routes'
            ], $menu, $item);
            $perm = Permission::findByName('put site in maintenance mode');
            $item2 = MenuItem::create([
                'name' => 'Maintenance',
                'deletable' => 0,
                'active' => 1,
                'permission_id' => $perm->id,
                'url' => 'devel.admin.maintenance'
            ], $menu, $item);
        }
    }
}
