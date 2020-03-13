<?php

namespace App\GraphQL\Query;

use App\User;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
//use Tymon\JWTAuth\Facades\JWTAuth; // Lam gi co tim thay dau?

class MyProfileQuery extends Query
{
//    private $auth;

    protected $attributes = [
        'name' => 'My Profile Query',
        'description' => 'My Profile Information'
    ];

//    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
//    {
//        try {
//            $this->auth = JWTAuth::parseToken()->authenticate();
//        } catch (\Exception $e) {
//            $this->auth = null;
//            return false;
//        }
//        return (boolean) !!$this->auth;
//    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int()
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string()
            ]
        ];
    }

    public function type(): Type
    {
        return GraphQL::type('user_type');
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, SelectFields $fields)
    {
        $user = User::with(array_keys($fields->getRelations()))
            ->where('id', $this->auth->id)
            ->select($fields->getSelect())->first();
        return $user;
    }
}
