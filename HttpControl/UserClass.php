<?php
include_once (dirname(__FILE__) . '/ServerInfo.php');

class User
{
  
		function CreateUser($UserKey, $HackDate)
		{
			if (($UserKey == "")||($HackDate == ""))
				Exit('PARAMETERS ERROR');
				
			$AlreadyActivated = mysql_query("SELECT user_key FROM ���� ������� WHERE user_key = '$UserKey'");
			$CountAlreadyActivated = mysql_num_rows($AlreadyActivated);
			
			if($CountAlreadyActivated > 0)
			{
				echo 'USERKEY ALREADY EXISTS' ;//��� ����������
			} 
			else 
			{
				$Result = mysql_query("INSERT INTO ���� �������(id,user_key, expire_date)VALUES (NULL, '$UserKey', '$HackDate')");
				if(!$Result)
				{
					echo 'ACTIVATION ERROR';//������
				}
				else
				{
					echo 'ACTIVATED';//������
				}
			}
				
		}
		
		function UserLogin($UserKey)
		{
			if ($UserKey == "") 
			  Exit('PARAMETERS ERROR');
			$UserExists = mysql_query("SELECT user_key FROM ���� ������� WHERE user_key = '$UserKey'");
			$CountUserExists = mysql_num_rows($UserExists);
			if($CountUserExists > 0)
			{
				$UserData = mysql_fetch_assoc(mysql_query("SELECT * FROM ���� ������� WHERE user_key = '$UserKey'"));
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
			$KeyExists = mysql_query("SELECT user_key FROM ���� ������� WHERE user_key = '$UserKey'");
			$CountKeyExists = mysql_num_rows($KeyExists);
			if($CountKeyExists > 0)
			{
				$Result = mysql_query("DELETE FROM ���� ������� WHERE user_key = '$UserKey'");
				if(!$Result)
				{
					echo 'KEY DELETE ERROR';//������ ��������
				}
				else 
				{
					echo 'DELETED';//������
				}
			}
			else
			{
				echo 'KEY NOT EXISTS';//�� ����������
			}
		}
        function day($UserKey)
         {
			if ($UserKey == "")
				Exit('PARAMETERS ERROR 123');
                        $resultat = mysql_query("SELECT * FROM ���� ������� WHERE `user_key` = '$UserKey'");
		        $array = mysql_fetch_array($resultat);
		        if (!empty($array))
		        {
		        $endTime = $array['expire_date'];
                          Exit($endTime); }

}

}
$USER = new User;
?>