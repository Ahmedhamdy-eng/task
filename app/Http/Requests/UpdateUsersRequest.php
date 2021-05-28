<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
user App\Models\User;
use Rule;
class UpdateUsersRequest extends FormRequest
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
        
        return  [
            'name'     =>'required|string',
            'phone'    => ['required','string','digits:11', new CompanyKey, Rule::unique('users')->ignoreModel($this->id) ],
            'password' =>'nullable|max:50|min:8',
        ];
        
    }
}
