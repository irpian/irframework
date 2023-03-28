<?php
class Route(){
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

    function route($route, $path_to_include){
      $callback = $path_to_include;
      if( !is_callable($callback) ){
        if(!strpos($path_to_include, '.php')){
          $path_to_include.='.php';
        }
      }

      if($route == "/404"){
        include_once __DIR__."/$path_to_include";
        exit();
      }

      $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
      $request_url = rtrim($request_url, '/');
      $request_url = strtok($request_url, '?');
      $route_parts = explode('/', $route);
      $request_url_parts = explode('/', $request_url);
      array_shift($route_parts);
      array_shift($request_url_parts);
      if( $route_parts[0] == '' && count($request_url_parts) == 0 ){
        // Callback function
        if( is_callable($callback) ){
          call_user_func_array($callback, []);
          exit();
        }
        include_once __DIR__."/$path_to_include";
        exit();
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
      include_once __DIR__."/$path_to_include";
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

    function module(){
      global $config;

      $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
      $request_url = rtrim($request_url, '/');
      $request_url_parts = explode('/', $request_url);
      array_shift($request_url_parts);
      
      $list_module = ""; // get module available
      $alias = ""; //aray search

      if(in_array($alias, $list_module)){
        $module = $config['module'];
      } else  {
        $module = $config['module']['default'];
      }

      return $module;
    }

    function state(){
         global $config;

         if($param[1] == $config['backend'] ){
             $state = "backend";
         } else {
             $state = "frontend";
         }

         return $this->state;
     }

     function set(){
         global $config;
         $module = $this->module();

         if($this->state() == "backend"){
             if(in_array($alias, $list_module)){
                 include "modules/".$module."/backend/route.php";
             }else{
                 include "modules/".$config['module']['default']."/backend/route.php";
             }
         } else {
             if(in_array($alias, $list_module)){
                 include "modules/".$module."/route.php";
             }else{
                 include "modules/".$config['module']['default']."/route.php";
             }
         }
     }

}

//----------------------------

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');

// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
get('/user/$id', 'views/user');

// Dynamic GET. Example with 2 variables
// The $name will be available in full_name.php
// The $last_name will be available in full_name.php
// In the browser point to: localhost/user/X/Y
get('/user/$name/$last_name', 'views/full_name.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
get('/product/$type/color/$color', 'product.php');

// A route with a callback
get('/callback', function(){
  echo 'Callback executed';
});

// A route with a callback passing a variable
// To run this route, in the browser type:
// http://localhost/user/A
get('/callback/$name', function($name){
  echo "Callback executed. The name is $name";
});

// A route with a callback passing 2 variables
// To run this route, in the browser type:
// http://localhost/callback/A/B
get('/callback/$name/$last_name', function($name, $last_name){
  echo "Callback executed. The full name is $name $last_name";
});

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');

// class Route(){

//  public $request;

//  public function __construct() {
//    $this->request = new Request();
//  }

//  function get_name() {

//  }

//  function state(){
//      global $config;
//      if($param[1] == "admin"){
//          $state = "backend";
//      } else {
//          $state = "frontend";
//      }

//      return $this->state;
//  }

//  function alias(){

//      return $alias;
//  }

//  function last(){

//  }

//  function set(){
//      global $config;
//      if($this->state() == "backend"){
//          if(in_array($alias, $list_module)){
//              include "modules/".$alias."/backend/route.php";
//          }else{
//              include "modules/".$config['module']['default']."/backend/route.php";
//          }
//      } else {
//          if(in_array($alias, $list_module)){
//              include "modules/".$alias."/route.php";
//          }else{
//              include "modules/".$config['module']['default']."/route.php";
//          }
//      }
//  }
// }


$route = new Route():
$route->set();
?>
