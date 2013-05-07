<?php

class newsFeeds
{
	public $content_raw;
	public $content;
	public $sections;
	
	public function newsFeedGetter($params = array())
	{
		$result_array = array();
		
		$content = file_get_contents($params['url']);
		
		$content = substr($content, strpos($content, $params['main_tag']));
		
		$content = substr($content, strpos($content, $params['sub_opening_tag']));

		$len = strpos($content, $params['sub_closing_tag']) - strpos($content, $params['sub_opening_tag']);
		
		$content = str_replace($params['main_tag'], '', $content);
		
		$this->content_raw = $content = substr($content, strpos($content, $params['sub_opening_tag']), $len);
		
		$content = str_replace($params['words_to_replace'], '', $content);
		
		$content = str_replace($params['sub_opening_tag'], '', $content);
		$content = str_replace($params['sub_closing_tag'], '', $content);
		
		$pattern = str_replace('/', "\/", $params['explode_tag']);
		
		$content = preg_replace('/^'.$pattern.'/', '', $content);
		
		$content = preg_replace('/'.$pattern.'^/', '', $content);
		
		$x = 0;
		
		$this->content = $content = trim($content);
		
		$sections = explode($params['explode_tag'], $content);
		$this->sections = $sections = array_filter($sections);
		
		foreach ( $sections as $section)
		{
		
			$sub_section = explode($params['inner_explode_tag'], $section);
			
			if (strpos($sub_section[1], '.pdf')  == true )
			{
				
				$result_array[$x]['title'] = trim($sub_section[0]);
				$result_array[$x]['link'] = trim($sub_section[1]);
			}
			elseif (strpos($sub_section[0], '.pdf')  == true )
			{
				$result_array[$x]['title'] = trim($sub_section[1]);
				$result_array[$x]['link'] = trim($sub_section[0]);
			}
			
			if ((strpos($result_array[$x]['link'], 'http://')) === false)
				if (strpos($sub_section[1], '.pdf')  == true )
					$result_array[$x]['link'] = 'http://agk.com.au'.trim($sub_section[1]);
				else
					$result_array[$x]['link'] = 'http://agk.com.au'.trim($sub_section[0]);

			$result_array[$x]['site_name'] = $params['site_name'];
				
			$x++;

			$params['news_count']--;
			
			if ($params['news_count'] == 0)
				break;
		}
		
		return $result_array;
	} 
}

?>