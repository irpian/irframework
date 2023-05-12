<?php

    function routeState(){

        global $config;

        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $request_url = rtrim($request_url, '/');
        $path = explode('/', $request_url);
        array_shift($path);

        if(!empty($path[0]) && $path[0] == $config['state']['backend'] ){
            $state = "backend";
        } elseif(!empty($path[0]) && $path[0] == $config['state']['api'] ){
            $state = "api";
        } else {
            $state = "frontend";
        }

        return $state;
    }
      
    function get($route, $path_to_include){
        if( $_SERVER['REQUEST_METHOD'] == 'GET' ){ 
            route($route, $path_to_include);
        }  
    }

    function post($route, $path_to_include){
      if( $_SERVER['REQUEST_METHOD'] == 'POST' ){ 
          route($route, $path_to_include); 
        }   
    }

    function put($route, $path_to_include){
      if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){ 
          route($route, $path_to_include); 
        }   
    }

    function patch($route, $path_to_include){
      if( $_SERVER['REQUEST_METHOD'] == 'PATCH' ){ 
          route($route, $path_to_include); 
        }   
    }

    function delete($route, $path_to_include){
      if( $_SERVER['REQUEST_METHOD'] == 'DELETE' ){ 
          route($route, $path_to_include); 
        }   
    }

    function any($route, $path_to_include){ 
        route($route, $path_to_include); 
    }

    function route($route="", $path_to_include=""){
      //-- custom
      global $config;
      $theme = new Theme();
      $module = new Module();

      $themes = $theme->name();
      $modules = $module->set();
      $state = routeState();

      //$register = false;
      //$register = register($route);

      // if(file_exists(base_root.'/themes/'.$themes_name.'/modules/'.$modules.'/'.$path_to_include)){
      //   die("here");
      //   $path_to_include = theme->base().$path_to_include;
      // } elseif(file_exists(base_root.'/modules/'.$modules.'/'.$path_to_include)){
      //   $path_to_include = 'modules/'.$modules.'/'.$path_to_include;
      // } else {

      // }

      //if($register==true){
      if(is_string($path_to_include) && preg_match('/.php/', $path_to_include)){
        if(file_exists($theme->base().'modules/'.$modules.'/'.$path_to_include)){
          $path_to_include = '/themes/'.$themes.'/modules/'.$modules.'/'.$path_to_include;
        } elseif(file_exists(base_root.'/modules/'.$modules.'/'.$path_to_include)){
          $path_to_include = '/modules/'.$modules.'/'.$path_to_include;
        } else {

        }
      }

      //   die("register ".$route);
      // } else {
      //   die("un register ".$route);
      // }

      //die($path_to_include);
      //--

      $callback = $path_to_include;
      if( !is_callable($callback) ){
        if(!strpos($path_to_include, '.php')){
          $path_to_include.='.php';
        }
      }

      if($route == "/404"){
        include_once base_root."/$path_to_include";
        exit();
      }

      $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
      $request_url = rtrim($request_url, '/');
      $request_url = strtok($request_url, '?');
      $route_parts = explode('/', $route);
      $request_url_parts = explode('/', $request_url);
      array_shift($route_parts);
      array_shift($request_url_parts);
      
      $request_parts_number = 0;
      if($state!="frontend") { 
        if($modules!=$config['module']['default']){
          $request_parts_number = 2;
        } else {
          $request_parts_number = 1;
        }
      } else {
        if($modules!=$config['module']['default']){
          $request_parts_number = 1;
        } else {
          $request_parts_number = 0;
        }
      }
      
      if( $route_parts[0] == '' && count($request_url_parts) == $request_parts_number ){
        // Callback function
        if( is_callable($callback) ){
          call_user_func_array($callback, []);
          exit();
        }
        include_once base_root."/$path_to_include";
        exit();
      } else {
        
      }

      if( count($route_parts) != count($request_url_parts) ){ return; } 

      $parameters = [];
      for( $__i__ = 0; $__i__ < count($route_parts); $__i__++ ){
        $route_part = $route_parts[$__i__];
        if( preg_match("/^[$]/", $route_part) ){
          $route_part = ltrim($route_part, '$');
          array_push($parameters, $request_url_parts[$__i__]);
          $$route_part=$request_url_parts[$__i__];
        }
        else if( $route_parts[$__i__] != $request_url_parts[$__i__] ){
          return;
        } 
      }
      
      // Callback function
      if( is_callable($callback) ){
        call_user_func_array($callback, $parameters);
        exit();
      }

      include_once base_root."/$path_to_include";
      exit();
    }

    function out($text){
        echo htmlspecialchars($text);
    }

    function set_csrf(){
      if( ! isset($_SESSION["csrf"]) ){ 
        $_SESSION["csrf"] = bin2hex(random_bytes(50)); 
        }
      echo '<input type="hidden" name="csrf" value="'.$_SESSION["csrf"].'">';
    }

    function is_csrf_valid(){
      if( ! isset($_SESSION['csrf']) || ! isset($_POST['csrf'])){
        return false;
        }
      
      if( $_SESSION['csrf'] != $_POST['csrf']){
       return false; 
        }
          return true;
    }

    //----------------------

     function routing(){
         global $config;
         
         $module = new Module();

         $modules = $module->set();
         $available = $module->available();

        //  if(state() == "backend"){
        //      if($available){
        //          include "modules/".$modules."/".$config['backend']."/route.php";
        //      }else{
        //          include "modules/".$config['module']['default']."/backend/route.php";
        //      }
        //  } else {
             if($available){
                  $route = "modules/".$modules."/route.php";
             }else{
                  $route = "modules/".$config['module']['default']."/route.php";
             }
         //}

         return $route;
     }


//----------------------------

// ##################################################
// ##################################################
// ##################################################

// // Static GET
// // In the URL -> http://localhost
// // The output -> Index
// get('/', 'views/index.php');

// // Dynamic GET. Example with 1 variable
// // The $id will be available in user.php
// get('/user/$id', 'views/user');

// // Dynamic GET. Example with 2 variables
// // The $name will be available in full_name.php
// // The $last_name will be available in full_name.php
// // In the browser point to: localhost/user/X/Y
// get('/user/$name/$last_name', 'views/full_name.php');

// // Dynamic GET. Example with 2 variables with static
// // In the URL -> http://localhost/product/shoes/color/blue
// // The $type will be available in product.php
// // The $color will be available in product.php
// get('/product/$type/color/$color', 'product.php');

// // A route with a callback
// get('/callback', function(){
//   echo 'Callback executed';
// });

// // A route with a callback passing a variable
// // To run this route, in the browser type:
// // http://localhost/user/A
// get('/callback/$name', function($name){
//   echo "Callback executed. The name is $name";
// });

// // A route with a callback passing 2 variables
// // To run this route, in the browser type:
// // http://localhost/callback/A/B
// get('/callback/$name/$last_name', function($name, $last_name){
//   echo "Callback executed. The full name is $name $last_name";
// });

// // ##################################################
// // ##################################################
// // ##################################################
// // any can be used for GETs or POSTs

// // For GET or POST
// // The 404.php which is inside the views folder will be called
// // The 404.php has access to $_GET and $_POST
// any('/404','views/404.php');


?>
