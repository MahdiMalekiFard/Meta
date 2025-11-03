<?php

namespace App\Services;

use App\Models\Agent;
use App\Models\Area;
use App\Models\Blog;
use App\Models\City;
use App\Models\Country;
use App\Models\Notice;
use App\Models\Property;
use App\Models\Province;
use App\Models\User;
use Database\Seeders\CitySeeder;

class GetReference
{
    public static function reference($reference): ?string
    {
        return match ($reference) {
            Blog::class     => "Blog",
            Notice::class   => "Notice",
            User::class     => "User",
            City::class     => "City",
            Country::class  => "Country",
            Province::class => "Province",
            Property::class => "Property",
            Agent::class    => "Agent",
            Area::class     => "Area",
            default         => "reference not find",
        };
    }
}