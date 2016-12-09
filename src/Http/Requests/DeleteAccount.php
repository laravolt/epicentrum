<?php

namespace Laravolt\Epicentrum\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        $userToDelete = $this->segment(3);
        if ($userToDelete == auth()->id()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
