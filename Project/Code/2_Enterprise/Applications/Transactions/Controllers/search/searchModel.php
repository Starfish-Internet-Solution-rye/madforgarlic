<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class searchModel
{
	private $array_of_results = array();
	private $payment_id;
	private $product_title;
	private $description;
	private $size;
	private $quantity;
	private $total_price;
	private $name;
	private $transaction_date;
	
//=================================================================================================
	
	public function getArrayOfResults() { return $this->array_of_results; }
	
//=================================================================================================
	
	public function getPaymentID() { return $this->payment_id; }
	
//=================================================================================================
	
	public function getProductTitle() { return $this->product_title; }
	
//=================================================================================================
	
	public function getDescription() { return $this->description; }
	
//=================================================================================================
	
	public function getSize() { return $this->size; }
	
//=================================================================================================
	
	public function getQuantity() { return $this->quantity; }
	
//=================================================================================================
	
	public function getTotalPrice() { return $this->total_price; }
	
//=================================================================================================
	
	public function getName() { return $this->name; }
	
//=================================================================================================
	
	public function getTransactionDate() { return $this->transaction_date; }
	
//=================================================================================================
//SETTER	
	public function setArrayOfResults($array_of_results) { $this->array_of_results = $array_of_results; }
	
//=================================================================================================
	
	public function setPaymentID($payment_id) { $this->payment_id = $payment_id; }
	
//=================================================================================================
	
	public function setProductTitle($product_title) { $this->product_title = $product_title; }
	
//=================================================================================================
	
	public function setDescription($description) { $this->description = $description; }
	
//=================================================================================================
	
	public function setSize($size) { $this->size = $size; }
	
//=================================================================================================
	
	public function setQuantity($quantity) { $this->quantity = $quantity; }
	
//=================================================================================================
	
	public function setTotalPrice($total_price) { $this->total_price = $total_price; }
	
//=================================================================================================
	
	public function setName($name) { $this->name = $name; }
	
//=================================================================================================
	
	public function setTransactionDate($transaction_date) { $this->transaction_date = $transaction_date; }
	
//=================================================================================================
	
	public function selectSearch($product_title, $description, $category_id, $subcategory_id, $date_from, $date_to)
	{
		$search_criteria = 0;
		
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						p.payment_id,
						pr.product_title,
						pr.description,
						c.size,
						c.quantity,
						p.total_price,
						last_login,
						transaction_date
					FROM
						payments p
					INNER JOIN
						products pr
					ON
						p.product_id = pr.product_id
					INNER JOIN
						cart_items c
					ON
						p.payment_id = c.payment_id
					INNER JOIN
						user_accounts u
					ON
						u.user_account_id = p.buyer_id";
					
			$sql_where = '';	
				
			if($product_title != '')
			{
				$sql_where .= " lower(product_title) LIKE lower(:product_title)";
				$search_criteria++;
			}
			
			if($description != '')
			{
				if($search_criteria > 0) $sql .= " AND";
				
				$sql_where .= " lower(description) LIKE lower(:description)";
				$search_criteria++;
			}
			
			if($category_id != '')
			{
				if($search_criteria > 0) $sql .= " AND";
				
				$sql_where .= " category_id = :category_id";
				$search_criteria++;
			}
			
			if($subcategory_id != '')
			{
				if($search_criteria > 0) $sql .= " AND";
				
				$sql_where .= " subcategory_id = :subcategory_id";
				$search_criteria++;
			}
			
			if($date_from != '')
			{
				if($search_criteria > 0) $sql .= " AND";
				
				$sql_where .= " transaction_date >= :date_from";
				$search_criteria++;
			}
			
			if($date_to != '')
			{
				if($search_criteria > 0) $sql .= " AND";
				
				$sql_where .= " transaction_date <= :date_to";
				$search_criteria++;
			}
			
			if($search_criteria > 0)
				$sql .= " WHERE".$sql_where;
			
			$pdo_statement = $pdo_connection->prepare($sql);
			//bindParam is used so that SQL inputs are escaped.
			//This is to prevent SQL injections!
			if($product_title != '')
				$pdo_statement->bindParam(':product_title', $product_title, PDO::PARAM_STR);
			
			if($description != '')
				$pdo_statement->bindParam(':description', $description, PDO::PARAM_STR);
			
			if($category_id != '')
				$pdo_statement->bindParam(':category_id', $category_id, PDO::PARAM_INT);
			
			if($subcategory_id != '')
				$pdo_statement->bindParam(':subcategory_id', $subcategory_id, PDO::PARAM_INT);
			
			if($date_from != '')
				$pdo_statement->bindParam(':date_from', $date_from, PDO::PARAM_STR);
			
			if($date_to != '')
				$pdo_statement->bindParam(':date_to', $date_to, PDO::PARAM_STR);
			
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			
			$array_of_results= array();
			
			foreach ($results as $result)
			{
				$model = new searchModel();
				
				$model->setPaymentID($result['payment_id']);
				$model->setProductTitle($result['product_title']);
				$model->setDescription($result['description']);
				$model->setSize($result['size']);
				$model->setQuantity($result['quantity']);
				$model->setTotalPrice($result['total_price']);
				$model->setName($result['last_login']);
				$model->setTransactionDate($result['transaction_date']);

				$this->array_of_results[] = $model;
			}
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}
?>