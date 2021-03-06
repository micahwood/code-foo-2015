<?php namespace CodeFoo;

class Wordsearch {

  /**
   * The wordsearch puzzle
   *
   * @var array
   */
  protected $puzzle;

  /**
   * The rowIndex and colIndex where the first letter of the word was found
   *
   * @var array
   */
  protected $startPoint;

  /**
   * A map of offsets to apply to each index of the wordsearch when searching
   * each direction. Offsets are used to determine the next index to search
   * relative to the current character being checked.
   *
   *      --   -0   -+
   *      0-    *   0+
   *      +-   +0   ++
   *
   * @var array
   */
  protected $directionMap = [
    'right' => [0, 1],
    'left' => [0, -1],
    'up' => [-1, 0],
    'down' => [1, 0],
    'upleft' => [-1, -1],
    'upright' => [-1, 1],
    'downright' => [1, 1],
    'downleft' => [1, -1]
  ];

  /**
   * Create a new wordsearch from the provided builder
   *
   * @param WordsearchBuilder $builder
   */
  public function __construct(WordsearchBuilder $builder)
  {
    $this->puzzle = $builder->create();
  }

  /**
   * Search for the given word within the crossword.
   * If the word is found, $word->foundAt will be called.
   *
   * @param Word $word
   * @return boolean
   */
  public function find(Word $word)
  {
    foreach ($this->puzzle as $rowIndex => $row)
    {
      foreach ($row as $charIndex => $char)
      {
        if ($this->wordIsFoundOnRow($word, $rowIndex, $char, $charIndex))
        {
          return true;
        }
      }
    }

    return false;
  }

  /**
   * Check if the first letter of the word is on the current row,
   * and search for the word in all directions if it is.
   *
   * @param Word $word
   * @param int $rowIndex
   * @param char $char
   * @param int $charIndex
   * @return boolean
   */
  private function wordIsFoundOnRow(Word $word, $rowIndex, $char, $charIndex)
  {
    $found = false;
    if ($char == $word->firstLetter())
    {
      $this->startPoint = [$rowIndex, $charIndex];
      $found = $this->checkAllDirections($word);
    }

    return $found;
  }

  /**
   * Using the directionMap, check each direction from the current location
   * to try and find the word
   *
   * @param Word $word
   * @return boolean
   */
  private function checkAllDirections(Word $word)
  {
    list($rowIndex, $charIndex) = $this->startPoint;
    $directions = $this->directionMap;
    while ($directionOffsets = array_shift($directions))
    {
      if ($this->wordFoundThatDirection($word, $directionOffsets))
      {
        return true;
      }
    }

    return false;
  }

  /**
   * Search in a specific direction for the word
   *
   * @param Word $word
   * @param array $directionOffsets
   * @return boolean
   */
  public function wordFoundThatDirection(Word $word, $directionOffsets)
  {
    $length = $word->length();
    list($rowOffset, $colOffset) = $directionOffsets;
    for ($i=1; $i < $length; $i++)
    {
      if (! $this->nextCharIsFound($word, $i, $rowOffset * $i, $colOffset * $i))
      {
        return false;
      }
    }
    $end = $this->findEndPointForDirection($rowOffset, $colOffset, $length);
    $word->foundAt($this->startPoint, $end);

    return true;
  }

  /**
   * Check if the next character in the wordsearch is not out of bonds and
   * that it matches the next character of the word
   *
   * @param Word $word
   * @param int $wordIndex
   * @param int $rowOffset
   * @param int $colOffset
   * @return boolean
   */
  private function nextCharIsFound(Word $word, $wordIndex, $rowOffset, $colOffset)
  {
    $row = $this->startPoint[0] + $rowOffset;
    $col = $this->startPoint[1] + $colOffset;
    // check if we have hit the edge of the crossword
    // and if the next char in the puzzle matches the word
    return isset($this->puzzle[$row][$col]) &&
           substr($word, $wordIndex, 1) == $this->puzzle[$row][$col];
  }

  /**
   * Determine where the last letter of the word was found
   *
   * @param int $rowOffset
   * @param int $colOffset
   * @param int $length
   * @return array
   */
  private function findEndPointForDirection($rowOffset, $colOffset, $length)
  {
    list($row, $col) = $this->startPoint;
    $endRow = $this->calculatePointForDirection($row, $rowOffset, $length);
    $endCol = $this->calculatePointForDirection($col, $colOffset, $length);

    return [$endRow, $endCol];
  }

  /**
   * Calculate the coordinates of the last letter of
   * the word based on the directionMap offsets
   *
   * @param int $start
   * @param int $offset
   * @param int $length
   * @return int
   */
  private function calculatePointForDirection($start, $offset, $length)
  {
    return ($offset == 0) ? $start : $start + ($length * $offset) + (-1 * $offset);
  }

}
