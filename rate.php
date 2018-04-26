<?php
	//rate.php
	
	$words = array(
		"full_words" => array()
	);
	
	function addWord( $word , $points , $opposite = null ) {

		$word     = strtolower( trim($word) ); //convert to lowercase
		$points   = (int) $points; //make sure it is integer..
		$opposite = strtolower( trim($opposite) ); //convert to lowercase
		
		if(strpos($word," ") > 0)
			$GLOBALS['words']['full_words'][$word] = array( "word" => $word , "pts" => $points , "opposite" => $opposite );
		else 
			$GLOBALS['words'][ $word ] = array( "word" => $word , "pts" => $points , "opposite" => $opposite );
		//add the word to $words array
	}
	
	function rateString( $str ) {
		
		
		$wList = preg_split("/[\s\.]/" , strtolower($str) );//wList = Word List (contains list of words in the str[all in lowercase])

		$words = $GLOBALS["words"];
		
		$rating = 0;
		
		$not = 0; //contains 1 if not is encountered
		foreach($wList as $i=>$word) {
			$word = trim($word);

			if( in_array($word,$words['not_array']) ) $not = 1;
			else if( isset($words[$word]) ) { 
				
				$w = $words[$word];
				if( $not ) {
					if( $w['opposite'] && isset( $words[ $w['opposite'] ] ) )
						$w = $words[ $w['opposite'] ]; //if not is encountered then change w to it's opposite word..(e.g good becomes bad)
					else $w = null;
				}
				
				if($w !== null && $w['pts'] != 0){ 
					$rating += $w['pts'];
				}
			}
			
			if(!in_array($word,$words['not_array']) && $not === 1) $not = 0; //set not to 0 if current word isn't 'not'
		}
		
		foreach($words['full_words'] as $word) {
			
			$m = preg_match_all("/" . escapeString($word['word']) . "/i",$str); //use preg_match_all to check if the word exists in string ($m = number of match found)
			
			if($m > 0) $rating += $m * $word['pts'];
		}
		
		
		return $rating;
	}
	
	$sql = mysql_query("SELECT `word`,`pts`,`opposite` FROM `dictionary`");
	while($data = mysql_fetch_object($sql))
		addWord( $data->word , $data->pts , $data->opposite );
	/*
	addWord( "good" , +1 , "bad" );
	addWord( "bad" , -1  , "good");
	addWord( "awesome" , +2 );
	addWord( "great"   , +2 , "bad" );
	addWord( "best" , +3 , "worst" );
	addWord( "worst" , -2 );
	*/
	
	$words['not_array'] = array("not","aint","ain't","isn't","isnt"); //array containing a list of words which serve as "not" 