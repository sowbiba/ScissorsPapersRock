<?php
namespace Hackathon\Tests;

use Hackathon\Game\Result;
use Hackathon\Game\Main;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider classNameProvider
     */
    public function testPlop($contender)
    {
        $className = "Hackathon\\PlayerIA\\" . $contender . 'Player';
        $a = new $className;
        $this->assertEquals($contender, $a->getName());
    }

    /**
     * @dataProvider classNameProvider
     */
    public function testFirstChoice($contender)
    {
        $className = "Hackathon\\PlayerIA\\" . $contender . 'Player';
        $a = new $className;
        $a->setSide('a');
        $result = new Result($a->getName(), $a->getName());
        $a->updateResult($result);
        $choice = $a->getChoice();
        $isItFoeOrFriend = (($choice === 'rock') || ($choice === 'paper') || ($choice === 'scissors'));
        $this->assertTrue($isItFoeOrFriend);
    }

    /**
     * @dataProvider classNameProvider
     */
    public function testChoices($contender)
    {
        $className = "Hackathon\\PlayerIA\\" . $contender . 'Player';
        $a = new $className;

        $this->assertEquals($a->rockChoice(), 'rock');
        $this->assertEquals($a->paperChoice(), 'paper');
        $this->assertEquals($a->scissorsChoice(), 'scissors');
    }

    public function classNameProvider()
    {
        $main = new Main();
        $mainContenders = $main->getContenders();
        $contenders = array($mainContenders);

        return $contenders;
    }

    /** Je vérifie que vous ne modifiez pas les fichiers BANDE de COQUINOUX */
    public function testFiles()
    {
        /*$gameFileName = __DIR__.'/../Game.php';
        $this->assertEquals(md5_file($gameFileName), '8fc79c64a69699c120997c15f8b8984e');*/
    }
}
