<?php

namespace Database\Factories;

use App\Models\UserPermission;

use App\Models\User;

use App\Models\Permission;

use App\Models\Independent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserpermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPermission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'permission_id'=>function(){
                return Permission::factory()->create()->id;
            },
            'user_id'=>function(){
                return User::factory()->create()->id;
            },
            'independent_id'=>function(){
                return Independent::factory()->create()->id;
            }
        ];
    }
}
