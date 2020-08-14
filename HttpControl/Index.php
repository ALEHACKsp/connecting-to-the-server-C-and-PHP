<?php
  include_once (dirname(__FILE__) . '/ServerInfo.php');
 include_once (dirname(__FILE__) . '/UserClass.php');
  
  if (isset($_POST['MESSAGE']))
		{
			$ClientMessage = $_POST['MESSAGE'];
			switch ($ClientMessage)
			{
				case 'GETDATE':
				    echo CURRENT_DATE;
				    break;
				 
				 case 'ADD':
				    $UserKey    = $_POST['USERKEY'];
					$HackDate   = $_POST['DATE'];
					$USER->CreateUser($UserKey, $HackDate);
				    break;  

                                 case 'DAYS':
				    $UserKey    = $_POST['USERKEY'];
					$USER->day($UserKey);
				    break;  

				case 'LOGIN':
				    $UserKey    = $_POST['USERKEY'];	
					$USER->UserLogin($UserKey);
				    break;     
				case 'DELETE':
				    $UserKey    = $_POST['USERKEY'];	
					$USER->UserDelete($UserKey);
				    break; 
				
			}	    	
		}
?>