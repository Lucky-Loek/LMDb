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
        $image = $image->widen(240);
        $image->save(storage_path('app/public/') . $thumbnailFilePath);

        return [
            'poster_file_path' => $filePath,
            'poster_thumbnail_file_path' => $thumbnailFilePath
        ];
    }
}
