<?php

class FifteenGame {

	public function __construct($hard) {
        $this->hard = $hard;
		
		if ($this->hard == 0) {
			$this->board = array (
						   array(1,2,3),
						   array(4,5,6),
						   array(7,8,0)
						  );
			$this->solved = $this->board;	
			$this->free_x = 2;
			$this->free_y = 2;
		} else if ($this->hard == 1) {
			$this->board = array (
						   array(1,2,3,4),
						   array(5,6,7,8),
						   array(9,10,11,12),
						   array(13,14,15,0)
						  );
			$this->solved = $this->board;	
			$this->free_x = 3;
			$this->free_y = 3;
		} else if ($this->hard == 2) {
			$this->board = array (
						   array(1,2,3,4,5),
						   array(6,7,8,9,10),
						   array(11,12,13,14,15),
						   array(16,17,18,19,20),
						   array(21,22,23,24,0)
						  );
			$this->solved = $this->board;	
			$this->free_x = 4;
			$this->free_y = 4;
		}
		
		$this->moves = 1000;
		$this->msg = "init";
		
    }
	
	// move a tile
	public function slideTile($tile_x,$tile_y,$scramble) {
        $x_diff = abs($tile_x - $this->free_x);
        $y_diff = abs($tile_y - $this->free_y);
		if ($this->msg == "") {
			if (($x_diff == 1 && $y_diff == 0) || ($x_diff == 0 && $y_diff == 1)) {
				$this->board[$this->free_x][$this->free_y] = $this->board[$tile_x][$tile_y]; // set free space to moved tile
				$this->board[$tile_x][$tile_y] = 0; // set clicked tile to 0
				
				// set new free spot
				$this->free_x = $tile_x;
				$this->free_y = $tile_y;
				
				if (!$scramble) {
					$this->moves --;
					$this->checkSolve();
				}
			}
		}
	}
	
	// shuffle the board
    public function scrambleGame() {
		//shuffle($this->board);
		$this->moves = 1000;
		$this->msg = "";
		$count = count($this->board[0])-1;
		for ($x = 0; $x <= 1000; $x++) {
			$int = rand(1,2);
			$move_x = $this->free_x;
			$move_y = $this->free_y;
			
			if ($int == 1) {
				$move_x += rand(-1,1);
				
				if ($move_x > $count) {
					$move_x = $count;
				}
				if ($move_x < 0) {
					$move_x = 0;
				}
			} else {
				$move_y += rand(-1,1);
				if ($move_y > $count) {
					$move_y = $count;
				}
				if ($move_y < 0) {
					$move_y = 0;
				}
			}
			
			// slide the tile
			$this->slideTile($move_x,$move_y,true);
		}
		
		// get free spot
		for ($x = 0; $x <= $count; $x++) {
			for ($y = 0; $y <= $count; $y++) {
				if ($this->board[$x][$y] == 0) {
					$this->free_x = $x;
					$this->free_y = $y;
				}
			}
		}
	}
	
	// check if won 
	public function checkSolve() {

		if ($this->solved == $this->board) {
			$this->msg = "YOU WIN!";
		}
	}

}
?>
