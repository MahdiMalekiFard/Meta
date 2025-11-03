<?php

namespace App\Enums;

enum PropertiesEnum: string
{
    case BALCONY                      = "Balcony";
    case PARKING_SPACES               = "Parking spaces";
    case SWIMMING_POOL                = "Swimming pool";
    case SAUNA                        = "Sauna";
    case ELECTRICITY_GENERATOR        = "Electricity generator";
    case CENTRAL_AIR_CONDITIONER      = "Central air conditioner";
    case CENTRAL_HEATING              = "Central heating";
    case DOUBLE_GLAZED_WINDOWS        = "Double glazed windows";
    case STORAGE_SPACE                = "Storage space";
    case SATELLITE_CABLE_TV           = "Satellite cable tv";
    case CCTV_SECURITY                = "Cctv security";
    case SECURITY_STAFF               = "Security staff";
    case WASTE_DISPOSAL               = "Waste disposal";
    case GYM                          = "Gym";
    case SEWERAGE_SYSTEM              = "Sewerage system";
    case FURNISHED_KITCHEN            = "Furnished kitchen";
    case RECEPTION                    = "Reception";
    case HR_ELECTRICITY_24            = "24 Hr electricity";
    case INTERNET                     = "Internet";
    case PLAYGROUND                   = "Playground";
    case GREEN_AREA                   = "Green area";
    case MARKET                       = "Market";
    case SHOP                         = "Shop";
    case SCHOOL                       = "School";
    case AIR_CONDITIONERS_INSTALLED   = "Air conditioners installed";
    case MOSQUE                       = "Mosque";
    case MEDICAL_CENTER               = "Medical center";
    case CENTRAL_GAS                  = "Central gas";
    case RESTAURANT                   = "Restaurant";
    case WOMEN_SALON                  = "Women salon";
    case SPORT_CENTER                 = "Sport center";
    case CAFETERIA                    = "Cafeteria";
    case MAINTENANCE                  = "Maintenance";
    case CLEANING                     = "Cleaning";
    case PETS_ALLOWED                 = "Pets allowed";
    case FIRE_FIGHTING_SYSTEM         = "Fire fighting system";
    case OFFICE                       = "Office";
    case FIREPLACE                    = "Fireplace";
    case NEAR_MAIN_ROAD               = "Near main road";
    case DRESSING_ROOM                = "Dressing room";
    case NURSERY                      = "Nursery";
    case HOSPITAL                     = "Hospital";
    case BAKERY                       = "Bakery";
    case KINDERGARTEN                 = "Kindergarten";
    case LIBRARY                      = "Library";
    case CINEMA_HALL                  = "Cinema hall";
    case BARBER                       = "Barber";
    case STATIONARY                   = "Stationary";
    case WATER_WELL                   = "Water well";
    case CURTAIN                      = "Curtain";
    case DUCT_AIR_COOLER              = "Duct air cooler";
    case SMART_HOME                   = "Smart home";
    case MALL                         = "Mall";
    case EARTHQUAKE_RESISTANT_SYSTEM  = "Earthquake resistant system";
    case AUTOMOTIVE_SERVICE           = "Automotive service";
    case LAUNDRY_DRY_CLEANER          = "Laundry & dry cleaner";
    case JACUZZI                      = "Jacuzzi";
    case PHARMACY                     = "Pharmacy";
    case GAS_STATION                  = "Gas station";
    case WALLPAPER                    = "Wallpaper";
    case POLICE_STATION               = "Police station";
    case THERMAL_INSULATION           = "Thermal insulation";
    case COMPASS_CARD                 = "Compass card";
    case WATER_SPRINKLER_SYSTEM       = "Water sprinkler system";
    case WATER_TANK                   = "Water tank";
    case EVENTS_HALL                  = "Events hall";
    case CENTRAL_FIRE_FIGHTING_SYSTEM = "Central fire fighting system";
    case HOT_WATER_SYSTEM             = "Hot water system";
    case CENTRAL_VACUUM_SYSTEM        = "Central vacuum system";
    case GARRET_ROOM                  = "Garret room";
    case BASEMENT                     = "Basement";
    case FOUNTAIN                     = "Fountain";
    case AIR_COOLER                   = "Air cooler";
    case HR_WATER_24                  = "24 Hr water";
    case WASH_MACHINE                 = "Wash machine";
    case BED                          = "Bed";
    case PARTY_ROOM                   = "Party room";
    case BILLIARD_ROOM                = "Billiard room";
    case MUSIC_ROOM                   = "Music room";
    case MEETING_ROOM                 = "Meeting room";
    case AIR_DUCT                     = "Air duct";
    case MODERN_CEILING               = "Modern ceiling";
    case TURKISH_BATH                 = "Turkish bath";
    case LINEAR_GRILL_TYPE_AC         = "Linear grill type ac";
    case SEPARATE_KITCHEN             = "Separate kitchen";
    case GARBAGE_CHUTE                = "Garbage chute";
    case GAS_BOILER                   = "Gas boiler";
    case VENTILATION_SYSTEM           = "Ventilation system";
    case MINI_VRV_SYSTEM              = "Mini vrv system";
    case HELIPAD                      = "Helipad";
    case FIRE_HOSE_CABENET            = "Fire hose cabenet";
    case CONTROL_ROOM                 = "Control room";
    case EMERGENCY_STAIRS             = "Emergency stairs";
    case KITCHEN_COUNTER              = "Kitchen counter";
    case REFRIGERATOR                 = "Refrigerator";
    case WOOD_FLOORING                = "Wood flooring";
    case AQUA_PARK                    = "Aqua park";
    case GOLDEN_ZONE                  = "Golden zone";
    case STREET_LIGHTS                = "Street lights";
    case COMPLETING_STREETS           = "Completing streets";
    
    public function title(): string
    {
        return trans('property.' . $this->name) ?? '---';
    }
    
    public function type(): string
    {
        return PropertyTypeEnum::BOOLEAN->value;
    }
    
}
