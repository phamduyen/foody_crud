<?php

namespace App\Http\Requests;

use App\Models\User;

class UpdateUserRequest extends Request {

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

        //$id = $this->user()->id;
        $id = $this->segment(2);
        return [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'image' => 'max:1000|image',
            'name' => 'required|max:50',
            'role' => 'exists:roles,id'
        ];
    }

}
