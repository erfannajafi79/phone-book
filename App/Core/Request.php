<?php 
namespace App\Core;


class Request {
    private $params;
    private $route_params = [];
    private $method;
    private $agent;
    private $ip;
    private $uri;

    public function __construct()
    {

        foreach($_REQUEST as $key => $value){
            $_REQUEST[$key] = xss_clean($value);
        }

        $this->params = $_REQUEST;
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->uri = strtok($_SERVER['REQUEST_URI'] , '?');

    }


    public function add_route_param($key , $value){
        //nice_dump("$key => $value");
        $this->route_params[$key] = $value;
    }
    public function get_route_param($key){
        return $this->route_params[$key];
    }
    public function get_route_params(){
        return $this->route_params;
    }

    public function getParams(){
        return $this->params;
    }
    public function getMethod(){
        return $this->method;
    }
    public function getAgent(){
        return $this->agent;
    }
    public function getIp(){
        return $this->ip;
    }
    public function getUri(){
        return $this->uri;
    }

    public function input($key){
        return $this->params[$key] ?? null;
    }

    public function isset($key){
        return isset($this->params[$key]);
    }

    public function redirect($route){
        header("Location:" . site_url($route));
        die();
    }

}
