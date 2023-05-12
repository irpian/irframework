<?php
class module {

    function active()
    {
        global $config;
        $module = $config['module']['list'];
        return $module;
    }

    function alias($alias="")
    {
        global $config;

        if(!empty($config['module']['alias'][$alias])){
            $module = $config['module']['alias'][$alias];
        }else{
            $module = $config['module']['default'];
        }
        return $module;
    }

    function state()
    {
        global $config;

        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $request_url = rtrim($request_url, '/');
        $path = explode('/', $request_url);
        array_shift($path);

        if(!empty($path) && $path[0] == $config['state']['backend'] ){
            $state = "backend";
        }elseif(!empty($path) && $path[0] == $config['state']['api'] ){
            $state = "api";
        } else {
            $state = "frontend";
        }

        return $state;
    }

    function available()
    {
        global $config;

        $get = $this->set();

        if(in_array($get, $config['module']['list'])) {
            $available = true;
        } else {
            $available = false;
        }

        return $available;
    }

    function set()
    {
        global $config;

        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $request_url = rtrim($request_url, '/');
        $path = explode('/', $request_url);
        array_shift($path);

        if(empty($path[0])){
            $path[0] = "";
        }

        if(empty($path[1])){
            $path[1] = "";
        }

        if(!empty($path) && $path[0] == $config['state']['backend']){ 
            $module = $this->alias($path[1]);
        }elseif(!empty($path) && $path[0] == $config['state']['api']){
            $module = $this->alias($path[1]);
        }elseif(!empty($path) && !empty($path[0])){
            $module = $this->alias($path[0]);
        } else {
            $module = $this->alias();
        }

        return $module;
    }
}

$module = new Module();