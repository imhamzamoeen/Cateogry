<?php

namespace App\Services;

class FileStoreService
{
    public function __construct()
    {
    }

    public static function storeFile($file, $type)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName =  substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $extension;
        $type == 'profile'
            ? $file->move(public_path('assets/images/Profile'), $fileName)
            : $file->move(public_path('assets/images/' . auth()->id() . '/' . $type), $fileName);
        return $fileName;
    }

    public static function ImageStore($file, $path)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName =  substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $extension;
        $file->move(public_path($path), $fileName);
         
        return $fileName;
    }

    public static function spatieDzStoreFile($model, $inputFile, $collectionName, $disk)
    {
        foreach ($inputFile as $file) {
            $model->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($disk, $collectionName);
        }
    }

    public static function spatieFileUploadSingleOrMultiple($model, $inputFile, $requestKeyName, $disk, $collectionName)
    {
        if ($inputFile && $inputFile->isValid()) {
            $model->addMediaFromRequest($requestKeyName)->toMediaCollection($disk, $collectionName);
            // foreach ($inputFile as $file) {
            //     $model->addMedia($file)->toMediaCollection($disk, $collectionName);
            // }
        }
    }
}
