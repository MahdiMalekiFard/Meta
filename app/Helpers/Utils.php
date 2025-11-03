<?php

namespace App\Helpers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Estate;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Throwable;

class Utils
{
    /**
     * @param string $type
     *
     * @return string|void
     */
    public static function getEloquent(string $type): ?string
    {
        return match ($type) {
            "category" => Category::class,
            "user"     => User::class,
            "city"     => City::class,
            "blog"     => Blog::class,
            "service"  => Service::class,
            "estate"   => Estate::class,
            default    => null,
        };
    }
    
    public static function getResource($eloquentClass): string
    {
        return "App\\Http\\Resources\\" . class_basename($eloquentClass) . "Resource";
    }
    
    public static function getService($eloquentClass)
    {
        return app("App\\Services\\" . class_basename($eloquentClass) . "\\" . class_basename($eloquentClass) . "Service");
    }
    
    public static function getRepository($eloquentClass)
    {
        return app("App\\Repositories\\" . class_basename($eloquentClass) . "\\" . class_basename($eloquentClass) . "RepositoryInterface");
    }
    
    public static function generateSlug($title, $separator = '-'): string
    {
        
        $title = trim($title);
        $title = mb_strtolower($title, 'UTF-8');
        $title = str_replace('‌', $separator, $title);
        $title = preg_replace(
            '/[^a-z0-9_\s\-اآؤئبپتثجچحخدذرزژسشصضطظعغفقكکگلمنوةيإأۀءهی۰۱۲۳۴۵۶۷۸۹٠١٢٣٤٥٦٧٨٩]/u',
            '',
            $title
        );
        $title = preg_replace('/[\s\-_]+/', ' ', $title);
        $title = preg_replace('/[\s_]/', $separator, $title);
        return trim($title, $separator);
    }
    
    public static function getKeyFromEloquent($class): string
    {
        return Str::kebab(last(explode("\\", $class)));
    }
    
    public static function getMorphableResource(string $morphable_type): string
    {
        $model_name = Str::studly(last(explode("\\", $morphable_type)));
        return "App\\Http\\Resources\\" . $model_name . "Resource";
    }
    
    /**
     * @throws Throwable
     */
    public function deleteMultiple(string $type, array $uuids): bool
    {
        //todo: change this to safe search
        abort(Response::HTTP_BAD_REQUEST, "NOT work");
        $type = Str::studly($type);
        $service = "App\\Services\\" . $type . "\\" . $type . "Service";
        $service = resolve($service);
        DB::transaction(function () use ($service, $uuids, $type) {
            foreach ($uuids as $uuid) {
                $model = $service->findByUUID($uuid);
                if (!$model) {
                    abort(Response::HTTP_NOT_FOUND);
                }
                $service->destroy($model);
            }
        });
        return true;
    }
    
}