<?php

namespace App\Services;

class ThemeService
{
    /**
     * Get the currently active theme name.
     */
    public static function getTheme(): string
    {
        return env('ACTIVE_THEME', 'theme1');
    }

    /**
     * Resolve a theme-specific view if it exists, otherwise fall back to the default view.
     *
     * @param string $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\View\View
     */
    public static function view(string $view, array $data = [], array $mergeData = [])
    {
        $theme = self::getTheme();

        if ($theme !== 'theme1') {
            $themedView = "{$theme}.{$view}";
            if (view()->exists($themedView)) {
                return view($themedView, $data, $mergeData);
            }
        }

        return view($view, $data, $mergeData);
    }

    /**
     * Determine if a theme has a custom dashboard layout.
     */
    public static function hasThemedDashboardLayout(): bool
    {
        $theme = self::getTheme();
        return $theme !== 'theme1' && view()->exists("{$theme}.layouts.dashboard");
    }

    /**
     * Get the appropriate dashboard layout name.
     */
    public static function getDashboardLayout(): string
    {
        $theme = self::getTheme();
        if ($theme !== 'theme1' && view()->exists("{$theme}.layouts.dashboard")) {
            return "{$theme}.layouts.dashboard";
        }

        return 'layouts.dashboardLayout';
    }
}
