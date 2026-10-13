<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageHelper
{
    /**
     * ذخیره تصویر مستقیم در پوشه public
     *
     * @param  UploadedFile|string  $file
     * @param  string               $directory   مثلاً: uploads, products, users/avatars
     * @param  array                $options
     * @return array{path: string, url: string, filename: string}
     */

   public static function store(
    UploadedFile|string $file,
    string $directory = 'uploads',
    array $options = []
): array {
    $options = array_merge([
        'width'              => null,
        'height'             => null,
        'quality'            => 85,
        'format'             => 'webp',
        'keep_original_name' => false,
        'max_width'          => 1920,
    ], $options);

    // ===== این قسمت مهمه =====
    // برای Livewire باید مسیر واقعی فایل رو بگیریم
    $source = $file instanceof UploadedFile
        ? $file->getRealPath()
        : $file;

    $image = Image::read($source);
    $image->orient();

    // تغییر اندازه
    if ($options['width'] || $options['height']) {
        $image->cover(
            width: $options['width'] ?? $image->width(),
            height: $options['height'] ?? $image->height()
        );
    } elseif ($options['max_width'] && $image->width() > $options['max_width']) {
        $image->scaleDown(width: $options['max_width']);
    }

    // ساخت نام فایل
    $extension = $options['format'];
    $filename = $options['keep_original_name'] && $file instanceof UploadedFile
        ? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extension
        : Str::uuid() . '.' . $extension;

    $relativePath = trim($directory, '/') . '/' . $filename;
    $fullPath = public_path($relativePath);

    // ساخت پوشه
    $dir = dirname($fullPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    // تبدیل فرمت
    $encoded = match ($extension) {
        'jpg', 'jpeg' => $image->toJpeg(quality: $options['quality']),
        'png'         => $image->toPng(),
        'webp'        => $image->toWebp(quality: $options['quality']),
        'avif'        => $image->toAvif(quality: $options['quality']),
        default       => $image->toWebp(quality: $options['quality']),
    };

    // ذخیره در public
    file_put_contents($fullPath, (string) $encoded);

    return [
        'path'     => $relativePath,
        'url'      => asset($relativePath),
        'filename' => $filename,
    ];
}
    /**
     * حذف تصویر از public
     */
    public static function delete(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        $fullPath = public_path($path);

        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}
