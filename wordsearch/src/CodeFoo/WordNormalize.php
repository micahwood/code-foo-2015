<?php namespace CodeFoo;

trait WordNormalize {

  /**
   * Remove any new line characters and convert all letters to lower case
   *
   * @param string $content
   * @return string
   */
  private function normalize($content)
  {
    return rtrim(strtolower($content));
  }
}