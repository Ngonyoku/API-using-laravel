<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter {

    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    # Maps to the Database
    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [
        'eq' => '=', // Equal To
        'lt' => '<', // Less Than
        'lte' => '<=', // Less Than Equal To
        'gt' => '>', // Greater Than
        'gte' => '<=', // Greater Than Equal To
    ];

}




