<?php 	
class productsNavigation
{
	public static function displayProductsNavigation()
	{
		require_once 'Project/Code/System/Products/categories.php';
		require_once 'Project/Code/System/Products/subcategories.php';
		require_once 'Project/Code/System/Routes/route.php';
		$url_parameters = request::getInstance()->getParametersArray();
		
		$current_pageID = routes::getInstance()->_pathInfoArray;
		array_shift($current_pageID);
		
		$categories = new categories();
		$categories->select();
		
		$category = new category();
		$category->selectFirst();
		$category_first = $category->__get('category_id');
		
		$content = '<div id="heading" class="pAm"><h4 class="fc_starfish_gray6 pos_rel">CATEGORIES <span class="fc_starfish_blue fwB">('.count($categories->__get('array_of_categories')).')</span><div class="addCategory_action fright pointer pos_abs" title="add category"><span class="sprite fright addCat"></span><div></h4></div>';
		$content .= '<div id="sideNavigation"><div class="scroll-pane"><ul id="nav_list">';
		
		foreach ($categories->__get('array_of_categories') as $category)
		{
			//add active class
			$category_active = '';
			if(count($url_parameters) > 0 && is_numeric($url_parameters[0]) && $category->__get('category_id') == $url_parameters[0] &&  $current_pageID[0] == 'category' || $category_first == $category->__get('category_id') && count($url_parameters) <= 0 )
				$category_active = ' class="active"';
			
			$content .= '<li'.$category_active.'><span><a class="fc_starfish_gray3 fs-xl fwB" href="/products/category/'.$category->__get('category_id').'">'.$category->__get('category_title').'</a></span>';
			
			//get subcategories list by category
			$subcategories = new subcategories();
			$subcategories->selectByCategoryID($category->__get('category_id'));
			
			if(count($subcategories->__get('array_of_subcategories')) > 0)
			{
				$content .= '<ul>';
				
				foreach ($subcategories->__get('array_of_subcategories') as $subcategory)
				{
					//add active class
					$subcategory_active = '';
					if(count($url_parameters) >= 1 && is_numeric($url_parameters[0]) && $subcategory->__get('subcategory_id') == $url_parameters[0] &&  $current_pageID[0] == 'subcategory')
						$subcategory_active = ' class="active"';
					
					$content .= '<li'.$subcategory_active.'><span><a  class="fc_starfish_gray3 fwB" href="/products/subcategory/'.$subcategory->__get('subcategory_id').'">'.$subcategory->__get('subcategory_title').'</a></span></li>';
				}
				
				$content .= '</ul>';
			}
		}
		
		$content .= '</ul></div></div>';
		
		return $content;
	}
	
	
	
}
	
?>