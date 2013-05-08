<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class subscriber
{
	private $subscriber_id;
	private $email;
	
	public function setSubscriberID($subscriber_id)
	{
		$this->subscriber_id = $subscriber_id;
	}
	
	public function getSubscriberID()
	{
		if($this->subscriber_id != null)
			return $this->subscriber_id;
		else
			return false;
	}
	
//-----------------------------------------------------------------------------------------------
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	public function getEmail()
	{
		if($this->email != null)
			return $this->email;
		else
			return false;
	}
	
//-----------------------------------------------------------------------------------------------
	
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
							WHERE
								subscriber_id = :subscriber_id
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":subscriber_id", $this->subscriber_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			$results = $pdo_statement->fetch(PDO::FETCH_ASSOC);
			
			$this->subscriber_id = $results['subscriber_id'];
			$this->email		 = $results['email'];
				
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
	
//-----------------------------------------------------------------------------------------------
	

	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "
						INSERT INTO
							`subscriber`
							(
								`email`
							)
							VALUES
							(
								:email
							)
					";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':email', $this->email, PDO::PARAM_STR);
				
			$pdo_statement->execute();
	
			$this->last_insert_id = $pdo_connection->lastInsertId();
	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-----------------------------------------------------------------------------------------------

	public function delete()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "										
					DELETE FROM
							subscriber
						WHERE
							subscriber_id = :subscriber_id
								";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':subscriber_id', $this->subscriber_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-----------------------------------------------------------------------------------------------	
	
	public function deleteWhereIn($subscriber_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
		
			$sql = "
					DELETE FROM
							subscriber
					WHERE
							subscriber_id IN ($subscriber_id)
					";
		
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':subscriber_id', $this->subscriber_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	public function selectByColumn($column, $value)
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
									$column = $value
						";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			$results = $pdo_statement->fetch(PDO::FETCH_ASSOC);
				
			$this->subscriber_id = $results['subscriber_id'];
			$this->email		 = $results['email'];
	
		}
		catch(PDOException $e)
		{
			print "<pre>".$e->getMessage()."</pre>";
		}
	}
	
	
}

?>