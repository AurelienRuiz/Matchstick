<?php

class allum1
{
    public $player;
    public $player1;
    public $player2;
    public $allumettes;
    public $init;

    public function __construct()
    {
        $this->init = readline("Jouer contre l'IA, oui[1]/non[2] ? ");
        if($this->init == "2")
        {
            $this->player1 = readline("Entrer nom du joueur 1 : ");
            $this->player2 = readline("Entrer nom du joueur 2 : ");
            $this->allumettes = readline("Combien voulez-vous d'allumetes ? ");
            $this->player = $this->player1;
            echo "\033[1;91m" . "Le jeu commence avec " . $this->allumettes . " allumettes !" . "\033[0m" . PHP_EOL;
            $this->play_vs_player();
        }
        else
        {
            $this->player1 = readline("Entrer nom du joueur : ");
            $this->allumettes = readline("Combien voulez-vous d'allumetes ? ");
            $this->player = $this->player1;
            echo "\033[1;91m" . "Le jeu commence avec " . $this->allumettes . " allumettes !" . "\033[0m" . PHP_EOL;
            $this->play_vs_ia();
        }

    }

    public function question()
    {
        $n = readline( $this->player ." retirez 1, 2 ou 3 allumettes ? ");
        if($n <= 3 && $n > 0)
        {
            return $n;
        }
        return $this->question();
    }

    public function play_vs_ia()
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

            $this->turn_vs_ia();
            $this->play_vs_ia(); 
    }

    public function play_vs_player()
    {
        for($i = 0; $i < $this->allumettes; $i++)
        {
            echo "\033[1;93m" . "|" . "\033[0m";
        }
        echo PHP_EOL;

        $n = $this->question();

        $this->allumettes = $this->allumettes - $n;

        if($this->allumettes <= 1)
        {
            echo  "\033[1;32m" . $this->player . " à gagné !!!" . "\033[0m";
            echo PHP_EOL;
            return 0;
        }

        $this->turn_vs_player();
        $this->play_vs_player(); 
    }

    public function turn_vs_ia()
    {
        if($this->player == $this->player1)
        {
            $this->player = "ia";
        }
        else
        {
            $this->player = $this->player1;
        }
    }

    public function turn_vs_player()
    {
        if($this->player == $this->player1)
        {
            $this->player = $this->player2;
        }
        else
        {
            $this->player = $this->player1;
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

?>