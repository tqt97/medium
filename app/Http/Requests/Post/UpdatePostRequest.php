<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'title' => ['bail', 'required', 'min:5', Rule::unique('posts', 'title')->ignore($this->post->id)],
            'slug' => ['bail', 'required', Rule::unique('posts', 'slug')->ignore($this->post->id)],
            'content' => 'required',
            'image' => ['bail', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
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
