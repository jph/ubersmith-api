<?php

class Ubersmith
{
  private $endpoint, $auth_string, $arguments_to_send, $result, $request_url, $response;

  function __construct($api_ip, $api_user, $api_pass)
  {
    $this->endpoint    = 'http://' . $api_ip . '/api/2.0/?';
    $this->curl_handle = curl_init();
    $this->auth_string = $api_user . ':' . $api_pass;

    curl_setopt($this->curl_handle, CURLOPT_SSL_VERIFYPEER,                     0);
    curl_setopt($this->curl_handle, CURLOPT_SSL_VERIFYHOST,                     0);
    curl_setopt($this->curl_handle, CURLOPT_HEADER,                             0);
    curl_setopt($this->curl_handle, CURLOPT_RETURNTRANSFER,                     1);
    curl_setopt($this->curl_handle, CURLOPT_USERPWD,           $this->auth_string); 
    curl_setopt($this->curl_handle, CURLOPT_ENCODING,"");
 }

  public function execute()
  {
    if(strlen($this->request_url) < 1)
      throw new Exception("No method called.");

    curl_setopt($this->curl_handle, CURLOPT_URL, $this->request_url);
    $this->result = curl_exec($this->curl_handle);
  }

  private function generate_url()
  {
    $this->request_url = $this->endpoint . 'method=' . $this->provided_method . "&";
    foreach($this->provided_arguments as $key => $val)
    {
      $this->request_url .= $key . "=" . $val . "&";
    }
  }

  public function __call($method, $args)
  {
    $this->provided_method = preg_replace('/_/', '.', $method, 1);
    $this->provided_arguments = (array) json_decode($args[0]);

    if(count($this->provided_arguments) == 0) throw new Exception("No valid arguments provided.");

    $this->generate_url();

    return $this;
  }

  public function result()
  {
    return $this->result;
  }

}
