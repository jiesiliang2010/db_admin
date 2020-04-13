<?php


namespace App\Admin\Models;

use App\Admin\Models\ModelCache;

use App\Admin\Facades\ModelCacheFace;
use Closure;
use Illuminate\Support\Collection;

class BaseModel extends Model
{
    use ModelCache;
    public function cacheTap($ttl = 3600){
        $this->ttl = $ttl;
        return app(ModelCacheFace::class)->instance($this);
    }
}
