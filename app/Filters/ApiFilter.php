<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParms = [];

    # Maps to the Database
    protected $columnMap = [];

    # Map the operators
    protected $operatorMap = [];

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


