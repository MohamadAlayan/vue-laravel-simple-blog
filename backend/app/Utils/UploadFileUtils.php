<?php

namespace App\Utils;

use Intervention\Image\Facades\Image;

class UploadFileUtils
{

    public static function uploadImage($file, $location, $size = null, $old = null, $thumb = null, $filename = null): array
    {
        // Create directory for storing image
        $path = FileUtils::makeDirectory($location);
        if (!$path) {
            throw new \Exception('File could not been created.');
        }

        // Delete Old Image if exist
        if (!empty($old)) {
            FileUtils::removeFile($location . '/' . $old);
            FileUtils::removeFile($location . '/thumb_' . $old);
        }

        // If file name is not set generate new unique name
        if ($filename === null) {
            $filename = uniqid('', true) . time() . '.' . $file->getClientOriginalExtension();
        }

        $image = Image::make($file);

        // Resize Image
        if (!empty($size)) {
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[1]);
        }

        // Save image
        $image->save($location . '/' . $filename);

        // Create thumb
        if (!empty($thumb)) {
            $thumb = explode('x', $thumb);
            Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
            return [
                'name' =>  $filename,
                'thumb_name' => 'thumb_' . $filename,
            ];

        }
        return [
            'name' =>  $filename,
        ];
    }

}

