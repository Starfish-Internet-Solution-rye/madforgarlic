<?php 
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class userAccount
{
	private $user_account_id;
	private $username;
	private $password;
	private $user_role_id;
	
//=================================================================================================
//GETTER METHODS	
	public function getUserAccountID()
	{
		return $this->user_account_id;
	}
	
//=================================================================================================
	
	public function getUsername()
	{
		return $this->username;
	}
	
//=================================================================================================
	
	public function getPassword()
	{
		return $this->password;
	}
	
//=================================================================================================
	
	public function getUserRoleID()
	{
		return $this->user_role_id;
	}
	
//=================================================================================================
//SETTER METHODS	
	public function setUserAccountID($user_account_id)
	{
		$this->user_account_id = $user_account_id;
	}
	
//=================================================================================================
	
	public function setUsername($username)
	{
		$this->username = $username;
	}
	
//=================================================================================================
	
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
//=================================================================================================
	
	public function setUserRoleID($user_role_id)
	{
		$this->user_role_id = $user_role_id;
	}
	
//================================================================================================//

	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "
				
				SELECT
					*
				FROM
					user_accounts
				WHERE
					user_account_id = :user_account_id
					";
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
			
			$this->username			=	$result['username'];
			$this->password			=	$result['password'];
			$this->user_role_id		=	$result['user_role_id'];
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
		
	}
	
//================================================================================================//

	public function select_login()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						user_account_id, user_role_id
					FROM
						user_accounts
					WHERE
						username = :username
					AND
						password = :password
					";
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
			$pdo_statement->bindParam(':password', $this->password, PDO::PARAM_STR);
			$pdo_statement->execute();
			$result = $pdo_statement->fetch();
			
			$this->user_account_id	= $result['user_account_id'];
			$this->user_role_id		= $result['user_role'];
			
			if($result !== FALSE)
				return TRUE;
			
			else
				return FALSE;
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
		
		return FALSE;
	}
	
//================================================================================================//	

	public function insert()
	{
		try{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
			
			$sql = "
					INSERT INTO
						user_accounts
						(
							`username`,
							`password`,
						)
					VALUES
						(
							:username,
							:password,
						)
					";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
			$pdo_statement->bindParam(':password', $this->password, PDO::PARAM_STR);
			$pdo_statement->execute();
			
			$this->user_account_id = $pdo_connection->lastInsertId();
			$pdo_connection->commit();
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
/* //================================================================================================//

	public function update()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
			
			$sql = "UPDATE
						user_accounts
					SET
						photo_filename 	= :photo_filename,
						first_name		= :first_name,
						last_name		= :last_name,
						email			= :email,
						address			= :address,
						country			= :country,
						number			= :number
					WHERE
						user_account_id = :user_account_id
					";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			//bindParam is used so that SQL inputs are escaped.
			//This is to prevent SQL injections!
			$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':photo_filename', $this->photo_filename, PDO::PARAM_STR);
			$pdo_statement->bindParam(':first_name', $this->first_name, PDO::PARAM_STR);
			$pdo_statement->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
			$pdo_statement->bindParam(':email', $this->email, PDO::PARAM_STR);
			$pdo_statement->bindParam(':address', $this->address, PDO::PARAM_STR);
			$pdo_statement->bindParam(':country', $this->country, PDO::PARAM_STR);
			$pdo_statement->bindParam(':number', $this->number, PDO::PARAM_STR);
			$pdo_statement->execute();
				
			$pdo_connection->commit();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	} */
	
//================================================================================================//

	public function update_password()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
			
			$sql = "UPDATE
						user_accounts
					SET
						password	= :password
					WHERE
						user_account_id = :user_account_id
					";
				$pdo_statement = $pdo_connection->prepare($sql);
				//bindParam is used so that SQL inputs are escaped.
				//This is to prevent SQL injections!
				$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_STR);
				$pdo_statement->bindParam(':password', $this->password, PDO::PARAM_STR);
				$pdo_statement->execute();
				
				$pdo_connection->commit();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//================================================================================================//

	public function update_online_status($is_online)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
			
			$sql = "UPDATE
						user_accounts
					SET
						is_online	= :is_online,
						last_login	= CURRENT_TIMESTAMP
					WHERE
						user_account_id = :user_account_id
					";
				$pdo_statement = $pdo_connection->prepare($sql);
				//bindParam is used so that SQL inputs are escaped.
				//This is to prevent SQL injections!
				$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':is_online', $is_online, PDO::PARAM_INT);
				$pdo_statement->execute();
				
				$pdo_connection->commit();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//================================================================================================//

	public function update_photo($photo_filename)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
			
			$sql = "UPDATE
						user_accounts
					SET
						photo_filename	= :photo_filename
					WHERE
						user_account_id = :user_account_id
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				//bindParam is used so that SQL inputs are escaped.
				//This is to prevent SQL injections!
				$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':photo_filename', $photo_filename, PDO::PARAM_STR);
				$pdo_statement->execute();
				
				$pdo_connection->commit();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//================================================================================================//

	public function selectCountry($user_account_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
		
			$sql = "SELECT
						country
					FROM
						user_accounts
					WHERE
						user_account_id = :user_account_id
										";
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':user_account_id', $user_account_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		
			$result = $pdo_statement->fetch();
		
			return $result;
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//=================================================================================================
	public function select_email()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						username, password, email, first_name, last_name
					FROM
						user_accounts
					WHERE
						username = :username
					OR
						email = :email
					";
					
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
			$pdo_statement->bindParam(':email', $this->email, PDO::PARAM_STR);
			$pdo_statement->execute();
			$result = $pdo_statement->fetch();
				
			$this->username	= $result['username'];
			$this->password	= $result['password'];
			$this->email	= $result['email'];
			$this->first_name	= $result['first_name'];
			$this->last_name	= $result['last_name'];
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	
	}
	
//=================================================================================================
	
	public function checkUsername($username)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "SELECT
						*
					FROM
						user_accounts
					WHERE
						username = :username
						";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':username', $username, PDO::PARAM_STR);
			$pdo_statement->execute();
			$result = $pdo_statement->fetch();
	
			return $result;	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	
	}
	
	//=================================================================================================
	
	public function checkEmail($email)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "SELECT
							*
						FROM
							user_accounts
						WHERE
							email = :email
							";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':email', $email, PDO::PARAM_STR);
			$pdo_statement->execute();
			$result = $pdo_statement->fetch();
	
			return $result;
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	
	}
	
	//=================================================================================================
	
	public function delete()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
				
			$sql = "
						DELETE FROM
							user_accounts
						WHERE
							user_account_id = :user_account_id
						";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_INT);
			$pdo_statement->execute();
	
			$pdo_connection->commit();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	//=================================================================================================
	
/*
 * 								ENTERPRISE FUNCTIONS
 */
	
	public function selectEmployers()
	{
		$pdo_connection = starfishDatabase::getConnection();
	
		$sql = "
				SELECT
					*
				FROM
					user_accounts
				WHERE
					`user_role_id` = 3
				";
	
		$pdo_statement = $pdo_connection->query($sql);
		$results = $pdo_statement->fetchAll();
	
		foreach($results as $result)
		{
			$employer = new employer();
			$employer->setBusinessType($business_type);
		}
	}
	
	public function updateUserAccount()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
				
			$sql = "UPDATE
							user_accounts
						SET
							username		= :username,
							photo_filename 	= :photo_filename,
							first_name		= :first_name,
							last_name		= :last_name,
							email			= :email,
							address			= :address,
							country			= :country,
							number			= :number
						WHERE
							user_account_id = :user_account_id
						";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			//bindParam is used so that SQL inputs are escaped.
			//This is to prevent SQL injections!
			$pdo_statement->bindParam(':user_account_id', $this->user_account_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':username', $this->username, PDO::PARAM_STR);
			$pdo_statement->bindParam(':photo_filename', $this->photo_filename, PDO::PARAM_STR);
			$pdo_statement->bindParam(':first_name', $this->first_name, PDO::PARAM_STR);
			$pdo_statement->bindParam(':last_name', $this->last_name, PDO::PARAM_STR);
			$pdo_statement->bindParam(':email', $this->email, PDO::PARAM_STR);
			$pdo_statement->bindParam(':address', $this->address, PDO::PARAM_STR);
			$pdo_statement->bindParam(':country', $this->country, PDO::PARAM_STR);
			$pdo_statement->bindParam(':number', $this->number, PDO::PARAM_STR);
			$pdo_statement->execute();
	
			$pdo_connection->commit();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
}

?>