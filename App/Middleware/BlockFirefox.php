<?php

namespace App\Middleware;

use hisorange\BrowserDetect\Parser as Browser;

use App\Middleware\Contract\MiddlewareInterface;

class BlockFirefox implements MiddlewareInterface{
    public function handle(){
        //var_dump(Browser::isMobile());
        //var_dump(Browser::isTablet());
        //var_dump(Browser::isDesktop());
        if(Browser::isFirefox()){
            die('Firefox was blocked');
        }
    }
}