<?php

use CodeFoo\WordsearchFileBuilder;
use CodeFoo\Wordsearch;
use CodeFoo\Word;

require 'vendor/autoload.php';

$puzzle = new Wordsearch(new WordsearchFileBuilder('wordsearch.txt', 20));
$wordList = build_word_list();

foreach ($wordList as $word)
{
  $puzzle->find($word);
  echo $word->status() . "\n";
}

function build_word_list()
{
  $words = [
    'BLINKY',
    'SHINRA',
    'RAPTURE ',
    'ANIMUS',
    'FIREFLY ',
    'WALKERS',
    'TARDIS ',
    'EPONA ',
    'CREEPER',
    'AVENGER',
    'PATRONUS ',
    'WESTEROS',
    'IFRIT',
    'ARKHAM',
    'VAULT',
    'CLAPTRAP ',
    'NORMANDY',
    'REAVER',
    'HEISENBERG',
    'STARK ',
    'MORDOR',
    'BIRDMAN ',
    'TITAN',
    'OCULUS',
    'GOOMBA',
    'KATAMARI',
  ];

  return array_map(function($word) use ($words)
  {
    return new Word($word);
  }, $words);
}