<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageService
{
    public function storeProductImage(UploadedFile $file): string
    {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file)
            ->cover(800, 800)
            ->toJpeg(80);

        $path = 'products/'.Str::uuid().'.jpg';

        Storage::disk('public')->put($path, (string) $image);

        return $path;
    }

    public function deleteProductImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
