<?php

class allum1
{
    public $player = "Player 1";
    public $allumettes;

    public function __construct()
    {
        $this->allumettes = 11;
    }

    public function question()
    {
        echo "Your turn : " . PHP_EOL;
        $n = readline("Matches : ");
        if(!ctype_digit($n))
        {
            echo "Error: invalid input (positive number expected)" . PHP_EOL;
        }
        elseif($n == 0)
        {
            echo "Error : you have to remove at least one match" . PHP_EOL;
        }
        elseif ($n > 3)
        {
            echo "Error : not enough matches" . PHP_EOL;
        }
        elseif($n <= 3 && $n > 0)
        {
            echo "Player removed " . $n . " match(es)" . PHP_EOL;
            return $n;
        }
        return $this->question();
    }

    public function play()
    {
        for($i = 0; $i < $this->allumettes; $i++)
        {
            echo "|";
        }
        echo PHP_EOL;

        if($this->player == "AI")
        {
            $n = $this->ia();
            if($n > 3 || $n <= 0)
            {
                $n = 1;
            }
            echo "AI's turn ..." . PHP_EOL;
            echo "AI removed " . $n . " match(es)";
            echo PHP_EOL;
        }
        else
        {
            $n = $this->question();
        }

        $this->allumettes = $this->allumettes - $n;

            if($this->allumettes <= 1)
            {
                if($this->player == "AI")
                {
                    echo "You lost to bad..." . PHP_EOL;
                    return 0;
                }
                else
                {
                    echo "You win !" . PHP_EOL;
                    return 0;
                }
            }
            $this->turn();
            $this->play(); 
    }

    public function turn()
    {
        if($this->player == "Player 1")
        {
            $this->player = "AI";
        }
        else
        {
            $this->player = "Player 1";
        }
    }

    public function ia()
    {
        return $this->allumettes - $this->get_GP();
    }

    public function get_GP()
    {
        $gp = NULL;

        for($i = 0; $i < $this->allumettes; $i++)
        {
            $p = 1 + ((3+1) * $i);

            if($p >= $this->allumettes)
            {
                return $gp;
            }
            else
            {
                $gp = $p;
            }
        }
    }
}

$alum = new allum1();
$alum->play();

?>