<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateStandRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        return ! ($user && $user->stand()->exists());
    }

    public function rules(): array
    {
        $userId = $this->user()?->id;

        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'stand_name' => ['required', 'string', 'max:255'],
            'kind' => ['required', Rule::in(['product', 'service'])],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $category = \App\Models\Category::with('parent')->find($value);
                    $categoryKind = $category?->resolvedKind();

                    if ($categoryKind && $categoryKind !== $this->input('kind')) {
                        $fail('Cette catégorie ne correspond pas au type de stand.');
                    }
                },
            ],
            'country' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'phone_number')->ignore($userId),
            ],
            'email' => ['nullable', 'email', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];

        if (! $this->user()) {
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'stand_name' => 'nom du stand',
            'kind' => 'type de stand',
            'category_id' => 'catégorie',
            'phone_number' => 'téléphone',
            'email' => 'e-mail',
            'password' => 'mot de passe',
        ];
    }
}
