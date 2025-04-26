<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = ['key', 'value'];
    
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $settings = self::getAllCached();
        
        return $settings[$key] ?? $default;
    }
    
    /**
     * Get all settings as a cached array
     *
     * @return array
     */
    public static function getAllCached()
    {
        return Cache::remember('settings', now()->addDay(), function () {
            return self::pluck('value', 'key')->toArray();
        });
    }
}