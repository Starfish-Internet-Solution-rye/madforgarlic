<?php
require_once FILE_ACCESS_CORE_CODE.'/Objects/Database/starfishDatabase.php';

class address
{
	private $street_address;
	private $city;
	private $state;
	private $zip;
	private $country;
	private $phone;
	private $phone_extension;
	private $address_type;
	
//=================================================================================================
//GETTER METHODS
	public function getStreetAddress() { return $this->street_address; }
	
//=================================================================================================	
	
	public function getCity() { return $this->city; }
	
//=================================================================================================	
	
	public function getState() { return $this->state; }
	
//=================================================================================================	
	
	public function getZip() { return $this->zip; }
	
//=================================================================================================	
	
	public function getCountry() { return $this->country; }
	
//=================================================================================================	
	
	public function getPhone() { return $this->phone; }
	
//=================================================================================================	
	
	public function getPhoneExtension() { return $this->phone_extension; }
	
//=================================================================================================	
	
	public function getAddressType() { return $this->address_type; }
	
//=================================================================================================
//SETTER METHODS
	public function setStreetAddress($street_address) { $this->street_address = $street_address; }
	
//=================================================================================================	
	
	public function setCity($city) { $this->city = $city; }
	
//=================================================================================================	
	
	public function setState($state) { $this->state = $state; }
	
//=================================================================================================	
	
	public function setZip($zip) { $this->zip = $zip; }
	
//=================================================================================================	
	
	public function setCountry($country) { $this->country = $country; }
	
//=================================================================================================	
	
	public function setPhone($phone) { $this->phone = $phone; }
	
//=================================================================================================	
	
	public function setPhoneExtension($phone_extension) { $this->phone_extension = $phone_extension; }
	
//=================================================================================================	
	
	public function setAddressType($address_type) { $this->address_type = $address_type; }
	
//=================================================================================================	
	
	public function select() {}
	
//=================================================================================================	
	
	public function insert() {}
	
//=================================================================================================	
	
	public function update() {}
	
//=================================================================================================	
	
	public function delete() {}
	
	
	
	
}
?>