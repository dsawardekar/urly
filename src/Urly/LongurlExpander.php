<?php

namespace Urly;

use Urly\IExpander;

class LongurlExpander implements IExpander {

  function expand($url) {
    $queryUrl = $this->build($url);
    $response = $this->fetch($queryUrl);
    $json     = $this->parse($response);
    $longUrl  = $json['long-url'];

    return $longUrl;
  }

  function build($url) {
    $api      = 'http://api.longurl.org/v2/expand';
    $url      = urlencode($url);
    $queryUrl = "$api?url=$url&format=json";

    return $queryUrl;
  }

  function fetch($url) {
    return file_get_contents($url);
  }

  function parse($response) {
    return json_decode($response, true);
  }


}

?>
