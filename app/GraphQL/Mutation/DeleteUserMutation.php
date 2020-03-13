<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use App\User;


class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'DeleteUser'
    ];

    public function type(): Type
    {
        return GraphQL::type('user_type');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }
    public function resolve($root, $args)
    {
        $user = User::findOrFail($args['id']);
        if(!$user)
        {
            return null;
        }

        $deletedUser = $user->toArray();
        $user->delete();

        return $deletedUser;

    }

}
