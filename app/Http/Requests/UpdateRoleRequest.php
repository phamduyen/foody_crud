<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Role;

class UpdateRoleRequest extends Request {

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
        'title' => 'required|max:100|unique:roles,tile,'.$id,
        'slug' => 'required|max 50'
        ];
    }

}
