<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddNewBook extends Request
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
            'book_title'=>'required|max:30',
            'book_edition'=>'required|Integer',
            'book_discrebtion'=>'required',
            'anather_auther'=>'required'
        ];
    }
}
