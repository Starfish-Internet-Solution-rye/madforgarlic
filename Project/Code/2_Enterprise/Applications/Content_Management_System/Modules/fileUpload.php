<?php

class fileUpload
{
	public static function uploadMultiple($name = 'file', $accepted_types = array())
	{
		$file_array = array();
		$file_count = count($_FILES[$name]['name']);
		
		//i just rearranged the array
		for($i = 0; $i < $file_count; $i++)
			$file_array[] = array(
				'name'		=>$_FILES[$name]['name'][$i],
				'type'		=>$_FILES[$name]['type'][$i],
				'tmp_name'	=>$_FILES[$name]['tmp_name'][$i],
				'error'		=>$_FILES[$name]['error'][$i],
				'size'		=>$_FILES[$name]['size'][$i]
			);
		
		foreach($file_array as $file)
			self::upload($file, $path, '', $name, $accepted_types);
		
	}
//-------------------------------------------------------------------------------------------------	
	
	public static function upload($file, $path, $filename = '', $name = 'file', $accepted_types = array())
	{
		if($filename == '')
 			$filename = str_replace(' ', '_', $file[$name]['name']);
		//get file extension
		$ext 		= rtrim(substr($filename, strripos($filename, '.'))); 
		$filename 	= rtrim(substr($filename, 0, strripos($filename, '.'))); 
		
		if(self::validateUpload($file, $name, $accepted_types))
			if(!file_exists($path.'/'.$filename))
				return move_uploaded_file($file[$name]['tmp_name'], $path.'/'.$filename.$ext);
				//return copy($file[$name]['tmp_name'], $path.'/'.$filename.$ext);
			
			else
				print("File {$path}/{$filename}.{$ext} already exists.<br>");
			
		else
			print("File {$path}/{$filename}.{$ext} is not supported.<br>");
		
		return FALSE;
	}
	
//-------------------------------------------------------------------------------------------------	
	
	public static function validateUpload($file, $name, $accepted_types = array(), $size = 5242880)
	{
		if(($file[$name]["size"] < $size ) && ($file[$name]["error"] == 0))
			
			if(count($accepted_types) == 0)
				return TRUE;
		
			else
				if(in_array($file[$name]["type"], $accepted_types))
					return TRUE;
			
				else
					return FALSE;
	}
}
