<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once FILE_ACCESS_CORE_CODE.'/Objects/ResultCleaner/resultCleaner.php';
require_once 'product_image.php';

class product
{
	private $product_id;
	private $route_id;
	private $product_title;
	private $description;
	private $date_created;
	private $date_updated;
	private $permalink;
	
	private $category_id;
	private $subcategory_id;
	
	private $image_path;
	private $tags;
	private $unix_timestamp;
//-------------------------------------------------------------------------------------------------	

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------

	public static function checkIfExists($product_type, $product_title)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						COUNT(product_title) as count
					FROM
						products a
					WHERE
						product_title = :product_title
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':product_title', $product_title, PDO::PARAM_STR);
				$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));
				
				return $result['count'];
	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function selectPrevOrNextPostPermalink($order)
	{
		$sign = '<';
		$orderby = 'DESC';
		
		if($order == 'next')
		{
			$sign = '>';
			$orderby = 'ASC';
		}
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						permalink
					FROM
						product a
					INNER JOIN
						routes r
					ON
						a.route_id = r.route_id	
					WHERE
						UNIX_TIMESTAMP(date_created) {$sign} {$this->unix_timestamp}
					AND
						product_id <> {$this->product_id}
					ORDER BY
						date_created {$orderby}
					LIMIT 0, 1
					";

				$pdo_statement = $pdo_connection->query($sql);
				//$pdo_statement->bindParam(':product_type', $this->product_type, PDO::PARAM_STR);
				//$pdo_statement->bindParam(':date_created', $this->date_created, PDO::PARAM_INT);
				//$pdo_statement->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
				//$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));

				return $result['permalink'];
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function select()
	{
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						product_id,
						a.route_id,
						product_title,
						description,
						permalink,
						DATE_FORMAT(date_created, '%M %e, %Y') as date_posted,
						UNIX_TIMESTAMP(date_created) as unix_posted
					FROM
						products a
					INNER JOIN
						routes r
					ON
						a.route_id = r.route_id	
					WHERE
					(
						product_id	= :product_id
					OR
						permalink	= :permalink
					)
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':permalink', $this->permalink, PDO::PARAM_STR);
				$pdo_statement->execute();
			
				$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));

				$this->product_id		= $result['product_id'];
				$this->route_id			= $result['route_id'];
				$this->product_title	= $result['product_title'];
				$this->description		= $result['description'];
				$this->date_created		= $result['date_posted'];
				$this->unix_timestamp	= $result['unix_posted'];
				$this->permalink		= $result['permalink'];

				$product_image = new product_image();
				
				$image = $product_image->selectThumbnailByType($result['product_id'], 'gallery');
				$this->image_path = $product_image->__get('full_path');
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------
	
	public function selectFirst()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
							product_id,
							a.route_id,
							product_title,
							description,
							permalink,
							DATE_FORMAT(date_created, '%M %e, %Y') as date_posted,
							UNIX_TIMESTAMP(date_created) as unix_posted
						FROM
							products a
						INNER JOIN
							routes r
						ON
							a.route_id = r.route_id	
						LIMIT 0,1";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
				
			$result = resultCleaner::cleanSingleResult($pdo_statement->fetch(PDO::FETCH_ASSOC));
	
			$this->product_id		= $result['product_id'];
			$this->route_id			= $result['route_id'];
			$this->product_title	= $result['product_title'];
			$this->description		= $result['description'];
			$this->date_created		= $result['date_posted'];
			$this->unix_timestamp	= $result['unix_posted'];
			$this->permalink		= $result['permalink'];

			$product_image = new product_image();
			
			$image = $product_image->selectThumbnailByType($result['product_id'], 'gallery');
			$this->image_path = $product_image->__get('full_path');
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}	
//-------------------------------------------------------------------------------------------------	
	
	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "
					INSERT INTO
						`products`
						(
							`route_id`,
							`category_id`,
							`subcategory_id`,
							`product_title`,
							`description`,
							`date_created`
						)
						VALUES
						(
							:route_id,
							:category_id,
							:subcategory_id,
							:product_title,
							:description,
							NOW()
						)
					";
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':route_id', $this->route_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':subcategory_id', $this->subcategory_id, PDO::PARAM_INT);
				$pdo_statement->bindParam(':product_title', $this->product_title, PDO::PARAM_STR);
				$pdo_statement->bindParam(':description', $this->description, PDO::PARAM_STR);
				$pdo_statement->execute();
				
				$this->product_id = $pdo_connection->lastInsertId();
				
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public function update()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "
					UPDATE
						products
					SET
						`product_title`	= :product_title,
						`description`	= :description,
						`date_updated`	= NOW()
					WHERE
						`product_id`	= :product_id
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':product_title', $this->product_title, PDO::PARAM_STR);
				$pdo_statement->bindParam(':description', $this->description, PDO::PARAM_STR);
				$pdo_statement->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
				$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public static function delete($product_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "DELETE FROM
						products
					WHERE
						product_id = :product_id
					";
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':product_id', $product_id, PDO::PARAM_INT);
				$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);	
		}
	}
}