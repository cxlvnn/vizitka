<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;

class ImageOptimizer
{
    private ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Compress and store an uploaded image. Returns the relative storage path.
     */
    public function compressAndStore(UploadedFile|SymfonyUploadedFile $file, string $directory, string $disk = 'public'): string
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $hash = uniqid();
        $name = match ($ext) {
            'jpg', 'jpeg' => $hash . '.jpg',
            'png' => $hash . '.png',
            'webp' => $hash . '.webp',
            'avif' => $hash . '.avif',
            default => $hash . '.' . $ext,
        };

        $relativePath = trim($directory, '/') . '/' . $name;
        $fullPath = Storage::disk($disk)->path($relativePath);

        // Ensure directory exists
        $dir = dirname($fullPath);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $image = $this->manager->read($file->getRealPath());

        // Scale down large images (max 1600px on longest side, preserving aspect ratio)
        $image->scaleDown(width: 1600, height: 1600);

        match ($ext) {
            'png' => $image->encodeByExtension('png', progressive: true),
            'jpg', 'jpeg' => $image->encodeByExtension('jpg', quality: 85, progressive: true),
            'webp' => $image->encodeByExtension('webp', quality: 85),
            'avif' => $image->encodeByExtension('avif', quality: 75),
            default => $image->encodeByExtension('jpg', quality: 85, progressive: true),
        };

        $image->save($fullPath);

        return $relativePath;
    }

    /**
     * Optimize an existing image file in place.
     */
    public function optimizeFile(string $absolutePath): void
    {
        if (! file_exists($absolutePath)) {
            return;
        }

        $ext = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));

        if (! in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'avif'])) {
            return;
        }

        $image = $this->manager->read($absolutePath);
        $image->scaleDown(width: 1600, height: 1600);

        match ($ext) {
            'png' => $image->encodeByExtension('png', progressive: true),
            'jpg', 'jpeg' => $image->encodeByExtension('jpg', quality: 85, progressive: true),
            'webp' => $image->encodeByExtension('webp', quality: 85),
            'avif' => $image->encodeByExtension('avif', quality: 75),
        };

        $image->save($absolutePath);
    }
}
