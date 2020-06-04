<?php

namespace App\Http\Requests\Admin\Api\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
      if(request()->isMethod('post')){
        return [
            //
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|unique:posts|max:50',
            'status' => 'required|boolean'
        ];
      }

      if(request()->isMethod('put')){
        return [
            //
            'id' => 'required|numeric',
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:50|unique:posts,slug,'.$this->post->id,
            'status' => 'required|boolean'
        ];
      }
    }
}
