<?php
namespace App\View\Helper;
use Cake\View\Helper;

class MyPaginatorHelper extends Helper {

	function show_paginator($records, $per_page, $page){
//echo '<pre>'; print_r($records); exit;
	   	$page_url="?";
	    	$total = $records['numRows'];
		$adjacents = "2"; 

	    	$page = ($page == 0 ? 1 : $page);  
	    	$start = ($page - 1) * $per_page;								
		
	    	$prev = $page - 1;							
	    	$next = $page + 1;
		$setLastpage = ceil($total/$per_page);
	    	$lpm1 = $setLastpage - 1;
	    	
	    	$setPaginate = "";
	    	if($setLastpage > 1)
	    	{	
	    		$setPaginate .= "<ul class='pagination pagination-lg'>";
		            //$setPaginate .= "<li class='setPage'>Page $page of $setLastpage</li>";
	    		if($page > 1){
			   $setPaginate.= "<li class='prev'><a href='{$page_url}page=$prev&rows=$per_page'>< Prev</a></li>";			
			}else{
			   $setPaginate.= "<li class='prev disabled'><a onclick='return false;' href=''>< Prev</a></li>";	
			}
			if ($setLastpage < 7 + ($adjacents * 2))
	    		{	
	    			for ($counter = 1; $counter <= $setLastpage; $counter++)
	    			{
	    				if ($counter == $page)
	    					$setPaginate.= "<li><a class='active'>$counter</a></li>";
	    				else
	    					$setPaginate.= "<li><a href='{$page_url}page=$counter&rows=$per_page'>$counter</a></li>";					
	    			}
	    		}
	    		elseif($setLastpage > 5 + ($adjacents * 2))
	    		{
	    			if($page < 1 + ($adjacents * 2))		
	    			{
	    				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li class='active'><a>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter&rows=$per_page'>$counter</a></li>";					
	    				}
					$setPaginate.= "<li class='dot'><span>...</span></li>";	 
	    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1&rows=$per_page'>$lpm1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&rows=$per_page'>$setLastpage</a></li>";		
	    			}
	    			elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
	    			{
	    				$setPaginate.= "<li><a href='{$page_url}page=1&rows=$per_page'>1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=2&rows=$per_page'>2</a></li>";
					$setPaginate.= "<li class='dot'><span>...</span></li>";	    				
					for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li class='active'><a>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter&rows=$per_page'>$counter</a></li>";					
	    				}
	    				$setPaginate.= "<li><a href='{$page_url}page=$lpm1'>$lpm1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=$setLastpage&rows=$per_page'>$setLastpage</a></li>";		
	    			}
	    			else
	    			{
	    				$setPaginate.= "<li><a href='{$page_url}page=1&rows=$per_page'>1</a></li>";
	    				$setPaginate.= "<li><a href='{$page_url}page=2&rows=$per_page'>2</a></li>";
					$setPaginate.= "<li class='dot'><span>...</span></li>";	 
	    				for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
	    				{
	    					if ($counter == $page)
	    						$setPaginate.= "<li class='active'><a>$counter</a></li>";
	    					else
	    						$setPaginate.= "<li><a href='{$page_url}page=$counter&rows=$per_page'>$counter</a></li>";					
	    				}
	    			}
	    		}
	    		
	    		if ($page < $counter - 1){ 
	    			$setPaginate.= "<li><a href='{$page_url}page=$next&rows=$per_page' class='next'>Next ></a></li>";
	    		}else{
	    			$setPaginate.= "<li class='next disabled'><a onclick='return false;' href=''>Next ></a></li>";
		    	}

	    		$setPaginate.= "</ul>\n";		
	    	}
	    
	    
		return $setPaginate;
    	} 

  
}
?>
