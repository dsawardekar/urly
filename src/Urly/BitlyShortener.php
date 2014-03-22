<?php

namespace Urly;

use Urly\IShortener;

class BitlyShortener {

  function needs() {
    return array('bitly_api_key', 'bitly_login');
  }

  function shorten($url) {
    $query    = $this->build($url);
    $response = $this->fetch($query);
    $json     = $this->parse($response);
    $shortUrl = $json['data']['url'];

    return $shortUrl;
  }

  function build($url) {
    $api      = 'http://api.bitly.com/v3/shorten';
    $url      = urlencode($url);
    $queryUrl = "$api?longUrl=$url&login={$this->bitly_login}&apiKey={$this->bitly_api_key}";

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
