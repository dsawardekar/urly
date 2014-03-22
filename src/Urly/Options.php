<?php

namespace Urly;

class Options {

  public $shortopts = "s:e:v::h::";
  public $longopts = array(
    "shorten",
    "expand",
    "version",
    "help"
  );

  function load() {
    $result = getopt($this->shortopts, $this->longopts);
    $action = null;
    $value = null;

    /* Looks for an option key, if it exist assigns a corresponding
     * action. Eg:- -s => shorten
     *
     * For options with values, also assigns a value for the action.
     * Eg:- -s foo => foo is url for shorten
     *
     * help & version if present override other options.
     *
     * The App will use this `action` and decide whether to shorten
     * the url, or expand it or to show the help message.
     */
    if (array_key_exists('h', $result)) {
      $action = 'help';
    } else if (array_key_exists('help', $result)) {
      $action = 'help';
    } else if (array_key_exists('v', $result)) {
      $action = 'version';
    } else if (array_key_exists('version', $result)) {
      $action = 'version';
    } else if (array_key_exists('s', $result)) {
      $action = 'shorten';
      $value = $result['s'];
    } else if (array_key_exists('shorten', $result)) {
      $action = 'shorten';
      $value = $result['shorten'];
    } else if (array_key_exists('e', $result)) {
      $action = 'expand';
      $value = $result['e'];
    } else if (array_key_exists('expand', $result)) {
      $action = 'expand';
      $value = $result['expand'];
    } else {
      $action = 'unknown';
    }

    return array('action' => $action, 'value' => $value);
  }

}

?>
