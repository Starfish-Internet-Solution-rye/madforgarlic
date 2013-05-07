<?php
require_once 'Project/Code/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class showCartView extends applicationsSuperView
{
	
	
	public function displayShoppingCart($shoppingCart)
	{
		$content ='';
		if (empty($shoppingCart->items))
		{
			$content .= 'Your shopping cart is empty';
		}
		else
		{
			foreach ($shoppingCart->items as $item)
			{
				$content .='<div id="quantity_div_'.$item->product_id.'">';
	
				//$content .= $item->getObjectItem()->getProductTitle();
				$content .= 'quantity:';
				$content .= $this->getQuantityPulldown($item->product_id,$item->quantity);
				$content .= $this->getRemoveItemLink($item->product_id);
				$content .='</div>';
				$content .= '<br/>';
	
				//$this->setImageXML($item->getXmlObj()->image);
				//$this->setImageDirectory('Site/Code/Application/Sections/primary/'.$base.'/data/images');
				//$content .= $this->displayImage();
			}
			$content .= '---------------------------';
			$content .= '<br/>';
			$content .= 'TOTAL:';
			$content .= '<div id="totalPrice">';
			$content .= $shoppingCart->getTotalPrice();
			$content .= '</div>';
			$content .= '---------------------------';
			$content .= '<br/>';
			//we are now going to the shopping cart SECTION (under special grouping)
			$content .= '<a href="/checkout">CONFIRM ORDER</a>';
			$content .= '<br/>';
			$content .= '---------------------------';
				
		}
	
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	}
	
	//=================================================================================================
	private function getRemoveItemLink($product_id)
	{
		
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/showCart/remove_from_cart.js');
		response::getInstance()->addContentToStack('inpage_javascript_top',array('REMOVEFROM_SHOPPPING_CART_JAVASCRIPT_INPAGE'=>$content));
		
		
		$content ='<span  product_id = "'.$product_id.'" class="removeFromCart" style="cursor:pointer;">Remove From Cart</span>';
		return $content;
	}
	//=================================================================================================
	private function getQuantityPulldown($id,$quantity)
	{
		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/Commerce/Controllers/showCart/change_cart_quantity.js');
		response::getInstance()->addContentToStack('inpage_javascript_top',array('QUANTITY_CHANGE_SHOPPPING_CART_JAVASCRIPT_INPAGE'=>$content));
			
		$content = '<select class="changequantity" product_id ="'.$id.'">';
		for ($i=0;$i<=15;$i++)
		{
		if ($i==$quantity)	{
		$selected = ' selected="selected" ';
		}
		else {
		$selected ='';
		}
				$content .= '<option '.$selected.'>'.$i.'</option>';
			}
			$content .= '</select>';
	
			return $content;
	}
}