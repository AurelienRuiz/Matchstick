<?php

class allum1
{
    public $player = "Joueur 1";
    public $allumettes;

    public function __construct()
    {
        // $this->allumettes = readline("Combien voulez-vous d'allumetes ? ");
        echo "\033[1;91m" . "Le jeu commence avec 11 allumettes !" . "\033[0m" . PHP_EOL;
        $this->allumettes = 11;
    }

    public function question()
    {
        $n = readline( "Au tour de " . $this->player ." Retirez 1, 2 ou 3 allumettes ? ");
        if($n <= 3 && $n > 0)
        {
            return $n;
        }
        return $this->question();
    }

    public function play()
    {
        for($i = 0; $i < $this->allumettes; $i++)
        {
            echo "\033[1;93m" . "|" . "\033[0m";
        }
        echo PHP_EOL;

        if($this->player == "ia")
        {
            $n = $this->ia();
            if($n > 3 || $n <= 0)
            {
                $n = 1;
            }
            echo "\033[1;34m" . "L'ia à enlevé " . $n . " allumettes" . "\033[0m";
            echo PHP_EOL;
        }
        else
        {
            $n = $this->question();
        }

        $this->allumettes = $this->allumettes - $n;

            if($this->allumettes <= 1)
            {
                echo  "\033[1;32m" . $this->player . " à gagné !!!" . "\033[0m";
                echo PHP_EOL;
                return 0;
            }

            $this->turn();
            $this->play(); 
    }

    public function turn()
    {
        if($this->player == "Joueur 1")
        {
            $this->player = "ia";
        }
        else
        {
            $this->player = "Joueur 1";
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