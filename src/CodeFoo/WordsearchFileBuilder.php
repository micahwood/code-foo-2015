<?php namespace CodeFoo;

class WordsearchFileBuilder implements WordsearchBuilder {

  protected $fileName;

  protected $numRows;

  protected $puzzle = [[]];

  public function __construct($fileName, $numRows)
  {
    $this->fileName = $fileName;
    $this->numRows = $numRows;
  }

  public function create()
  {
    $file = $this->openFile();
    for ($line = 0; $line < $this->numRows; $line++)
    {
      $this->puzzle[$line] = $this->readLine($file);
    }
    fclose($file);

    return $this->puzzle;
  }

  private function openFile()
  {
    $file = fopen($this->fileName, 'r');
    if (! $file)
    {
      throw new \Exception('Unable to locate ' . $this->fileName);
    }

    return $file;
  }

  private function readLine($file)
  {
    $content = $this->normalizeContent(fgets($file));
    if (! $content)
    {
      throw new \Exception($this->fileName . ' contains a blank line which does not belong in a word search');
    }

    return explode(' ', $content);
  }


  private function normalizeContent($content)
  {
    return rtrim(strtolower($content));
  }
}