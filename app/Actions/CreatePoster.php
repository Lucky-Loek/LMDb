<?php

namespace App\Actions;

class CreatePoster implements ActionInterface
{
    /**
     * Download poster, create a thumbail of it and save both files
     *
     * @param array $data
     * @return array
     */
    public function execute(array $data): array
    {
        $image = \Image::make($data['posterUrl']);

        // Replace all weird characters but digits and alphabetic characters
        $screeningTitle = strtolower($data['title']);
        $screeningTitle = preg_replace('/[^\da-z]/', '_', $screeningTitle);

        $filePath = $screeningTitle . '.jpg';
        $thumbnailFilePath = $screeningTitle . '_thumb.jpg';

        $image->save(storage_path('app/public/') . $filePath);
        $image = $image->widen(224); // Bulma grid = 1344px. Divided by 6 (for 6 columns) gives 224px per image.
        $image->save(storage_path('app/public/') . $thumbnailFilePath);

        return [
            'poster_file_path' => $filePath,
            'poster_thumbnail_file_path' => $thumbnailFilePath
        ];
    }
}
