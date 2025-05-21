<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Foundation\Http\FormRequest;

class SavePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'location' => 'nullable|string|max:255',

            'about' => 'nullable|array',
            'about.title' => 'nullable|string',
            'about.description' => 'nullable|string',
            'about.image' => 'nullable|string',

            'banner' => 'nullable|array',
            'banner.title' => 'nullable|string',
            'banner.description' => 'nullable|string',
            'banner.btn_label' => 'nullable|string',

            'educations' => 'nullable|array',
            'educations.*.school' => 'required|string',
            'educations.*.degree' => 'required|string',
            'educations.*.year_from' => 'required|string',
            'educations.*.year_to' => 'required|string',

            'projects' => 'nullable|array',
            'projects.*.title' => 'required|string',
            'projects.*.description' => 'required|string',
            'projects.*.tech' => 'required|string',
            'projects.*.image' => 'required|string',
            'projects.*.link' => 'nullable|url',
            'projects.*.category' => 'nullable|string',

            'skills' => 'nullable|array',
            'skills.*.name' => 'required|string',
            'skills.*.level' => 'nullable|string',
            'skills.*.experience' => 'nullable|string',
            'skills.*.icon' => 'nullable|string',
            'skills.*.sub_skills' => 'nullable|array',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->input('firstName'),
            'last_name' => $this->input('lastName'),
            'contact_email' => $this->input('contactEmail'),
            'about' => $this->input('about'),
            'banner' => $this->transformBanner(),
            'educations' => $this->transformCollection('educations', [
                'school', 'degree', 'yearFrom' => 'year_from', 'yearTo' => 'year_to',
            ]),
            'projects' => $this->transformCollection('projects', [
                'title', 'description', 'tech', 'image', 'link', 'category',
            ]),
            'skills' => $this->transformCollection('skills', [
                'name', 'level', 'experience', 'icon', 'subSkills' => 'sub_skills',
            ]),
        ]);
    }

    private function transformCollection(string $key, array $fields): array
    {
        return collect($this->input($key, []))
            ->map(fn ($item) => $this->transformKeys($item, $fields))
            ->toArray();
    }

    private function transformKeys(array $item, array $fields): array
    {
        $transformed = [];
        foreach ($fields as $from => $to) {
            if (is_int($from)) {
                $from = $to;
            }
            $transformed[$to] = $item[$from] ?? null;
        }
        return $transformed;
    }

    private function transformBanner(): array
    {
        $banner = $this->input('banner', []);
        return [
            'title' => $banner['title'] ?? null,
            'description' => $banner['description'] ?? null,
            'btn_label' => $banner['btnLabel'] ?? null,
        ];
    }
}
