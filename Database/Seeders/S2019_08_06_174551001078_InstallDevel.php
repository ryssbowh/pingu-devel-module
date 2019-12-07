<?php

use Pingu\Core\Seeding\DisableForeignKeysTrait;
use Pingu\Core\Seeding\MigratableSeeder;
use Pingu\Menu\Entities\Menu;
use Pingu\Menu\Entities\MenuItem;
use Pingu\Permissions\Entities\Permission;

class S2019_08_06_174551001078_InstallDevel extends MigratableSeeder
{
    use DisableForeignKeysTrait;

    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $perm = Permission::findOrCreate(['name' => 'view routes', 'section' => 'Devel']);
        $menu = Menu::findByMachineName('admin-menu');
        $item = MenuItem::create(
            [
            'name' => 'Devel',
            'active' => 1,
            'deletable' => 0
            ], $menu
        );

        $item2 = MenuItem::create(
            [
            'name' => 'Routes',
            'deletable' => 0,
            'active' => 1,
            'permission_id' => $perm->id,
            'url' => 'devel.admin.routes'
            ], $menu, $item
        );
        $perm = Permission::findOrCreate(['name' => 'put site in maintenance mode', 'section' => 'Devel']);
        $item2 = MenuItem::create(
            [
            'name' => 'Maintenance',
            'deletable' => 0,
            'active' => 1,
            'permission_id' => $perm->id,
            'url' => 'devel.admin.maintenance'
            ], $menu, $item
        );
    }

    /**
     * Reverts the database seeder.
     */
    public function down(): void
    {
        if($item = MenuItem::where('machineName', 'admin-menu.devel.maintenance')->first()) {
            $item->delete();
        }
        if($item = MenuItem::where('machineName', 'admin-menu.devel.routes')->first()) {
            $item->delete();
        }
        if($item = MenuItem::where('machineName', 'admin-menu.devel')->first()) {
            $item->delete();
        }
        if($perm = Permission::where('name', 'view routes')->first()) {
            $perm->delete();
        }
        if($perm = Permission::where('name', 'put site in maintenance mode')->first()) {
            $perm->delete();
        }
    }
}
