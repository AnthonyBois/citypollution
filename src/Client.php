<?php

namespace Formation;

class Client
{
  private $response;

  function __construct()
  {
    $this->response = new Response;
  }

  public function send(string $url, $ctx = null) : Response
  {
    $output = @file_get_contents($url, false, $ctx);

    if ($output && $http_response_header)
    {
      $status = (int) explode (" ", $http_response_header[0]) [1];
      if (200 === $status)
      {
        $this->response->setBody($output);
      }
    }
    return $this->response;
  }
}
