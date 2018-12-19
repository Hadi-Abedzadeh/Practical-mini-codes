		// convert number 2 persian
    function Convertnumber2persian($srting) {
			$srting = str_replace('0', '۰', $srting);
			$srting = str_replace('1', '۱', $srting);
			$srting = str_replace('2', '۲', $srting);
			$srting = str_replace('3', '۳', $srting);
			$srting = str_replace('4', '۴', $srting);
			$srting = str_replace('5', '۵', $srting);
			$srting = str_replace('6', '۶', $srting);
			$srting = str_replace('7', '۷', $srting);
			$srting = str_replace('8', '۸', $srting);
			$srting = str_replace('9', '۹', $srting);
			return $srting;
		}
    
    // REGEX GET NUMBERS
    preg_replace("%[^0-9]%", "", $_REQUEST['number'])
