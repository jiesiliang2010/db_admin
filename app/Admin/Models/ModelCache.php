<?php


namespace App\Admin\Models;

use Closure;
use Illuminate\Support\Facades\Cache;

trait ModelCache
{
    /**
     * @todo 由于上层方法的不确定性 例如闭包 key的唯一性需要自己保证
     * @param $key
     * @param Closure $callback
     * @param int $ttl
     * @return mixed
     */
    public function getCache($key, Closure $callback, $ttl = 3600)
    {
        $key = implode([$this->cacheVersion ?: 'v', str_replace('\\', '_', strtolower(get_called_class())), $key], ':');
        if (env('MODEL_CACHE_BUS_KEY', true)) {
            return Cache::remember($key, $ttl, function () use ($key, $callback) {
                $lock_key = 'lock:' . $key;
                return Cache::store('redis')->lock($lock_key, env('MODEL_CACHE_LOCKER_SECONDS', 60))->get($callback) ?: collect();
            });
        }
        return $callback();
    }
}
