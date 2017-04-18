<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;

/**
 * Class AlphaPlayer
 * @package Hackathon\PlayerIA
 * @author Ibrahima
 */
class AlphaPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

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
        $myPreviousChoice = $this->result->getLastChoiceFor($this->mySide);

        $myScore = $this->result->getStatsFor($this->mySide)['score'];
        $oppScore = $this->result->getStatsFor($this->mySide)['score'];

        if (0 === $myPreviousChoice || 0 === $oppPreviousChoice) {
            return parent::paperChoice();
        }

        if ($myScore > $oppScore) { // Im winning \o/
            return $this->myStrategy();
        } else {  // Im losing /o\ pick my opponent strategy
            $a = $this->getOpponent($this->result->getStatsFor($this->opponentSide)['name']);

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
    }

    private function myStrategy()
    { // I'm winning the game
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
        if ($myLastScore > 0) { //I won or draw last turn
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
        } else { //I lost last turn, I respond the same as opponent last choice
            return $oppPreviousChoice;
        }

        return parent::paperChoice();
    }

    private function getOpponent($oppName)
    {
        if ('Alpha' === $oppName) {
            return $this;
        }

        $oppClass =  "Hackathon\\PlayerIA\\" . $oppName . 'Player';
        $opponent = new $oppClass();

        $opponent->setSide('b');

        $result = new Result($this->getName(), $opponent->getName());
        $this->updateResult($result);
        $opponent->updateResult($result);

        return $opponent;
    }
};
