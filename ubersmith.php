<?php

class Ubersmith
{
  private $endpoint, $auth_string, $arguments_to_send, $result, $request_url, $response;

  function __construct($api_addr, $api_user, $api_pass,$curlopts_array=array())
  {
    $this->endpoint = $api_addr . '/api/2.0/';
    $this->curl_handle = curl_init();
    $this->auth_string = $api_user . ':' . $api_pass;

    curl_setopt($this->curl_handle, CURLOPT_SSL_VERIFYPEER,                     0);
    curl_setopt($this->curl_handle, CURLOPT_SSL_VERIFYHOST,                     0);
    curl_setopt($this->curl_handle, CURLOPT_HEADER,                             0);
    curl_setopt($this->curl_handle, CURLOPT_RETURNTRANSFER,                     1);
    curl_setopt($this->curl_handle, CURLOPT_USERPWD,           $this->auth_string); 
    curl_setopt($this->curl_handle, CURLOPT_ENCODING,"");
    curl_setopt_array($this->curl_handle,$curlopts_array);
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
    $this->request_url = $this->endpoint . "?" . 'method=' . rawurlencode($this->provided_method) . "&";
    foreach($this->provided_arguments as $key => $val)
    {
      $this->request_url .= rawurlencode($key) . "=" . rawurlencode($val) . "&";
    }
    if(count($this->provided_arguments)>0){
      $this->request_url=substr($this->request_url, 0, -1);//remove the last &
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
