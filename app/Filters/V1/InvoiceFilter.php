<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoiceFilter extends ApiFilter {

    protected $safeParms = [
        'customerId' => ['eq'],
        'amount' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'paidDate' =>  ['eq', 'gt', 'lt', 'lte', 'gte'],
        'billedDate' =>  ['eq', 'gt', 'lt', 'lte', 'gte']
    ];

    # Maps to the Database
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date'
    ];

    protected $operatorMap = [
        'eq' => '=', // Equal To
        'lt' => '<', // Less Than
        'lte' => '<=', // Less Than Equal To
        'gt' => '>', // Greater Than
        'gte' => '<=', // Greater Than Equal To
        'ne' => '!=' // Not Equal To
    ];

}




