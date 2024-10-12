<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    protected static array $locations = array();

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    { }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $codex = json_decode(Storage::disk('public')->get("locations.json"), true);

        foreach ($codex['location'] as $item)
        {
            $item['type'] = 'location';

            $item['id']  = strtolower($item['expansion']) . "_";
            $item['id'] .= str_replace(" ", "-", strtolower($item['code'])) . "_";

            $item['id'] = substr($item['id'], 0, -1); // Eliminamos el _ final

            $item['art']   = "resources/art/{$item['universe']}/locations/{$item['expansion']}/{$item['id']}.jpg";
            $item['image'] = "resources/game/{$item['universe']}/locations/{$item['expansion']}/{$item['id']}.png";

            self::$locations[] = $item;
        }
    }

    public static function getLocation(string $id): array
    {
        foreach (self::$locations as $item) {
            if ($item['id'] == $id) {
                return self::getCurrentLanguage($item);
            }
        }

        return array();
    }

    public static function getLocations(): array
    {
        $items = array();

        foreach (self::$locations as $item) {
            $items[] = self::getCurrentLanguage($item);
        }

        return $items;
    }

    public static function getLocationsByTerrain(string $terrain): array
    {
        $items = array();

        foreach (self::$locations as $item) {
            if ($item['terrain'] == $terrain) {
                $items[] = self::getCurrentLanguage($item);
            }
        }

        return $items;
    }

    private static function getCurrentLanguage(array $item): array
    {
        $item['name'] = $item['name'][App::currentLocale()];
        $item['text'] = self::translateText($item['text'][App::currentLocale()]);
        $item['lore'] = $item['lore'][App::currentLocale()];

        return $item;
    }

    private static function translateText(string $text): string
    {
        $text = preg_replace_callback(
            '/\{(.*?)}/mi',
            function ($m) {
                return "{" . $m[1] . "|" . __("keywords." . $m[1]) . "}";
            },
            $text
        );

        return $text;
    }
}
