<?php

# example query
# http://27.131.77.74/api/list_services.php?api_login=apiuser&api_pass=apiuser&clientid=1001

class Ubersmith
{

  private $endpoint, $api_user, $api_pass, $arguments_to_send, $result, $request_url, $response;

  var $ubersmith_functions = [ 'list_services' => 'list_services.php' ];
  var $ubersmith_arguments = [ 'list_services' => [ 'clientid' ] ]; # true is required

  function __construct($endpoint, $api_user, $api_pass)
  {
    $this->endpoint  = $endpoint;
    $this->api_user  = $api_user;
    $this->api_pass  = $api_pass;
  }

  private function xml_to_json() {}
  private function generate_url()
  {
    $this->request_url = $this->endpoint . $this->provided_method . ".php?api_login=" . $this->api_user . "&api_pass=" . $this->api_pass . "&";
    foreach($this->arguments_to_send as $key => $val)
    {
      $this->request_url .= $key . "=" . $val . "&";
    }
  }

  private function request() {}
  private function result() {}

  public function __call($method, $args)
  {
    $this->provided_method = $method;
    if(!$method)
      throw new Exception("Method does not exist");

    $this->provided_arguments = json_decode($args[0]);
    foreach($this->provided_arguments as $provided_argument => $provided_value)
    {
      if(array_search($provided_argument, $this->ubersmith_arguments[$this->provided_method]) !== FALSE)
        $this->arguments_to_send[$provided_argument] = $provided_value;
    }
    if(count($this->arguments_to_send) == 0)
      throw new Exception("No valid arguments provided.");

    $this->generate_url();
    $this->response = $this->request($request_url);

    return $this;
  }

  public function result()
  {
    if($this->result)
      return $this->result;
    else
      return false;
  }

}
