<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class RockPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 * Always replies rock
 */
class RockPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $choice = parent::rockChoice();

        return $choice;
    }
};
