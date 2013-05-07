<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php';

class applicationsSuperView  extends viewSuperClass_Core
{

//=================================================================================================	
//select input
	protected function displaySelectInput($options, $name, $selected = '')
	{	
		$content = '<select name="'.$name.'">';
		
		foreach($options as $key=>$value)
		{
			$select = '';
			
			if($selected === $key)
				$select = ' selected="selected"';
			
			$content .= '<option value="'.$key.'"'.$select.'>'.$value.'</option>';
		}
		
		$content .= '</select>';
		
		return $content;
	}
//select input na number
//=================================================================================================	

	protected function displayNumberSelectInput($name, $max, $selected = '', $min = 1)
	{	
		$content = '<select name="'.$name.'">';
		
		for($i = $min; $i <= $max; $i++)
		{
			$select = '';
			
			if($selected == $i)
				$select = ' selected="selected"';
			
			$content .= '<option value="'.$i.'"'.$select.'>'.$i.'</option>';
		}
		
		$content .= '</select>';
		
		return $content;
	}

//=================================================================================================	
//radio or checkbox
	protected function displayCheckInput($options, $name, $selected = '', $type = 'radio', $br = '')
	{	
		$content = '';
		$i = 0;
		
		foreach($options as $key=>$value)
		{
			$select = '';
			
			if($selected == $value) $select = ' checked="checked"';
			
			if($i == count($options) - 1) $br = '';
			
			$content .= '<input type="'.$type.'" name="'.$name.'" value="'.$key.'"'.$select.'>'.'<span>'.$value.'</span>'.$br;
			
			$i ++;
		}
		
		return $content;
	}

//=================================================================================================	

	protected function displayOptionChoice($options, $selected)
	{
		foreach($options as $key=>$value)
			if($selected == $key)
				return $value;
	}
	
	
}