<?php 

function get_wqsf_taxo() {
	global $wp_query;
	$options = get_option('wqsf');
	$taxrel = isset($options['tax']['rel']) ? $options['tax']['rel'] : 'AND';
	if(isset($_GET['taxo'])){
				
		$taxo=array('relation' => $taxrel,'');
		foreach($_GET['taxo'] as  $v){
			if( strip_tags( stripslashes($v['term'])) == 'wqsftaxoall'){
			  $taxo[] = array(
					'taxonomy' => strip_tags( stripslashes($v['name'])),
					'field' => 'slug',
					'terms' => strip_tags( stripslashes($v['term'])),
					'operator' => 'NOT IN'
				);
			  
			  }else{
		  
			 $taxo[] = array(
					'taxonomy' => strip_tags( stripslashes($v['name'])),
					'field' => 'slug',
					'terms' => strip_tags( stripslashes($v['term']))
				);
			}
		}
	unset($taxo[0]);
			return $taxo ;				
			
	}
}

function get_wqsf_cmf(){
	$options = get_option('wqsf');
	$cmfrel = isset($options['cmft']['rel']) ? $options['cmft']['rel'] : 'AND';
	
	if(isset($_GET['cmf'])){
		$cmf=array('relation' => $cmfrel,'');
		foreach($_GET['cmf'] as  $v){
		   $campares = array( '1' => '=', '2' =>'!=', '3' =>'>', '4' =>'>=', '5' =>'<', '6' =>'<=', '7' =>'LIKE', '8' =>'NOT LIKE', '9' =>'IN', '10' =>'NOT IN', '13' => 'NOT EXISTS');//avoid tags stripped 
			
			if($v['value'] == 'wqsfcmfall'){
				    $cmf[] = array(
						'key' => strip_tags( stripslashes($v['metakey'])),
						'value' => 'get_all_cmf_except_me',
						'compare' => '!='
				);
				  
				}
			elseif( $v['compare'] == '11'){
				$range = explode("-", strip_tags( stripslashes($v['value'])));
			    $cmf[] = array(
						'key' => strip_tags( stripslashes($v['metakey'])),
						'value' => $range,
						'type' => 'numeric',
						'compare' => 'BETWEEN'
				);
			  
			  }
			  elseif( $v['compare'] == '12'){
				$range = explode("-", strip_tags( stripslashes($v['value'])));
			    $cmf[] = array(
						'key' => strip_tags( stripslashes($v['metakey'])),
						'value' => $range,
						'type' => 'DECIMAL',
						'compare' => 'NOT BETWEEN'
				);
			  
			  }elseif( $v['compare'] == '3' || $v['compare'] == '4' || $v['compare'] == '5' || $v['compare'] == '6'){
				 	
					foreach($campares as $ckey => $cval)
					{  if($ckey == $v['compare'] ){ $safec = $cval;}        }
					
					$cmf[] = array(
					'key' => strip_tags( stripslashes($v['metakey'])),
					'value' => strip_tags( stripslashes($v['value'])),
					'type' => 'DECIMAL',
					'compare' => $safec
				);
			}else{
				 	
					foreach($campares as $ckey => $cval)
					{  if($ckey == $v['compare'] ){ $safec = $cval;}        }
					
					$cmf[] = array(
					'key' => strip_tags( stripslashes($v['metakey'])),
					'value' => strip_tags( stripslashes($v['value'])),
					'compare' => $safec
				);
			}
			
		   	
		}
	unset($cmf[0]);
			return $cmf ;				
			
	}
	
}


function wqsf_search_query( $query ) {
		
	if($query->is_search()){
		
		if($query->query_vars['s'] == 'wqsf09be82574' ){	
				
			$options = get_option('wqsf');
			$default_number = get_option('posts_per_page');
			
			$cpt        = isset($options['cpt']) ? $options['cpt'] : 'any';
			$ordermeta  = isset($options['string']['enable']) && isset($options['order']['meta']) ? $options['order']['meta'] : null;
			$ordervalue = isset($options['string']['enable']) && isset($options['order']['value']) ? $options['order']['value'] : null;
			$order      = isset($options['order']['sort']) ? $options['order']['sort'] : null;
			$number      = isset($options['order']['number']) ? $options['order']['number'] : $default_number;
			$paged = ( get_query_var( 'paged') ) ? get_query_var( 'paged' ) : 1;
			$keyword = !empty($_GET['skeyword']) ?	 $_GET['skeyword'] : null;
			$get_tax = get_wqsf_taxo();
			$get_meta = get_wqsf_cmf();
			$tax_query = isset($get_tax) && empty($keyword) ? 	$get_tax : null;
			$meta_query = isset($get_meta) && empty($keyword) ? $get_meta : null;    
			   
				
				
				$query->query_vars['posts_per_page'] = $number ;
				$query->set( 'meta_key', $ordermeta );
				$query->set( 'orderby', $ordervalue );
				$query->set( 'order', $order  );
				$query->set( 'page', $paged );
				$query->set( 'post_type', $cpt );
				$query->set( 'tax_query', $tax_query );
				$query->set( 'meta_query', $meta_query );
					
				$query->query_vars['s'] = esc_html($keyword);
					
			   return $query;}
	   
	   
	  return $query; 
	   
    }
 
}
add_action( 'pre_get_posts', 'wqsf_search_query',11);

		

;?>
