<?php
declare(strict_types=1);

namespace App\Http\Requests\Post;


use App\Http\Requests\ApiRequest;

class ShowRequest extends ApiRequest
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
            'post_id' => 'required|integer',
        ];
    }
}
