<?php

class TFEGame {

	public function __construct() {
        
		$this->hard = 0;

		$this->board = array (
					   array(0,0,0,0),
					   array(0,0,0,0),
					   array(0,0,0,0),
					   array(0,0,0,0)
					  );
		$this->solved = $this->board;	
		$this->free_x = 2;
		$this->free_y = 2;
		
		
		$this->moves = 0;
		$this->msg = "";
		
		$this->addTile();
		
    }
	
	// add new tile to board
	public function addTile() {
		while (True) {
			$x = rand(0,3);
			$y = rand(0,3);
			
			if ($this->board[$x][$y] == 0) {
				$this->board[$x][$y] = 2;
				break;
			}
		}
		
	}
	
	// check if won or loss
	public function checkState() {
		for ($x = 0; $x <= 3; $x++) {
			for ($y = 0; $y <= 3; $y++) {
				if ($this->board[$y][$x] == 0) {
					return False;
				}
				if ($this->board[$y][$x] == 2048) {
					$this->msg = "YOU WIN!";
					return True;
				}
			}
		}
		$this->msg = "YOU LOSE!"; // NOT FULLY IMPLEMENTED - SHOULD LOSE ONCE NO MORE SLIDES ARE AVAILABLE
		return True;
		
	}
	
	// slide all tiles one direction
	public function slideTiles($dir) {
		$moved = false;
		if (!$this->checkState()) {
			switch($dir){
				case "up":
					
					for ($x = 0; $x <= 3; $x++) {
						for ($y = 0; $y <= 3; $y++) {
							if ($y != 0) {
								if ($this->board[$y][$x] != 0 && ($this->board[$y-1][$x] == 0 || $this->board[$y-1][$x] == $this->board[$y][$x])) {
									$old_val = $this->board[$y-1][$x];
									$this->board[$y-1][$x] += $this->board[$y][$x];
									
									if ($old_val != $this->board[$y-1][$x] && $this->board[$y-1][$x] != $this->board[$y][$x]) {
										$this->moves += $this->board[$y-1][$x];
									}
									
									$this->board[$y][$x] = 0;
									$moved = true;
								} 
								
							}
						}
					}
					break;
				case "down":
					for ($x = 3; $x >= 0; $x--) {
						for ($y = 3; $y >= 0; $y--) {
							if ($y != 3) {
								if ($this->board[$y][$x] != 0 && ($this->board[$y+1][$x] == 0 || $this->board[$y+1][$x] == $this->board[$y][$x])) {
									$old_val = $this->board[$y+1][$x];
									$this->board[$y+1][$x] += $this->board[$y][$x];
									
									if ($old_val != $this->board[$y+1][$x] && $this->board[$y+1][$x] != $this->board[$y][$x]) {
										$this->moves += $this->board[$y+1][$x];
									}
									$this->board[$y][$x] = 0;
									$moved = true;								
								}
							}
						}
					}
					break;
				case "left":
					for ($x = 0; $x <= 3; $x++) {
						for ($y = 0; $y <= 3; $y++) {
							if ($x != 0) {
								if ($this->board[$y][$x] != 0 && ($this->board[$y][$x-1] == 0 || $this->board[$y][$x-1] == $this->board[$y][$x])) {
									$old_val = $this->board[$y][$x-1]; 
									$this->board[$y][$x-1] += $this->board[$y][$x];
									
									if ($old_val != $this->board[$y][$x-1] && $this->board[$y][$x-1] != $this->board[$y][$x]) {
										$this->moves += $this->board[$y][$x-1];
									}
									
									$this->board[$y][$x] = 0;
									$moved = true;									
								}
							}
						}
					}
					break;
				case "right":
					for ($x = 3; $x >= 0; $x--) {
						for ($y = 3; $y >= 0; $y--) {
							if ($x != 3) {
								if ($this->board[$y][$x] != 0 && ($this->board[$y][$x+1] == 0 || $this->board[$y][$x+1] == $this->board[$y][$x])) {
									$old_val = $this->board[$y][$x+1]; 
									$this->board[$y][$x+1] += $this->board[$y][$x];
									
									if ($old_val != $this->board[$y][$x+1] && $this->board[$y][$x+1] != $this->board[$y][$x]) {
										$this->moves += $this->board[$y][$x+1];
									}
									
									$this->board[$y][$x] = 0;
									$moved = true;									
								}
							}
						}
					}
					break;
			}

			if (!$moved) {
				return true;
			} else {
				$done = $this->slideTiles($dir);
			}
			
			if ($done) {
				$this->addTile();
			}
		} 
	}
}
?>
