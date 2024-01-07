<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery {

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

    public function transform(Request $request) {
        $eloQuery =[]; //Eloquent Query

        # Iterate ofer the Safe paramters
        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            # Filter the operators
            foreach ($operators as $operator) {
                # Check if we have the operator
                if (isset($query[$operator])) {
                    # If the operator of the field is allowed, all an element to the $eloquery
                    $eloQuery[] =  [
                        $column, 
                        $this->operatorMap[$operator], //Operator used
                        $query[$operator] // Query value
                    ];
                }
            }
        }
        return $eloQuery;
    }

}




