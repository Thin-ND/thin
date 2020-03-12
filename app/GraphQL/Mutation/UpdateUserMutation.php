<?php
/**
 * Created by PhpStorm.
 * User: ardani
 * Date: 8/4/17
 * Time: 10:02 AM
 */

namespace App\GraphQL\Mutation;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\User;

class UpdateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('users');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = User::find($args['id']);
        if (!$user) {
            return [];
        }

        $user->name = $args['name'];
        $user->save();
//        dd($args);

        return $user;
    }
}
