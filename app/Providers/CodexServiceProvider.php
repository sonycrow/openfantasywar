<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class CodexServiceProvider extends ServiceProvider
{
    protected static array $codex;

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
        $codex = json_decode(Storage::disk('public')->get("codex.json"), true);

        foreach ($codex['item'] as $item)
        {
            $item['id']  = strtolower($item['type']) . "_";
            $item['id'] .= (isset($item['faction']) ? strtolower($item['faction']) . "_" : null);
            $item['id'] .= str_replace(" ", "-", strtolower($item['name'])) . "_";
            $item['id'] .= ($item['wounded'] ? "wounded_" : null);

            $item['id'] = substr($item['id'], 0, -1); // Eliminamos el _ final

            $item['art']   = "resources/art/{$item['universe']}/{$item['type']}/{$item['id']}.png";
            $item['image'] = "resources/sticker/{$item['universe']}/{$item['type']}/{$item['id']}.png";

            $item['cost']  = $item['cost'] ?? self::unitCost($item);

            self::$codex[] = $item;
        }
    }

    public static function getUnit(string $id): array
    {
        foreach (self::$codex as $item) {
            if ($item['id'] == $id) {
                return $item;
            }
        }

        return array();
    }

    public static function getUnits(): array
    {
        return self::$codex;
    }

    public static function getUnitsByType(?string $type): array
    {
        $units = array();

        if (!$type) return $units;

        foreach (self::$codex as $item) {
            if ($item['type'] == $type) {
                $units[] = $item;
            }
        }

        return $units;
    }

    public static function getUnitsByFaction(?string $faction): array
    {
        $units = array();

        if (!$faction) return $units;

        foreach (self::$codex as $item) {
            if (isset($item['faction']) && $item['faction'] == $faction) {
                $units[] = $item;
            }
        }

        return $units;
    }

    private static function unitCost(array $unit): ?int
    {
        if (in_array($unit['type'], array('building'))) return null;

        $plus = $unit['faction'] == "mercenaries" ? 1 : 0;

        $speedcost = array("s" => 4, "a" => 3, "b" => 2, "c" => 1, "d" => 0);
        return $speedcost[strtolower($unit['speed'])] + $unit['atk'] + $unit['range'] + $unit['move'] + $plus - 3;
    }

}
