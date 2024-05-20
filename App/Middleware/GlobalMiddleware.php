<?php

namespace App\Middleware;

use App\Middleware\Contract\MiddlewareInterface;

use hisorange\BrowserDetect\Parser as Browser;

class GlobalMiddleware implements MiddlewareInterface{
    public function handle(){
        //example browser , ip , country ...
        if(Browser::isFirefox()){
            die('firefox was blocked');
        }
        $this->sanitizeGetParams();
    }
    

    public function sanitizeGetParams()
    {
        foreach($_GET as $key => $value){
            $_GET[$key] = xss_clean($value);
        }
    }
}