<?php

namespace App\Admin\Traits;

trait PublicHelpers
{
    public function replaceCachePrefix(string $prefix, array $multiReplace)
    {
        foreach ($multiReplace as $key => $value) {
            $prefix = str_replace($key, $value, $prefix);
        }
        return $prefix;
    }
}
