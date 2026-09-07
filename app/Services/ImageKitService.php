<?php

namespace App\Services;

use ImageKit\ImageKit;

class ImageKitService
{
    protected ImageKit $imageKit;

    public function __construct()
    {
        $this->imageKit = new ImageKit(
            config('services.imagekit.public_key'),
            config('services.imagekit.private_key'),
            config('services.imagekit.url_endpoint')
        );
    }

    public function upload($file, string $fileName)
    {
        return $this->imageKit->upload([
            'file' => base64_encode(file_get_contents($file->getRealPath())),
            'fileName' => $fileName,
            'folder' => '/properties',
            'useUniqueFileName' => true,
        ]);
    }

    public function delete(string $fileId)
    {
        return $this->imageKit->deleteFile($fileId);
    }
}
