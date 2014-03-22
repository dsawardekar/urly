<?php

namespace Urly;

use Urly\LongurlExpander;

class LongurlExpanderTest extends \PHPUnit_Framework_TestCase {

  function setup() {
    $this->expander = new LongurlExpander();
  }

  function test_it_can_build_query_url() {
    $queryUrl = $this->expander->build('http://foo.com');
    $this->assertRegExp(
      '/^http:\/\/api.longurl.org\/v2\/expand?/',
      $queryUrl
    );
  }

  function test_it_can_fetch_http_response() {
    $response = $this->expander->fetch('http://google.com/robots.txt');
    $this->assertNotEmpty($response);
  }

  function test_it_can_parse_json_response() {
    $json = $this->expander->parse('{"long-url": "foo"}');
    $this->assertEquals('foo', $json['long-url']);
  }

  function test_it_can_expand_a_bitly_url() {
    $url = 'http://bit.ly/1g4WFbz';
    $longUrl = $this->expander->expand($url);

    $this->assertEquals('http://php.net/', $longUrl);
  }

}

?>
