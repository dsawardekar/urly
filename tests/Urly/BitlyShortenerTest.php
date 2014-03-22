<?php

namespace Urly;

use Urly\BitlyShortener;
use Encase\Container;

class BitlyShortenerTest extends \PHPUnit_Framework_TestCase {

  function setup() {
    $this->container = new Container();
    $this->container->object('bitly_api_key', getenv('BITLY_API_KEY'));
    $this->container->object('bitly_login', getenv('BITLY_LOGIN'));
    $this->container->object('shortener', new BitlyShortener());

    $this->shortener = $this->container->lookup('shortener');
  }

  function test_it_an_api_key() {
    $this->assertNotEmpty($this->shortener->bitly_api_key);
  }

  function test_it_has_an_api_login() {
    $this->assertNotEmpty($this->shortener->bitly_login);
  }

  function test_it_can_build_bitly_query_url() {
    $queryUrl = $this->shortener->build('http://php.net/');
    $this->assertRegExp(
      '/^http:\/\/api.bitly.com\/v3\/shorten/',
      $queryUrl
    );
  }

  function test_it_can_fetch_remote_url() {
    $response = $this->shortener->fetch('http://google.com/robots.txt');
    $this->assertNotEmpty($response);
  }

  function test_it_can_parse_json_response() {
    $json = $this->shortener->parse('{ "foo": "bar" }');
    $this->assertEquals('bar', $json['foo']);
  }

  function test_it_can_shorten_url_using_bitly_api() {
    $shortUrl = $this->shortener->shorten('http://php.net/');
    $this->assertEquals('http://bit.ly/1lbLL7F', $shortUrl);
  }

}

?>
