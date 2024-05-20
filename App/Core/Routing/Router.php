<?php
namespace App\Core\Routing;

use App\Core\Request;
use App\Middleware\GlobalMiddleware;
use Exception;

class Router{
    private $request;
    private $routes;
    private $current_route;
    const BASE_CONTROLLER = '\App\Controllers\\';

    public function __construct(){
        $this->request = new Request();
        $this->routes = Route::routes();
        //var_dump($this->routes);
        $this->current_route = $this->findRoute($this->request) ?? null;
        //var_dump($this->current_route);

        #run middleware
        $this->run_global_middleware();
        $this->run_route_middleware();
    }

    private function run_global_middleware(){
        $global_middleware = new GlobalMiddleware();
        $global_middleware->handle();
    }

    private function run_route_middleware(){
        if(is_null($this->current_route)){
            return;
        }
        $middleware = $this->current_route['middleware'];
        //var_dump($middleware);
        foreach ($middleware as $middleware_class) {
            $middleware_object = new $middleware_class;
            $middleware_object->handle();
        }
    }

    public function findRoute(Request $request){
        //echo  $request->getMethod() . " " . $request->getUri();
        foreach($this->routes as $route){
            if ( $this->regex_matched($route)) {
                return $route;
            }
        }
        return null;
    }


    public function regex_matched($route){
        global $request;
        $pattern = "/^".str_replace(['/','{','}'],['\/','(?<','>[-%\w]+)'],$route['uri'])."$/";
        $result = preg_match($pattern , $this->request->getUri() , $matches);
        if(!$result){
            return false;
        }
        foreach($matches as $key => $value){
            if(!is_int($key)){
                $request->add_route_param($key , $value);
            }
        }
        return true;

    }


    public function dispatch404(){
        header("HTTP/1.0 404 Not Found");
        //echo "404: Not Found";
        //include BASEPATH . "/views/errors/404.php";
        view('errors.404');
        die(); 
    }

    public function dispatch405(){
        header("HTTP/1.0 405 Method Not Allowed");
        //echo "405: Method Not Allowed";
        //include BASEPATH . "/views/errors/405.php";
        view('errors.405');
        die(); 
    }

    private function dispatch($route){
        
        $action = $route['action'];
        # action : null
        if(is_null($action) || empty($action)){
            return;
        }

        # action:  closure
        if(is_callable($action)){
            $action();
            //call_user_func($action);
        }


        # action : Controller@Method
        if(is_string($action)){
            $action = explode('@' , $action);
        }

        # action : ['Controller' , 'Method']
        if(is_array($action)){
            $class_name = self::BASE_CONTROLLER . $action[0];
            $method = $action[1];
            if(!class_exists($class_name)){
                throw new \Exception("Class $class_name Not Exists!");
            }
            $controller = new $class_name();
            if(!method_exists($controller , $method)){
                throw new \Exception("Class $method Not Exists in class $class_name !");
            }
            $controller->{$method}();

        }


    }


    public function run(){

        # 404 : uri not found
        if(is_null($this->current_route))
        {
            $this->dispatch404();
        }

        # 405 : invalid request method
        else if ( !(in_array($this->request->getMethod() , $this->current_route['methods'])) )
        {
            $this->dispatch405();
        }
        


        $this->dispatch($this->current_route);
        


    }


}