<?php


namespace App\Admin\Facades;

use App\Admin\Models\EmptyObj;
use Illuminate\Support\Facades\Cache;

class ModelCacheFace
{
    protected $instannce;

    public function __construct($obj = null)
    {
        $this->instannce = $obj;
    }

    public static function instance($obj)
    {
        return new static($obj);
    }

    /**
     * @param $method
     * @param $arguments
     * @return mixed
     * @todo $arguments 参数有多级数组或者对象时需要做序列化
     */
    public function __call($method, $arguments)
    {
        if (env('MODEL_CACHE_BUS_KEY', true)) {
            return Cache::remember($this->getCacheKey(...array_merge([$method], $arguments)), $this->instannce->ttl ?: 3600, function () use ($method, $arguments) {
                //缓存击穿并发锁
                $lock_key = 'lock:' . $this->getCacheKey(...array_merge([$method], $arguments));
                return Cache::store('redis')->lock($lock_key, env('MODEL_CACHE_LOCKER_SECONDS', 60))->get(function () use ($method, $arguments) {
//                    sleep(15);
                    return $this->instannce->$method(...$arguments);
                }) ?: collect();
            });
        }
        return $this->instannce->$method(...$arguments);
    }

    protected function getCacheKey(...$args)
    {
        $method = array_shift($args);
        $key = $method.':'.md5(serialize($args));
        return $key = implode([$this->instannce->cacheVersion ?: 'v', str_replace('\\', '_', strtolower(get_class($this->instannce))), $key], ':');
    }
}
