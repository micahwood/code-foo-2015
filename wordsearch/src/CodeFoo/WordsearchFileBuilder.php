<?php namespace CodeFoo;

class WordsearchFileBuilder implements WordsearchBuilder {

  use WordNormalize;

  /**
   * The name of the file containing the wordsearch
   *
   * @var string
   */
  protected $fileName;

  /**
   * The number of rows in the wordsearch. Used if the given file contains
   * extra data below the wordsearch that should not be included
   *
   * @var int
   */
  protected $numRows;

  /**
   * Assign the file name and size of the wordsearch to be created
   *
   * @param string $fileName
   * @param int $numRows
   */
  public function __construct($fileName, $numRows)
  {
    $this->fileName = $fileName;
    $this->numRows = $numRows;
  }

  /**
   * Create a wordsearch puzzle from a given file
   *
   * @return array
   */
  public function create()
  {
    $file = $this->openFile();
    $puzzle = [[]];
    for ($line = 0; $line < $this->numRows; $line++)
    {
      $puzzle[$line] = $this->readLine($file);
    }
    fclose($file);

    return $puzzle;
  }

  /**
   * Attempt to open the specificed file and throw an exception if not found
   *
   * @return file handler
   */
  private function openFile()
  {
    $file = fopen($this->fileName, 'r');
    if (! $file)
    {
      throw new \Exception('Unable to locate ' . $this->fileName);
    }

    return $file;
  }

  /**
   * Read a line from the file and convert it to an array
   *
   * @param file handler $file
   * @return array
   */
  private function readLine($file)
  {
    $content = $this->normalize(fgets($file));
    if (! $content)
    {
      throw new \Exception($this->fileName . ' contains a blank line which does not belong in a word search');
    }

    return explode(' ', $content);
  }
}