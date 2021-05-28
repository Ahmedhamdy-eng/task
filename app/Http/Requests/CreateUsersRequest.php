<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use App\Rules\CompanyKey;
class CreateUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        
        return [
            'name'     =>'required|string',
            'phone'    => ['required','unique:users','string','digits:11', new CompanyKey],
            'password' =>'required|string|min:8',
        ];
        
    }
}
