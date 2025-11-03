<?php

namespace App\Services\File;

use Illuminate\Support\Carbon;

class FileService
{
    public function addMedia($model, $requestImageName = 'image', $collection = 'image'): void
    {
        if (request()?->hasFile($requestImageName)) {
            $model->addMediaFromRequest($requestImageName)->toMediaCollection($collection);
        }
    }
    
    public function addMultipleMedia($model, $count, $requestImageCounter = 'image', $collection = 'slider'): void
    {
        for ($i = 1; $i <= $count; $i++) {
            if (request()?->hasFile($requestImageCounter . $i)) {
                $model->addMediaFromRequest($requestImageCounter . $i)->toMediaCollection($collection);
            }
        }
    }
    
    public function updateMultipleMedia($model, $count, $imageList = [], $requestImageCounter = 'image', $collection = 'slider', $collectionNameChecker = '720'): void
    {
        $sliders = $model->getMedia($collection);
        if (count($sliders) > 0) {
            foreach ($sliders as $slider) {
                if (!in_array($slider->getUrl($collectionNameChecker), $imageList, true)) {
                    $slider->delete();
                }
            }
        }
        
        for ($i = 1; $i <= $count; $i++) {
            if (request()?->hasFile($requestImageCounter . $i)) {
                $model->addMediaFromRequest($requestImageCounter . $i)->toMediaCollection($collection);
            }
        }
    }
    
    public function addFromDropzone($model, $requestImageCounter = 'documentsDropzone', $collection = 'slides'): void
    {
        foreach (request()?->input($requestImageCounter, []) as $file) {
            $model->addMedia(self::dropzoneImagePathGenerator() . $file)->toMediaCollection($collection);
        }
    }
    
    public function updateFromDropzone($model, $requestImageCounter = 'documentsDropzone', $collection = 'slides'): void
    {
        $sliders = $model->getMedia($collection);
        if (count($sliders) > 0) {
            foreach ($sliders as $slider) {
                if (!in_array($slider->file_name, request()?->input($requestImageCounter, []), true)) {
                    $slider->delete();
                }
            }
        }
        $fileNames = $model->getMedia($collection)->pluck('file_name')->toArray();
        foreach (request()?->input($requestImageCounter, []) as $fileName) {
            if (count($fileNames) === 0 || !in_array($fileName, $fileNames, true)) {
                $model->addMedia(self::dropzoneImagePathGenerator() . $fileName)->toMediaCollection($collection);
            }
        }
    }
    
    public static function dropzoneImagePathGenerator(): string
    {
        $year = Carbon::now()->year;
        return "uploads/images/dropzone/$year/";
    }
}