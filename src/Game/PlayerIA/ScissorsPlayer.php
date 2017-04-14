<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class RockPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 * Always replies scissors
 */
class ScissorsPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $choice = parent::scissorsChoice();

        return $choice;
    }
};
