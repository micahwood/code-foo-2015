<?php namespace CodeFoo;

class Word {

  protected $word;

  protected $start = [];

  protected $end = [];

  protected $found = false;

  function __construct($word)
  {
    $this->word = strtolower($word);
  }

  public function foundAt($start, $end)
  {
    $this->start = $start;
    $this->end = $end;
    $this->found = true;
  }

  public function isFound()
  {
    return $this->found;
  }

  public function length()
  {
    return strlen($this->word);
  }

  public function firstLetter()
  {
    return $this->word[0];
  }

  public function status()
  {
    if ($this->isFound())
    {
      return sprintf('%s was found at position %s - %s',
          $this->word, implode(', ', $this->start), implode(', ', $this->end));
    }

    return "{$this->word} was not found";
  }

  public function __toString()
  {
    return $this->word;
  }


  // /** ArrayAccess methods */
  // public function offsetSet($offset, $value)
  // {
  //   $this->word[$offset] = $value;
  // }

  // public function offsetExists($offset)
  // {
  //   return isset($this->word[$offset]);
  // }

  // public function offsetUnset($offset)
  // {
  //   unset($this->word[$offset]);
  // }

  // public function offsetGet($offset)
  // {
  //   return isset($this->word[$offset]) ? $this->word[$offset] : null;
  // }
}