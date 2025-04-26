<? 
	class connection	 {		
		var $link;		
		var $database;		
		function connection(){			
			$this->link = mysql_connect("localhost","bridgegroup","resume",true);				
			if (!$this->link){					
				$this->error();
			}			
			$this->database = mysql_select_db("bridgegroup",$this->link);			
		}		
	}
?>      
