<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';
require_once 'address.php';

class addresses
{
	private $array_of_addresses;
	private $user_account_id;
	
//=================================================================================================
//GETTER METHODS
	public function getArrayOfAddresses() { return $this->array_of_addresses; }
	
//=================================================================================================
//SETTER METHODS
	public function setUserAccountID($user_account_id) { $this->user_account_id = $user_account_id; }
	
//=================================================================================================	
	
	public function selectBilling() {}
	
//=================================================================================================	
	
	public function selectShipping() {}
	
	
	
	
}
?>