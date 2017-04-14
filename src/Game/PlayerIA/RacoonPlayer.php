<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class RacoonPlayer
 * @package Hackathon\PlayerIA
 * @author Irwin
 *
 */
class RacoonPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        return parent::rockChoice();
    }
};
