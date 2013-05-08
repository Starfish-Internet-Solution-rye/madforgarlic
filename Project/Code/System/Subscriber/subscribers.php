<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'subscriber.php';

class subscribers
{
	private $array_of_subscriber;
	
	public function getArrayOfSubscriber()
	{
		if(!is_null($this->array_of_subscriber))
			return $this->array_of_subscriber;
		else
			return false;
	}
	
	//--------------------------------------------------------------------------------------------
	
	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = " 
					SELECT
						*
					FROM
						subscriber
			";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($results as $result)
			{
				$subscriber = new subscriber();
				
				$subscriber->setSubscriberID($result['subscriber_id']);
				$subscriber->setEmail($result['email']);
				
				$this->array_of_subscriber[] = $subscriber;
			}
			
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
//--------------------------------------------------------------------------------------------
	
	public function selectByFilter($email)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "
						SELECT
							*
						FROM
							subscriber
						WHERE
							email LIKE '%$email%'
				";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			//$pdo_statement->bindParam(":email", $email, PDO::PARAM_STR);
			$pdo_statement->execute();
			$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
				
			foreach($results as $result)
			{
				$subscriber = new subscriber();
	
				$subscriber->setSubscriberID($result['subscriber_id']);
				$subscriber->setEmail($result['email']);
	
				$this->array_of_subscriber[] = $subscriber;
			}
				
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
}

?>