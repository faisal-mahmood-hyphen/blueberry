<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name'=>'Super Admin'],
            ['name'=>'Admin'],
            ['name'=>'User'],
            ['name'=>'B2B'],
        ];
        foreach ($roles as $role){
            Role::updateOrCreate($role,$role);
        }
        $modulesAndPermissions = [
            [
                'name'=>'Users',
                'url'=>'admin/users',
                'active'=>'users',
                'icon'=>'user-tie',
                'permissions'=>[
                    'Read User',
                    'Add New User',
                    'Edit user',
                    'Delete User',
                ],
            ],
            [
                'name'=>'Customers',
                'url'=>'admin/customers',
                'active'=>'customers',
                'icon'=>'users',
                'permissions'=>[
                    'Read Customer',
                    'Add New Customer',
                    'Edit Customer',
                    'Delete Customer',
                ],
            ],
            [
                'name'=>'B2B User',
                'url'=>'admin/b2bs',
                'active'=>'b2bs',
                'icon'=>'user-friends',
                'permissions'=>[
                    'Read B2B',
                    'Add New B2B',
                    'Edit B2B',
                    'Delete B2B',
                ],
            ],
            [
                'name'=>'Roles',
                'url'=>'admin/roles',
                'active'=>'roles',
                'icon'=>'key',
                'permissions'=>[
                    'Read Role',
                    'Add New Role',
                    'Edit Role',
                    'Delete Role',
                    'Assign Permission',
                ],
            ],
            [
                'name'=>'Features',
                'url'=>'admin/features',
                'active'=>'features',
                'icon'=>'tag',
                'permissions'=>[
                    'Read Feature',
                    'Add New Feature',
                    'Edit Feature',
                    'Delete Feature',
                ],
            ],
            [
                'name'=>'Categories',
                'url'=>'admin/categories',
                'active'=>'categories',
                'icon'=>'layer-group',
                'permissions'=>[
                    'Read Category',
                    'Add New Category',
                    'Edit Category',
                    'Delete Category',
                ],
            ],
            [
                'name'=>'Countries',
                'url'=>'admin/countries',
                'active'=>'countries',
                'icon'=>'globe',
                'permissions'=>[
                    'Read Country',
                    'Edit Country',
                    'Read State',
                    'Edit State',
                    'Read City',
                    'Edit City',
                ],
            ],
            [
                'name'=>'Car Brands',
                'url'=>'admin/car-brands',
                'active'=>'brands',
                'icon'=>'car',
                'permissions'=>[
                    'Read Brand',
                    'Add New Brand',
                    'Edit Brand',
                    'Delete Brand',
                ],
            ],
            [
                'name'=>'Car Models',
                'url'=>'admin/car-models',
                'active'=>'models',
                'icon'=>'car',
                'permissions'=>[
                    'Read Car Model',
                    'Add New Car Model',
                    'Edit Car Model',
                    'Delete Car Model',
                ],
            ],
            [
                'name'=>'Car Trims',
                'url'=>'admin/car-trims',
                'active'=>'trims',
                'icon'=>'cogs',
                'permissions'=>[
                    'Read Trim',
                    'Add New Trim',
                    'Edit Trim',
                    'Delete Trim',
                ],
            ],
            [
                'name'=>'Car Body Types',
                'url'=>'admin/car-body-types',
                'active'=>'car-body-types',
                'icon'=>'car-side',
                'permissions'=>[
                    'Read Body Types',
                    'Add New Body Types',
                    'Edit Body Types',
                    'Delete Body Types',
                ],
            ],
            [
                'name'=>'Cars',
                'url'=>'admin/cars',
                'active'=>'cars',
                'icon'=>'car',
                'permissions'=>[
                    'Read Car',
                    'Add New Car',
                    'Edit Car',
                    'Delete Car',
                    'Show Car',
                ],
            ],
            [  'name'=>'Property',
                'url'=>'admin/properties',
                'active'=>'properties',
                'icon'=>'building',
                'permissions'=>[
                    'Read Property',
                    'Add New Property',
                    'Edit Property',
                    'Delete Property',
                    'Show Property',
                ],
            ],
            [  'name'=>'Coupons',
                'url'=>'admin/coupons',
                'active'=>'coupons',
                'icon'=>'ticket-alt',
                'permissions'=>[
                    'Read Coupon',
                    'Add New Coupon',
                    'Edit Coupon',
                    'Delete Coupon',
                    'Show Coupon',
                    'Assign Coupon',
                ],
            ],[  'name'=>'Companies',
                'url'=>'admin/companies',
                'active'=>'companies',
                'icon'=>'industry',
                'permissions'=>[
                    'Read Company',
                    'Edit Company',
                ],
            ],
        ];
        foreach ($modulesAndPermissions as $modulesAndPermission){
            $module = Module::where('name',$modulesAndPermission['name'])->where('url',$modulesAndPermission['url'])->first();
            if(!$module){
                $createdModule = Module::create([
                    'name'=>$modulesAndPermission['name'],
                    'slug'=>str_replace(' ','-',strtolower($modulesAndPermission['name'])),
                    'url'=>$modulesAndPermission['url'],
                    'active'=>$modulesAndPermission['active'],
                    'icon'=>$modulesAndPermission['icon'],
                ]);
                foreach ($modulesAndPermission['permissions'] as $permission){
                    $checkPermission = Permission::where('module_id',$createdModule->id)->where('name',$permission)->first();
                    if(!$checkPermission){
                        Permission::create([
                            'module_id'=>$createdModule->id,
                            'name'=>$permission,
                            'slug'=>str_replace(' ','-',strtolower($permission)),
                        ]);
                    }
                }
            }
        }

        $features = [
            ['name'=>'Properties'],
            ['name'=>'Vehicles'],
        ];
        foreach ($features as $feature){
            Feature::updateOrCreate($feature,$feature);
        }
    }
}
