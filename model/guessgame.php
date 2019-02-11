<?php

class GuessGame {
	public $secretNumber = 5;
	public $history = array();
	public $state = "";

	public function __construct($hard) {
		$this->hard = $hard;
		if ($this->hard == 0) {
			$this->secretNumber = rand(1,10);
		} else if ($this->hard == 1) {
			$this->secretNumber = rand(1,100);
		} else if ($this->hard == 2) {
			$this->secretNumber = rand(1,1000);
		}
        
		$this->msg = "";
		$this->moves = 1000;
		
    }
	
	// guess a number
	public function makeGuess($guess){
		$this->moves--;
		if($guess>$this->secretNumber){
			$this->state="too high";
		} else if($guess<$this->secretNumber){
			$this->state="too low";
		} else {
			$this->state="correct";
			$this->msg = "YOU WIN!";
		}
		$this->history[] = "Guess #$this->moves was $guess and was $this->state.";
	}

	public function getState(){
		return $this->state;
	}
	
	// restart the game
	public function resetGame() {
		$this->secretNumber = rand(1,100);
		$this->msg = "";
		$this->moves = 1000;
		
		$this->history = array();
		$this->state = "";
		
	}
}
?>
