<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class payment
{
	private $user_account_id;
	private $payment_id;
	private $product_id;
	private $quantity;
	private $total_price;
	private $order_number;
	private $invoice_number;
	private $payment_method;
	private $delivery_method;
	private $cart_weight;
	private $is_product_tangible;
	
//=================================================================================================
//GETTER METHODS
	public function getUserAccountID() { return $this->user_account_id; }
	
//=================================================================================================

	public function getPaymentID() { return $this->payment_id; }
	
//=================================================================================================

	public function getProductID() { return $this->product_id; }
	
//=================================================================================================

	public function getQuantity() { return $this->quantity; }
	
//=================================================================================================

	public function getTotalPrice() { return $this->total_price; }
	
//=================================================================================================

	public function getOrderNumber() { return $this->order_number; }
	
//=================================================================================================

	public function getInvoiceNumber() { return $this->invoice_number; }
	
//=================================================================================================

	public function getPaymentMethod() { return $this->payment_method; }
	
//=================================================================================================

	public function getDeliveryMethod() { return $this->delivery_method; }
	
//=================================================================================================

	public function getCartWeight() { return $this->cart_weight; }
	
//=================================================================================================

	public function getIsProductTangible() { return $this->is_product_tangible; }
	
//=================================================================================================
//SETTER METHODS
	public function setUserAccountID($user_account_id) { $this->user_account_id = $user_account_id; }
	
//=================================================================================================

	public function setPaymentID($payment_id) { $this->payment_id = $payment_id; }
	
//=================================================================================================

	public function setProductID($product_id) { $this->product_id = $product_id; }
	
//=================================================================================================

	public function setQuantity($quantity) { $this->quantity = $quantity; }
	
//=================================================================================================

	public function setTotalPrice($total_price) { $this->total_price = $total_price; }
	
//=================================================================================================

	public function setOrderNumber($order_number) { $this->order_number = $order_number; }
	
//=================================================================================================

	public function setInvoiceNumber($invoice_number) { $this->invoice_number = $invoice_number; }
	
//=================================================================================================

	public function setPaymentMethod($payment_method) { $this->payment_method = $payment_method; }
	
//=================================================================================================

	public function setDeliveryMethod($delivery_method) { $this->delivery_method = $delivery_method; }
	
//=================================================================================================

	public function setCartWeight($cart_weight) { $this->cart_weight = $cart_weight; }
	
//=================================================================================================

	public function setIsProductTangible($is_product_tangible) { $this->is_product_tangible = $is_product_tangible; }
	
//=================================================================================================

	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
						*
					FROM
						payments
					WHERE
						payment_id = :payment_id
					";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':payment_id', $this->payment_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			
			$result = $pdo_statement->fetch();

			$this->user_account_id		= $result['buyer_id'];
			$this->payment_id			= $result['payment_id'];
			$this->product_id			= $result['product_id'];
			$this->quantity				= $result['quantity'];
			$this->total_price			= $result['total_price'];
			$this->order_number			= $result['order_number'];;
			$this->invoice_number		= $result['invoice_number'];
			$this->payment_method		= $result['payment_method'];
			$this->delivery_method		= $result['delivery_method'];
			$this->cart_weight			= $result['cart_weight'];
			$this->is_product_tangible	= $result['is_product_tangible'];
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//=================================================================================================
	
	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$pdo_connection->beginTransaction();
		
			$sql = "INSERT INTO
						payments
						(
							`buyer_id`,
							`product_id`,
							`quantity`,
							`total_price`,
							`order_number`,
							`invoice_number`,
							`payment_method`,
							`delivery_method`,
							`cart_weight`,
							`is_product_tangible`
						)
					VALUES
						(
							:buyer_id,
							:product_id,
							:quantity,
							:total_price,
							:order_number,
							:invoice_number,
							:payment_method,
							:delivery_method,
							:cart_weight,
							:is_product_tangible
						)
					";
		
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':buyer_id', $this->user_account_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':product_id', $this->product_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':quantity', $this->quantity, PDO::PARAM_INT);
			$pdo_statement->bindParam(':total_price', $this->total_price, PDO::PARAM_STR);
			$pdo_statement->bindParam(':order_number', $this->order_number, PDO::PARAM_STR);
			$pdo_statement->bindParam(':invoice_number', $this->invoice_number, PDO::PARAM_STR);
			$pdo_statement->bindParam(':payment_method', $this->payment_method, PDO::PARAM_STR);
			$pdo_statement->bindParam(':delivery_method', $this->delivery_method, PDO::PARAM_STR);
			$pdo_statement->bindParam(':cart_weight', $this->cart_weight, PDO::PARAM_STR);
			$pdo_statement->bindParam(':is_product_tangible', $this->is_product_tangible, PDO::PARAM_STR);
			$pdo_statement->execute();
		
			$this->payment_id = $pdo_connection->lastInsertId();
			$pdo_connection->commit();
		
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
		
			$sql = "DELETE FROM
						payments
					WHERE
						payment_id = :payment_id
					";
		
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':payment_id', $this->payment_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		
			$this->payment_id = $pdo_connection->lastInsertId();
			$pdo_connection->commit();
		
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}
?>