<?php


namespace App\Admin\Models;


use Illuminate\Support\Collection;

class EmptyObj extends Collection
{

    public static function instance(){
        return new static;
    }
}
