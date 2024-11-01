<?php
	  echo '<label>'.__("Choose the post type you want to include in the search","WQSF").'</label><br>';
			$post_types=get_post_types('','names'); 
			unset($post_types['revision']); unset($post_types['attachment']);unset($post_types['nav_menu_item']);
			$options = get_option('wqsf');
			
			foreach($post_types as $post_type ) {
			    $checked = null;		
			   
			    if(isset($options['cpt'])){
				  foreach ($options['cpt'] as $checkedtyped)
				   {
					if($checkedtyped == $post_type)  $checked = 'checked="checked"';   
				   }
			     }
			  
			  
			  echo '<div class="wqsf_cpt_div"><input '.$checked.' id="cpt" name="wqsf[cpt][]" type="checkbox" value="'.$post_type.'" />'.$post_type.'</div>';
			
			}
	echo '<div class="clear"></div>';	
?>
