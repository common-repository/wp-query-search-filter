<?php
	$options = get_option('wqsf');
	$items = array("AND", "OR");
	echo '<span>'.__("Boolean relationship between the taxonomy queries", "WQSF").'</span><br>';
	foreach($items as $item) {
		$checked = isset($options['tax']['rel']) && ($options['tax']['rel']==$item) ? 'checked="checked"' : '';;
		echo '<label><input id = "taxrel" '.$checked.' value="'.$item.'" name="wqsf[tax][rel]" type="radio" />'.$item.'</label>';
	}	
	
	echo '<ul><i><li class="desc">'.__("AND - Must meet all taxonomy search.","WQSF").'</li>';
	echo '<li class="desc">'.__("OR - Either one of the taxonomy search is meet.","WQSF").'</li></i></ul>';
	
	?>
	
	
	
	
	<div class="formbutton"><input alt="#TB_inline?height=450&amp;width=400&amp;inlineId=add_taxo_form" title="Add Taxonomy" class="thickbox button-secondary" type="button" value="<?php _e("Add Taxonomy",'WQSF') ;?>" /></div>  
	
	<table id="taxo_table" class="widefat">
    			<thead>
				<tr>
				<th><?php _e('Taxonomy','WQSF'); ?></th>
				<th><?php _e('Label','WQSF'); ?></th>
				<th><?php _e('"Search All" Text','WQSF'); ?></th>
				<th><?php _e('Hide Empty?','WQSF'); ?></th>
				<th><?php _e('Remove?','WQSF'); ?></th>
				</tr>
			</thead>
		 
			<tfoot>
				<tr>
				<th><?php _e('Taxonomy','WQSF'); ?></th>
				<th><?php _e('Label','WQSF'); ?></th>
				<th><?php _e('"Search All" Text','WQSF'); ?></th>
				<th><?php _e('Hide Empty?','WQSF'); ?></th>
				<th><?php _e('Remove?','WQSF'); ?></th>
				</tr>
			</tfoot>	
				
	<tbody class="taxbody">
	<?php $html = '<br>';
	
	if(isset($options['taxo'])){
		$c =0; 
		$args=array('public'   => true, '_builtin' => false); 
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies=get_taxonomies($args,$output,$operator); 
		foreach($options['taxo'] as $k => $v){
				$html .= '<tr>';
				$html .=  '<td><input type="hidden" id="taxcounter" name="taxcounter" value="'.$c.'"/>';//counter
				//for display taxonomy
			
				$html .= '<select id="taxo" name="wqsf[taxo]['.$c.'][taxname]">';
				$catselect = ($v['taxname']== 'category') ? 'selected="selected"' : '';
				$html .= '<option value="category" '.$catselect.'>'.__("category","WQSF").'</option>';
					foreach ($taxonomies  as $taxonomy ) {
				$selected = ($v['taxname']==$taxonomy) ? 'selected="selected"' : '';		
				$html .= '<option value="'.$taxonomy.'" '.$selected.'>'.$taxonomy.'</option>';
						}
				$html .= '</select><br></td>';
				//for label
				$html .=  '<td>';
				$html .= '<input type="text" id="taxlabel" name="wqsf[taxo]['.$c.'][taxlabel]" value="'.sanitize_text_field($v['taxlabel']).'"/>';
				$html .= '<br></td>';
				//search all text
				$html .=  '<td>';
				$html .= '<input type="text" id="taxall" name="wqsf[taxo]['.$c.'][taxall]" value="'.sanitize_text_field($v['taxall']).'"/>';
				$html .= '<br></td>';
				//hide empty
				$html .= '<td>';
				
				$check1="";
				$check0="";
				if($v['hide'] == 1){$check1 = 'checked="checked"'; };
				if($v['hide'] == 0){$check0 = 'checked="checked"'; };
				$html .= '<label><input '.$check1.' type="radio" id="taxhide" name="wqsf[taxo]['.$c.'][hide]" value="1"/>Yes</label>';
				$html .= '<label><input '.$check0.' type="radio" id="taxhide" name="wqsf[taxo]['.$c.'][hide]" value="0"/>No</label>'; 
				$html .= '<br></td>';
				//action
				$html .= '<td><span class="remove_row button-secondary">'.__("Remove","WQSF").'</span><br></td>';
				$html .= '</tr>';
				$c++;
					
		}
	   			
    }
	echo $html; 
	?>
	
	</tbody>
	</table>

