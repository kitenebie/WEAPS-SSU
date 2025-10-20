<?php

namespace App\Filament\Employeer\Resources\Companies\Pages;

use App\Filament\Employeer\Resources\Companies\CompanyResource;
use App\Models\Carrer;
use App\Models\CompanyPost;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    /**
     * Configure the page to hide breadcrumbs
     */
    public function getBreadcrumbs(): array
    {
        return [];
    }

    /**
     * Load existing careers and posts before filling the form
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $company = $this->getRecord();

        if ($company) {
            // Load existing careers
            $data['careers'] = Carrer::where('company_id', $company->id)
                ->get()
                ->map(function ($career) {
                    return [
                        'id' => $career->id,
                        'company_id' => $career->company_id,
                        'title' => $career->title,
                        'description' => $career->description,
                        'role_type' => $career->role_type,
                        'location' => $career->location,
                        'min_salary' => $career->min_salary,
                        'max_salary' => $career->max_salary,
                        'tags' => $career->tags,
                    ];
                })
                ->toArray();

            // Load existing posts
            $data['posts'] = CompanyPost::where('company_id', $company->id)
                ->get()
                ->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'company_id' => $post->company_id,
                        'content' => $post->content,
                    ];
                })
                ->toArray();
        }

        return $data;
    }

    /**
     * Save careers and posts when the form is submitted
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $company = $this->getRecord();

        if ($company && isset($data['careers'])) {
            // Handle careers
            $existingCareerIds = [];
            foreach ($data['careers'] as $careerData) {
                if (isset($careerData['id']) && $careerData['id']) {
                    // Update existing career
                    $career = Carrer::find($careerData['id']);
                    if ($career) {
                        $career->update([
                            'title' => $careerData['title'],
                            'description' => $careerData['description'],
                            'role_type' => $careerData['role_type'],
                            'location' => $careerData['location'],
                            'min_salary' => $careerData['min_salary'] ?? null,
                            'max_salary' => $careerData['max_salary'] ?? null,
                            'tags' => $careerData['tags'],
                        ]);
                        $existingCareerIds[] = $career->id;
                    }
                } else {
                    // Create new career
                    $newCareer = Carrer::create([
                        'company_id' => $company->id,
                        'title' => $careerData['title'],
                        'description' => $careerData['description'],
                        'role_type' => $careerData['role_type'],
                        'location' => $careerData['location'],
                        'min_salary' => $careerData['min_salary'] ?? null,
                        'max_salary' => $careerData['max_salary'] ?? null,
                        'tags' => $careerData['tags'],
                    ]);
                    $existingCareerIds[] = $newCareer->id;
                }
            }

            // Delete careers that were removed from the form
            $currentCareerIds = Carrer::where('company_id', $company->id)->pluck('id')->toArray();
            $careersToDelete = array_diff($currentCareerIds, $existingCareerIds);
            if (!empty($careersToDelete)) {
                Carrer::whereIn('id', $careersToDelete)->delete();
            }
        }

        if ($company && isset($data['posts'])) {
            // Handle posts
            $existingPostIds = [];
            foreach ($data['posts'] as $postData) {
                if (isset($postData['id']) && $postData['id']) {
                    // Update existing post
                    $post = CompanyPost::find($postData['id']);
                    if ($post) {
                        $post->update([
                            'content' => $postData['content'],
                        ]);
                        $existingPostIds[] = $post->id;
                    }
                } else {
                    // Create new post
                    $newPost = CompanyPost::create([
                        'company_id' => $company->id,
                        'content' => $postData['content'],
                    ]);
                    $existingPostIds[] = $newPost->id;
                }
            }

            // Delete posts that were removed from the form
            $currentPostIds = CompanyPost::where('company_id', $company->id)->pluck('id')->toArray();
            $postsToDelete = array_diff($currentPostIds, $existingPostIds);
            if (!empty($postsToDelete)) {
                CompanyPost::whereIn('id', $postsToDelete)->delete();
            }
        }

        // Remove careers and posts from the main form data since they're handled separately
        unset($data['careers'], $data['posts']);

        return $data;
    }
}
