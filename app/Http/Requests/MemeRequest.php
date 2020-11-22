<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemeRequest extends FormRequest
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
    public static function rules()
    {
        $rules = [];
        if (gettype(request()->image) === 'string') {
            $rules['image'] = 'string'; 
        }
        else {
            $rules['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $rules['body'] = 'required|max:255';
        $rules['title'] = 'required|max:30';

        return $rules;
    }
}
