<?php

namespace Urly;

use Encase\Container;
use Urly\Options;
use Urly\Version;

class App {

  public $container;

  function __construct() {
    $this->container = new Container();
    $this->container
         ->object('options', new Options())
         ->object('bitly_api_key', getenv('BITLY_API_KEY'))
         ->object('bitly_login', getenv('BITLY_LOGIN'))
         ->factory('url_shortener', new BitlyShortner())
         ->factory('url_expander', new LongurlExpander());
  }

  function run() {
    if (!$this->hasKeys()) {
      echo "Bitly API keys not found.\n";
      echo "Urly needs Environment Variables, BITLY_API_KEY & BITLY_LOGIN";
      return;
    }

    $opts = $this->options();

    switch ($opts['action']) {
      case 'expand':
        $this->expand($opts['value']);
        break;

      case 'shorten':
        $this->shorten($opts['value']);
        break;

      case 'version':
        echo Version::version;
        break;

      case 'help':
        $this->help();
        break;

      default:
        $this->unknown();
    }
  }

  function hasKeys() {
    return !empty($this->lookup('bitly_api_key')) &&
           !empty($this->lookup('bitly_login'));
  }

  function options() {
    return $this->lookup('options')->load();
  }

  function lookup($key) {
    return $this->container->lookup($key);
  }

  function expand($url) {
    $expander = $this->lookup('url_expander');
    $expansion = $expander->expand($url);

    echo $expansion;
  }

  function shorten($url) {
    $shortener = $this->lookup('url_shortener');
    $shorturl = $shortener->shorten($url);

    echo $shorturl;
  }

  function help() {
    $version = Version::version;
    $msg = <<<EOS
Usage: urly [options] URL

Options:

  -s, --shorten  Shorten URL
  -e, --expand   Expand URL
  -v, --version  Show version
  -h, --help     Show this help message
EOS;

    echo $msg;
  }

  function unknown() {
    echo "Unknown options\n";
    $this->help();
  }

}

?>
