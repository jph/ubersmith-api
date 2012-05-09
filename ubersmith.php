<?php

# example query
# http://27.131.77.74/api/list_services.php?api_login=apiuser&api_pass=apiuser&clientid=1001

class UbersmithAPIAPI {

  private $endpoint, $api_user, $api_pass;

  var $ubersmith_functions = [ 'list_services' => 'list_services.php' ];
  var $ubersmith_arguments = [ 'list_services' => [ 'clientid' ] ];

  function __construct($endpoint, $api_user, $api_pass)
  {
    $this->endpoint  = $endpoint;
    $this->api_user  = $api_user;
    $this->api_pass  = $api_pass;
  }

  private function xml_to_json() {}
  private function generate_url() {}
  private function request() {}

  public function __call($method, $args)
  {
    $this->method = $method;
    $this->args   = json_decode($args);

    foreach($this->ubersmith_arguments[$method] as $argument)
    {
      
    }

  }

}

$api = new UbersmithAPIAPI('http://27.131.77.74/api/', 'apiuser', 'apipass');

$args = explode('/', $_GET["q"]);
array_shift($args);
array_shift($args);
array_shift($args);
$function = array_shift($args);

$result = $api->$function(json_encode($args));
print_r($result);
