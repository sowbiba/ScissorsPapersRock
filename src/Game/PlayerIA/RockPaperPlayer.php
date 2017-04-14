<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class RockPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 * Always replies paper
 */
class RockPaperPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $key = mt_rand(0, 1);
        $choices = array($this->paperChoice(), $this->scissorsChoice());

        return $choices[$key];
    }
};
