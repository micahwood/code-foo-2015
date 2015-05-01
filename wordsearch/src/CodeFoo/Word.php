<?php namespace CodeFoo;

class Word {

  use WordNormalize;

  /**
   * The word to search for in a wordsearch
   *
   * @var string
   */
  protected $word;

  /**
   * The coordinates of the first letter of the word in the wordsearch
   *
   * @var array
   */
  protected $start = [];

  /**
   * The coordinates of the last letter of the word in the wordsearch
   *
   * @var array
   */
  protected $end = [];

  /**
   * Flag for determining if the word was found in the wordsearch
   *
   * @var boolean
   */
  protected $found = false;

  /**
   * Create a new word to look for in a wordsearch
   *
   * @param string $word
   */
  function __construct($word)
  {
    $this->word = $this->normalize($word);
  }

  /**
   * Mark where the word was found in the wordsearch
   *
   * @param array $start
   * @param array $end
   */
  public function foundAt($start, $end)
  {
    $this->start = $start;
    $this->end = $end;
    $this->found = true;
  }

  /**
   * Check if word has been found in the wordsearch
   *
   * @return boolean
   */
  public function isFound()
  {
    return $this->found;
  }

  /**
   * Get the length of the word
   *
   * @return int
   */
  public function length()
  {
    return strlen($this->word);
  }

  /**
   * Get the first letter of the word
   *
   * @return char
   */
  public function firstLetter()
  {
    return $this->word[0];
  }

  /**
   * Print the current status of the word and the location it was found at
   *
   * @return string
   */
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
}