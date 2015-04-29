<?php namespace spec\CodeFoo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CodeFoo\Word;

class WordsearchSpec extends ObjectBehavior {

  function let(Word $word)
  {
    //Mock Word class
    $word->__toString()->willReturn('monkey');
    $word->firstLetter()->willReturn('m');
    $word->length()->willReturn(6);
  }

  function it_is_able_to_find_a_word_in_a_row(Word $word)
  {
    $this->beConstructedWith([['a','x','m','o','n','k','e','y','e','s']]);
    $word->foundAt([0, 2], [0, 7])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_backwards_word_in_a_row(Word $word)
  {
    $this->beConstructedWith([['a','x','y','e','k','n','o','m','e','s']]);
    $word->foundAt([0, 7], [0, 2])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_vertical_word(Word $word)
  {
    $this->beConstructedWith([['a'],['m'],['o'],['n'],['k'],['e'],['y'],['z']]);
    $word->foundAt([1, 0], [6, 0])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_backwards_vertical_word(Word $word)
  {
    $this->beConstructedWith([['a'],['y'],['e'],['k'],['n'],['o'],['m'],['z']]);
    $word->foundAt([6, 0], [1, 0])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_up_left_diagonal_word(Word $word)
  {
    $this->beConstructedWith(
        [['y','a','s','k','e','y'],
        ['a','e','d','q','w','i'],
        ['o','i','k','k','w','e'],
        ['o','p','i','n','e','y'],
        ['p','w','q','o','o','z'],
        ['q','w','e','r','t','m']]);
    $word->foundAt([5, 5], [0, 0])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_up_right_diagonal_word(Word $word)
  {
    $this->beConstructedWith(
        [['z','a','s','k','e','y'],
        ['a','o','d','q','e','i'],
        ['o','i','n','k','w','e'],
        ['o','p','n','k','e','y'],
        ['p','o','q','o','e','z'],
        ['m','w','e','r','t','y']]);
    $word->foundAt([5, 0], [0, 5])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_down_left_diagonal_word(Word $word)
  {
    $this->beConstructedWith(
        [['z','a','s','k','e','m'],
        ['a','o','d','q','o','i'],
        ['o','i','n','n','w','e'],
        ['o','p','k','k','e','y'],
        ['p','e','q','o','e','z'],
        ['y','w','e','r','t','y']]);
    $word->foundAt([0, 5], [5, 0])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }

  function it_is_able_to_find_a_down_right_diagonal_word(Word $word)
  {
    $this->beConstructedWith(
        [['m','a','s','k','e','y'],
        ['a','o','d','q','w','i'],
        ['o','i','n','k','w','e'],
        ['o','p','i','k','e','y'],
        ['p','w','q','o','e','z'],
        ['q','w','e','r','t','y']]);
    $word->foundAt([0, 0], [5, 5])->shouldBeCalled();
    $this->find($word)->shouldReturn(true);
  }
}
