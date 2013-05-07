<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'product.php';
require_once 'Project/Code/System/Pagination/pagination.php';

class products
{
	private $array_of_products = array();
	private $product_id;
	private $category_id;
	private $subcategory_id;
	
	private $offset_value;
	private $posts_per_page;
	private $pages;
	
//-------------------------------------------------------------------------------------------------	

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		
		else return NULL;
	}
	
//-------------------------------------------------------------------------------------------------	

	public function __set($field, $value) { if(property_exists($this, $field)) $this->{$field} = $value; }
	
//-------------------------------------------------------------------------------------------------

	public function select($has_pagination = FALSE)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						*
					FROM
						products p
					INNER JOIN
						routes r
					ON
						p.route_id = r.route_id";
			
			if($has_pagination == TRUE)
			{
				$pagination = new pagination($pdo_statement, $this->posts_per_page, $this->current_page);
				$this->pages = $pagination->getNumberOfPages();
					
				$sql .= $pagination->getLimitClause();
			
				$pdo_statement = $pdo_connection->prepare($sql);
			}
			
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll();
			
			$this->saveResults($results);
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function selectByCategoryID($has_pagination = FALSE)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						*
					FROM
						products p
					LEFT JOIN
						routes r
					ON
						p.route_id = r.route_id
					WHERE
						category_id = :category_id";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
			
			if($has_pagination == TRUE)
			{
				$pagination = new pagination($pdo_statement, $this->posts_per_page, $this->current_page);
				$this->pages = $pagination->getNumberOfPages();
					
				$sql .= $pagination->getLimitClause();
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':category_id', $this->category_id, PDO::PARAM_INT);
			}
			
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll();
			
			$this->saveResults($results);
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	
//-------------------------------------------------------------------------------------------------

	public function selectBySubCategoryID($has_pagination = FALSE)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "SELECT
						*
					FROM
						products p
					LEFT JOIN
						routes r
					ON
						p.route_id = r.route_id
					WHERE
						subcategory_id = :subcategory_id";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':subcategory_id', $this->subcategory_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			
			if($has_pagination == TRUE)
			{
				$pagination = new pagination($pdo_statement, $this->posts_per_page, $this->current_page);
				$this->pages = $pagination->getNumberOfPages();
					
				$sql .= $pagination->getLimitClause();
			
				$pdo_statement = $pdo_connection->prepare($sql);
				$pdo_statement->bindParam(':subcategory_id', $this->subcategory_id, PDO::PARAM_INT);
			}
			
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll();
			
			$this->saveResults($results);
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------
// used in all methods in getting results from database(SELECT STATEMENTS)
// should pass all values into $array_of_products.
	
	private function saveResults($results)
	{
		foreach($results as $result)
		{
			$product = new product();
		
			$product->__set('product_id', $result['product_id']);
			$product->__set('product_title', $result['product_title']);
			$product->__set('description', $result['description']);
			$product->__set('price', $result['product_price']);
			$product->__set('category_id', $result['category_id']);
			$product->__set('subcategory_id', $result['subcategory_id']);
			$product->__set('permalink', $result['permalink']);
			
			$this->array_of_products[] = $product;
		}
	}
}
?>