<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    protected static array $units = array();

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
        $codex = json_decode(Storage::disk('public')->get("units.json"), true);

        foreach ($codex['unit'] as $item)
        {
            $item['id']  = strtolower($item['expansion']) . "_";
            $item['id'] .= (isset($item['faction']) ? strtolower($item['faction']) . "_" : null);
            $item['id'] .= str_replace(" ", "-", strtolower($item['name'])) . "_";
            $item['id'] .= ($item['wounded'] ? "wounded_" : null);

            $item['id'] = substr($item['id'], 0, -1); // Eliminamos el _ final

            $item['art']   = "resources/art/{$item['universe']}/units/{$item['expansion']}/{$item['id']}.png";
            $item['image'] = "resources/game/{$item['universe']}/units/{$item['expansion']}/{$item['id']}.png";

            $item['cost']  = $item['cost'] ?? self::unitCost($item);

            self::$units[] = $item;
        }
    }

    public static function getUnit(string $id): array
    {
        foreach (self::$units as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }

        return array();
    }

    public static function getUnits(): array
    {
        return self::$units;
    }

    public static function getUnitsByExpansion(?string $exp): array
    {
        $units = array();

        foreach (self::$units as $item) {
            if ($item['expansion'] == $exp) {
                $units[] = $item;
            }
        }

        return $units;
    }

    public static function getUnitsByFaction(?string $faction): array
    {
        $units = array();

        foreach (self::$units as $item) {
            if ($item['faction'] == $faction) {
                $units[] = $item;
            }
        }

        return $units;
    }

    private static function unitCost(array $unit): ?int
    {
        $plus = $unit['faction'] == "mercenaries" ? 1 : 0;
        return $unit['speed'] + $unit['atk'] + $unit['range'] + (ceil($unit['move'] / 2)) + $plus - 2;
    }

}
