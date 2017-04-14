<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 * Always replies the last opponent choice expect the first round were we choose friend
 */
class MoodyPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $key = mt_rand(0, 2);
        $choices = array($this->rockChoice(), $this->paperChoice(), $this->scissorsChoice());
        $choice = $choices[$key];

        return $choice;
    }
};
