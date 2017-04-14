<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author Ibrahima
 */
class AlphaPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    private $actualStrategy = 1;

    public function getChoice()
    {
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------

        $oppPreviousChoice = $this->result->getLastChoiceFor($this->opponentSide);
        $myPreviousChoice = $this->result->getLastChoiceFor($this->opponentSide);

        $myLastScore = $this->result->getLastScoreFor($this->mySide);
        $oppLastScore = $this->result->getLastScoreFor($this->opponentSide);

        $myScore = $this->result->getStatsFor($this->mySide)['score'];
        $oppScore = $this->result->getStatsFor($this->mySide)['score'];

        if (
            0 === $this->result->getLastChoiceFor($this->mySide) ||
            0 === $this->result->getLastChoiceFor($this->opponentSide)
        ) {
            return parent::paperChoice();
        }

        if ($myScore > $oppScore) { // Im winning \o/
            return $this->myStrategy();
        } else {  // Im losing /o\ pick my opponent strategy
            $oppName = $this->result->getStatsFor($this->opponentSide)['name'];
            if ('Alpha' === $oppName) {
                return $this->myStrategy();
            }
            $oppClass =  "Hackathon\\PlayerIA\\" . $oppName . 'Player';
            $a = new $oppClass();

            if (empty($a) || ! is_object($a)) {
                return parent::paperChoice();
            }

            try {
                switch ($a->getChoice()) {
                    case parent::rockChoice(): // he responded rock
                        return parent::paperChoice();
                        break;
                    case parent::paperChoice():
                        return parent::scissorsChoice();
                        break;
                    case parent::scissorsChoice():
                        return parent::rockChoice();
                        break;
                }
            } catch(\Exception $e) {
                return parent::paperChoice();
            }

            return $a->getChoice();
        }

        return parent::paperChoice();
    }

    private function myStrategy()
    {
        $myScore = $this->result->getStatsFor($this->mySide)['score'];
        $oppScore = $this->result->getStatsFor($this->mySide)['score'];

        if ($myScore >= $oppScore) { // Im winning \o/
            if (1 === $this->actualStrategy) {
                return $this->firstStrategy();
            } else {
                return $this->secondStrategy();
            }
        } else {  // Im losing /o\ change
            if (1 === $this->actualStrategy) {
                return $this->secondStrategy();
            } else {
                return $this->firstStrategy();
            }
        }
    }

    private function firstStrategy()
    {
        $oppPreviousChoice = $this->result->getLastChoiceFor($this->opponentSide);
        $myPreviousChoice = $this->result->getLastChoiceFor($this->opponentSide);

        $myLastScore = $this->result->getLastScoreFor($this->mySide);
        $oppLastScore = $this->result->getLastScoreFor($this->opponentSide);

        if (0 === $oppPreviousChoice) {
            return parent::paperChoice();
        }

        /**
         * Opponent will respond same if wons
         */
        if (5 === $myLastScore) { //opp wons
            switch ($myPreviousChoice) {
                case parent::rockChoice(): // he responded rock
                    return parent::paperChoice();
                    break;
                case parent::paperChoice():
                    return parent::scissorsChoice();
                    break;
                case parent::scissorsChoice():
                    return parent::rockChoice();
                    break;
            }
        } else { //opp wons
            return $oppPreviousChoice;
        }

        return parent::paperChoice();
    }

    private function secondStrategy()
    {
        $oppPreviousChoice = $this->result->getLastChoiceFor($this->opponentSide);
        $myPreviousChoice = $this->result->getLastChoiceFor($this->opponentSide);

        $myLastScore = $this->result->getLastScoreFor($this->mySide);
        $oppLastScore = $this->result->getLastScoreFor($this->opponentSide);

        if (0 === $oppPreviousChoice) {
            return parent::paperChoice();
        }

        /**
         * Opponent will respond same if wons
         */
        if (5 === $oppLastScore) { //opp wons
            switch ($oppPreviousChoice) {
                case parent::rockChoice(): // he responded rock
                    return parent::paperChoice();
                    break;
                case parent::paperChoice():
                    return parent::scissorsChoice();
                    break;
                case parent::scissorsChoice():
                    return parent::rockChoice();
                    break;
            }
        } else { //opp wons
            return $myPreviousChoice;
        }

        return parent::paperChoice();
    }
};
