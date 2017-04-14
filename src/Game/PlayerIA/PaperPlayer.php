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
class PaperPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $choice = parent::paperChoice();

        return $choice;
    }
};
