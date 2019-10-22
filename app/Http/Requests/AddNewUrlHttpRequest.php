<?php

declare(strict_types=1);

namespace App\Http\Requests;

class AddNewUrlHttpRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'href' => 'required|max:255|url|unique:urls,href',
            'slug' => 'required|string|min:6|max:32|unique:urls,slug'
        ];
    }

    public function href(): string
    {
        return $this->get('href');
    }

    public function slug(): string
    {
        return $this->get('slug');
    }
}