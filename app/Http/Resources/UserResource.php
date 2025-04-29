<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'image' => $this->image,
            'googleId' => $this->google_id,
            'emailVerifiedAt' => $this->email_verified_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'templateId' => $this->template_id,
            'contactEmail' => $this->contact_email,
            'location' => $this->location,
            'banner' => $this->banner,
            'professionId' => $this->profession_id,
            'profession' => $this->profession,
            'about' => [
                'title' => $this->about['title'] ?? null,
                'description' => $this->about['description'] ?? null,
                'image' => $this->about['image'] ?? null,
            ],
            'banner' => [
                'title' => $this->banner['title'] ?? null,
                'description' => $this->banner['description'] ?? null,
                'btn_label' => $this->banner['btn_label'] ?? null,
            ],
        ];
    }
}
