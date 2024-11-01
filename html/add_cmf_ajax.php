<?php 
		$key = sanitize_text_field($_POST['key']);
		$label = sanitize_text_field($_POST['metalabel']);
		$all = sanitize_text_field($_POST['all']);
		$com = sanitize_text_field($_POST['compare']);
		$option =sanitize_text_field($_POST['opt']);
		$c = $_POST['cmfcounter'];
		$campares = array( '1' => '=', '2' =>'!=', '3' =>'>', '4' =>'>=', '5' =>'<', '6' =>'<=', '7' =>'LIKE', '8' =>'NOT LIKE', '9' =>'IN', '10' =>'NOT IN', '11' =>'BETWEEN', '12' =>'NOT BETWEEN','13' => 'NOT EXISTS');	
		$html  = '<tr style="background:#BEF781"><td><input type="hidden" id="cmfcounter" name="cmfcounter" value="'.$c.'"/>';
		$html .= '<input type="text" id="cmfkey" name="wqsf[cmf]['.$c.'][metakey]" value="'.$key.'"/>';
		$html .= '<br></td>';
		
		$html .=  '<td>';
		$html .= '<input type="text" id="cmflabel" name="wqsf[cmf]['.$c.'][label]" value="'.$label.'"/>';
		$html .= '<br></td>';
		
		$html .=  '<td>';
		$html .= '<input type="text" id="cmfalltext" name="wqsf[cmf]['.$c.'][all]" value="'.$all.'"/>';
		$html .= '<br></td>';
		
		$html .=  '<td>';
		$html .= '<select id="cmfcom" name="wqsf[cmf]['.$c.'][compare]">';
				foreach ($campares  as $ckey => $cvalue  ) {
				$selected = ($com==$ckey) ? 'selected="selected"' : '';	
		$html .= '<option value="'.$ckey.'" '.$selected.'>'.$cvalue.'</option>';}
		$html .= '</select><br></td>';
		
	    $html .= '<td><textarea id="cmflabel" name="wqsf[cmf]['.$c.'][opt]" >'.$option.'</textarea></td>';
		
		$html .= '<td><span class="remove_row button-secondary">'.__("Remove","WQFS").'</span></td></tr>';
       	echo $html;


?>
