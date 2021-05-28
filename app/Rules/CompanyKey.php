<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CompanyKey implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $CompanyKey = ['015', '010', '011', '012'];

        $phoneNumber = substr($value , 0, 3);

        
        if (in_array($phoneNumber, $CompanyKey)) {
            
            return  true;
        }
            

       
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Mobile Number Must Start With 010 , 012, 015, 011';
    }
}
