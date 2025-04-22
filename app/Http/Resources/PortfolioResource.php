<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'contactEmail' => $this->contact_email,
            'location' => $this->location,
            'about' => [
                'title' => $this->about['title'] ?? null,
                'description' => $this->about['description'] ?? null,
                'image' => $this->about['image'] ?? null,
            ],
            'banner' => [
                'title' => $this->banner['title'] ?? null,
                'description' => $this->banner['description'] ?? null,
                'btnLabel' => $this->banner['btn_label'] ?? null,
            ],
            'educations' => EducationResource::collection($this->educations),
            'projects' => ProjectResource::collection($this->projects),
            'skills' => SkillResource::collection($this->skills),
        ];
    }
}
