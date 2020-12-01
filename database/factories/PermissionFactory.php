<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class permissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $permissions=['edit users', 'change order status', 'customer', 'set staff permissions', 'edit product data', 'update stock'];
        return [
            'auth_level' => random_int(0,5), //0-super admin 1- admin 2-independt owner 3-independent employee 4-driver 5-customer 
            'name' => $permissions[random_int(0,5)]
        ];
    }
}
