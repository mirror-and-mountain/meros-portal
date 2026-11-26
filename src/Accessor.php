<?php 

namespace MM\Meros\Portal;

use Illuminate\Support\Facades\Facade;

class Accessor extends Facade {
    protected static function getFacadeAccessor() {
        return MerosPortal::class;
    }
}