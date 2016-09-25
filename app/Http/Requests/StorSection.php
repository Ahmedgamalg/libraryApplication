<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorSection extends Request
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
         'section_name'=>'required|unique:section,section_name|max:30',
          'image'=>'required|image|max:1024'
        ];
    }
}
