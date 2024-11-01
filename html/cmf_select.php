<?php
	$options = get_option('wqsf');
	$items = array("AND", "OR");
	echo '<span>'.__("Boolean relationship between the meta queries", "WQSF").'</span><br>';
	foreach($items as $item) {
		
		$checked = isset($options['cmft']['rel']) && ($options['cmft']['rel']==$item) ? 'checked="checked"' : '';
		echo '<label><input id = "cmfrel" '.$checked.' value="'.$item.'" name="wqsf[cmft][rel]" type="radio" />'.$item.'</label>';
	}	
	
		echo '<ul><i><li class="desc">'.__("AND - Must meet all meta field search.","WQSF").'</li>';
		echo '<li class="desc">'.__("OR - Either one of the meta field search is meet.","WQSF").'</li></i></ul>';
				
?>

	<div class="formbutton">
	<input alt="#TB_inline?height=580&amp;width=600&amp;inlineId=add_cmf_form" title="Add Custom Meta Field" class="thickbox button-secondary" type="button" value="<?php _e("Add Custom Meta",'WQSF') ;?>" />
	</div>  
   	<table id="cmf_table" class="widefat">
	
			<thead>
				<tr>
				<th><?php _e('Meta key','WQSF'); ?></th>
				<th><?php _e('Label','WQSF'); ?></th>
				<th><?php _e('"Search All" Text','WQSF'); ?></th>
				<th><?php _e('Compare','WQSF'); ?></th>
				<th><?php _e('Options','WQSF'); ?></th>
				<th><?php _e('Remove?','WQSF'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
				<th><?php _e('Meta key','WQSF'); ?></th>
				<th><?php _e('Label','WQSF'); ?></th>
				<th><?php _e('"Search All" Text','WQSF'); ?></th>
				<th><?php _e('Compare','WQSF'); ?></th>
				<th><?php _e('Options','WQSF'); ?></th>
				<th><?php _e('Remove?','WQSF'); ?></th>
				</tr>
			</tfoot>	
			
			<tbody class="cmfbody">
			 <?php 	 $html = '<br>';
			 $c =0; 
			 $campares = array( '1' => '=', '2' =>'!=', '3' =>'>', '4' =>'>=', '5' =>'<', '6' =>'<=', '7' =>'LIKE', '8' =>'NOT LIKE', '9' =>'IN', '10' =>'NOT IN', '11' =>'BETWEEN', '12' =>'NOT BETWEEN','13' => 'NOT EXISTS');	
			 if(isset($options['cmf'])){
			  	foreach($options['cmf'] as $k => $v){
					$html .= '<tr>';
					$html .=  '<td><input type="hidden" id="cmfcounter" name="cmfcounter" value="'.$c.'"/>';//counter
					//for custom meta key
				
					$html .= '<input type="text" id="cmfkey" name="wqsf[cmf]['.$c.'][metakey]" value="'.sanitize_text_field($v['metakey']).'"/>';
					$html .= '<br></td>';
					//for Label
					$html .=  '<td>';
					$html .= '<input type="text" id="cmflabel" name="wqsf[cmf]['.$c.'][label]" value="'.sanitize_text_field($v['label']).'"/>';
					$html .= '<br></td>';
					//search all text
					$html .=  '<td>';
					$html .= '<input type="text" id="cmfalltext" name="wqsf[cmf]['.$c.'][all]" value="'.sanitize_text_field($v['all']).'"/>';
					$html .= '<br></td>';
					//for compare
					$html .=  '<td>';
					$html .= '<select id="cmfcom" name="wqsf[cmf]['.$c.'][compare]">';
						foreach ($campares  as $ckey => $cvalue ) {
						$selected = ($v['compare']==$ckey) ? 'selected="selected"' : '';	
					$html .= '<option value="'.$ckey.'" '.$selected.'>'.$cvalue.'</option>';}
					$html .= '</select><br></td>';
					
					//for options
					$html .=  '<td>';
					
					$html .= '<textarea id="cmflabel" name="wqsf[cmf]['.$c.'][opt]" >'.esc_html($v['opt']).'</textarea>';
					$html .= '</td>';
				    $html .= '<td><span class="remove_row button-secondary">'.__("Remove","WQFS").'</span></td></tr>';
				  $c++; 
				}
				
				
			 }
			 	echo $html; 
			 ?>
			</tbody>
	
	</table>

