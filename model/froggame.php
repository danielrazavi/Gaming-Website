<?php

class FrogGame {

	public function __construct($hard) {
		$this->hard = $hard;
		
		if ($this->hard == 0) {
			$this->frogs = array(1,1,1,0,2,2,2);
			$this->free = 3;
			$this->solved = array(2,2,2,0,1,1,1);
			$this->init = $this->frogs;			
		} else if ($this->hard == 1) {
			$this->frogs = array(1,1,1,1,0,2,2,2,2);
			$this->free = 4;
			$this->solved = array(2,2,2,2,0,1,1,1,1);
			$this->init = $this->frogs;		
		} else if ($this->hard == 2) {
			$this->frogs = array(1,1,1,1,1,0,2,2,2,2,2);
			$this->free = 5;
			$this->solved = array(2,2,2,2,2,0,1,1,1,1,1);	
			$this->init = $this->frogs;		
		}
		
		$this->moves = 1000;
		$this->msg = "";
		
    }
	
	// jump a frog
	public function jumpFrog($frog){
		if ($this->msg == "") {
			if (($this->frogs[$frog] == 1 && ($frog - $this->free == -1 || $frog - $this->free == -2)) ||
				($this->frogs[$frog] == 2 && ($frog - $this->free == 1 || $frog - $this->free == 2))) {
				$this->frogs[$this->free] = $this->frogs[$frog]; // set free to jumped frog
				
				// set new free spot
				$this->frogs[$frog] = 0; 
				$this->free = $frog; 
				
				$this->moves --;
				$this->checkSolve();
			}
		}
	}
	
	// check if won
	public function checkSolve() {
		
		if ($this->solved == $this->frogs) {
			$this->msg = "YOU WIN!";
		}
	}

	// set board to new state
	public function resetGame(){
		$this->frogs = $this->init;
		if ($this->hard == 0) {
			$this->free = 3;
		} else if ($this->hard == 1) {
			$this->free = 4;
		} else if ($this->hard == 2) {
			$this->free = 5;
		} 
		
		$this->moves = 1000;
		$this->msg = "";
	}
}
?>
