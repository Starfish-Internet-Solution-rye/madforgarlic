<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'payment.php';

class payments
{
	private $array_of_payments;
	private $user_account_id;
	
//=================================================================================================
	
	public function getArrayOfPayments() { return $this->array_of_payments; }
	
//=================================================================================================
	
	public function setArrayOfPayments($array_of_payments) { $this->array_of_payments = $array_of_payments; }
	
//=================================================================================================
	
	public function setUserAccountID($user_account_id) { $this->user_account_id = $user_account_id; }
	
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
			//bindParam is used so that SQL inputs are escaped.
			//This is to prevent SQL injections!
			$pdo_statement->bindParam(':payment_id', $this->payment_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($results as $result)
			{
				$payment = new payment();
				
				$payment->setUserAccountID($result['user_account_id']);
				$payment->setPaymentID($result['payment_id']);
				$payment->setProductID($result['product_id']);
				$payment->setQuantity($result['quantity']);
				$payment->setTotalPrice($result['total_price']);
				$payment->setOrderNumber($result['order_number']);
				$payment->setInvoiceNumber($result['invoice_number']);
				$payment->setPaymentMethod($result['payment_method']);
				$payment->setDeliveryMethod($result['delivery_method']);
				$payment->setCartWeight($result['cart_weight']);
				$payment->setIsProductTangible($result['is_product_tangible']);
				
				$this->array_of_payments[] = $payment;
			}
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}
?>