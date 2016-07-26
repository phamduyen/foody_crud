<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Food;

class UpdateFoodRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $id = $this->segment(2);
        return [
            'name' => 'required|max:100|unique:foods,name,'.$id,
            'image' => 'max:1000|image',
            'content' => 'required'
        ];
    }

}
