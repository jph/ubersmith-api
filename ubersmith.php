<?php

class Ubersmith
{

  private $endpoint, $api_user, $api_pass, $arguments_to_send, $result, $request_url, $response;

  var $ubersmith_functions = [ 'list_services' => 'list_services.php' ];
  var $ubersmith_arguments = [ 'list_services' => [ 'clientid' ] ];

  function __construct($endpoint, $api_user, $api_pass)
  {
    $this->endpoint    = $endpoint;
    $this->api_user    = $api_user;
    $this->api_pass    = $api_pass;
    $this->curl_handle = curl_init();

    curl_setopt($this->handle, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($this->handle, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($this->handle, CURLOPT_HEADER,         0);
    curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, 1);
 }

  private function xml_to_json()
  {
    # convert property saved by request and save (xml reader here)
  }

  private function generate_url()
  {
    $this->request_url = $this->endpoint . $this->provided_method . ".php?api_login=" . $this->api_user . "&api_pass=" . $this->api_pass . "&";
    foreach($this->arguments_to_send as $key => $val)
    {
      $this->request_url .= $key . "=" . $val . "&";
    }
  }

  private function request()
  {
    if(strlen($this->url) < 1)
      throw new Exception("No method called.");

    curl_setopt($this->curl_handle, CURL_URL, $this->request_url);
    $this->result = curl_exec($this->curl_handle);
  }

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

    return $this;
  }

  public function result()
  {
    # return json object
    return $this->result;
  }

}

# $api = new Ubersmith('', '', '');
# $api->list_services('{"clientid":1001}')->execute();
# print_r($api->result());
