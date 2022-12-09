<?php

namespace Firefly\Http\Requests;

use Firefly\Traits\ChecksForEmptyPost;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    use ChecksForEmptyPost;

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
            'content' => 'required|max:5000',
        ];
    }
}
