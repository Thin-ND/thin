<?php

namespace App\GraphQL\Query;

use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class TestQuery extends Query
{
    protected $attributes = [
        'name' => 'test',
        'description' => 'A query of users'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [

        ];
    }

    public function resolve()
    {
        return 'deo ra cai gi ca';
    }

}
