<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['bail', 'required', 'min:5', 'unique:posts,title'],
            'slug' => ['bail', 'required', 'unique:posts,slug'],
            'content' => 'required',
            'image' => ['bail', 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
        ];
    }

    public function prepareForValidation()
    {
        $slug = $this->title ? str($this->title)->slug() : '';
        $this->merge([
            'user_id' => auth()->user()->id,
            'slug' => $slug,
        ]);
    }
}
