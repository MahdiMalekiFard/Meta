<?php

namespace App\Helpers;

use App\Http\Resources\FileResource;
use App\Models\File;
use GlobalVariable;

class RequestHelper
{
    public static function mergeArray($key , $value , $arrayName = 'filter')
    {
        $previousValue = request()->input($arrayName, []);
        $newValue =
            [
                $key => $value,
            ];
        $mergedValue = collect($previousValue)->merge($newValue)->toArray();
        request()->merge([$arrayName => $mergedValue]);
    }

    public static function clearRequest()
    {
        foreach (request()->keys() as $key) {
            request()->offsetUnset($key);
        }
    }
}
