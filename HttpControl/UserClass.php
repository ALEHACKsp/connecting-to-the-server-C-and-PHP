<?php
include_once (dirname(__FILE__) . '/ServerInfo.php');

class User
{
  
		function CreateUser($UserKey, $HackDate)
		{
			if (($UserKey == "")||($HackDate == ""))
				Exit('PARAMETERS ERROR');
				
			$AlreadyActivated = mysql_query("SELECT user_key FROM ваша таблица WHERE user_key = '$UserKey'");
			$CountAlreadyActivated = mysql_num_rows($AlreadyActivated);
			
			if($CountAlreadyActivated > 0)
			{
				echo 'USERKEY ALREADY EXISTS' ;//уже существует
			} 
			else 
			{
				$Result = mysql_query("INSERT INTO ваша таблица(id,user_key, expire_date)VALUES (NULL, '$UserKey', '$HackDate')");
				if(!$Result)
				{
					echo 'ACTIVATION ERROR';//ошибка
				}
				else
				{
					echo 'ACTIVATED';//удачно
				}
			}
				
		}
		
		function UserLogin($UserKey)
		{
			if ($UserKey == "") 
			  Exit('PARAMETERS ERROR');
			$UserExists = mysql_query("SELECT user_key FROM ваша таблица WHERE user_key = '$UserKey'");
			$CountUserExists = mysql_num_rows($UserExists);
			if($CountUserExists > 0)
			{
				$UserData = mysql_fetch_assoc(mysql_query("SELECT * FROM ваша таблица WHERE user_key = '$UserKey'"));
				if (($UserData['user_key'] == $UserKey))
				{
					if (strtotime(CURRENT_DATE) < strtotime($UserData['expire_date']))
					{
						echo 'LICENSE GOOD';
						
					}
					else
					{
						echo 'LICENSE EXPIRED';
					}
				}
				else
				{
					echo 'FALSE USER DATA';
				}
			}
			else
			{
				echo 'USER NOT EXISTS';
			}
		}
        
        function UserDelete($UserKey)
         {
			if ($UserKey == "") 
			   Exit('PARAMETERS ERROR');
			$KeyExists = mysql_query("SELECT user_key FROM ваша таблица WHERE user_key = '$UserKey'");
			$CountKeyExists = mysql_num_rows($KeyExists);
			if($CountKeyExists > 0)
			{
				$Result = mysql_query("DELETE FROM ваша таблица WHERE user_key = '$UserKey'");
				if(!$Result)
				{
					echo 'KEY DELETE ERROR';//ошибка удаления
				}
				else 
				{
					echo 'DELETED';//удален
				}
			}
			else
			{
				echo 'KEY NOT EXISTS';//не существует
			}
		}
        function day($UserKey)
         {
			if ($UserKey == "")
				Exit('PARAMETERS ERROR 123');
                        $resultat = mysql_query("SELECT * FROM ваша таблица WHERE `user_key` = '$UserKey'");
		        $array = mysql_fetch_array($resultat);
		        if (!empty($array))
		        {
		        $endTime = $array['expire_date'];
                          Exit($endTime); }

}

}
$USER = new User;
?>