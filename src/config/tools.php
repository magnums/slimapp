<?php
class tools {

	public function checkapi($api) {
		
		$member = array("mango", "apple","aa00faf97d042c13a59da4d27eb32358");

		if (in_array($api, $member)) {
			return true;
		} else {
			return false;
		}

	}

}
