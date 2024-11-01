<div class="add_tax_form_div"  style="display:none">
	<form id="add_cmf_form" >
	
	<h3><?php _e("Meta Field Setting","WQSF");?></h3>
	<p><span><?php _e("Meta Key","WQSF");?>:</span>
	<input type="text" id="precmfkey" name="prekey" value=""/><br>
	<span class="desciption"><?php _e("Insert the meta key. The meta key should exactly same as you define. It is case sensitive. ", "WQSF");?></span>
	</p>
	
	<p><span><?php _e("Label","WQSF");?>:</span>
	<input type="text" id="precmflabel" name="precmflabel" value=""/><br>
	<span class="desciption"><?php _e("To be displayed in the search form", "WQSF");?></span>
	</p>
	
	<p><span><?php _e("Text For 'Search All' Options","WQSF");?>:</span>
	<input type="text" id="precmfall" name="precmfall" value=""/><br>
	<span class="desciption"><?php _e("eg, All prices, All weight", "WQSF") ;?></span>
	</p>
	
	<p><span><?php _e("Compare","WQSF");?>:</span>
	<select id="precompare" name="precompare">
	<?php $campares = array( '1' => '=', '2' =>'!=', '3' =>'>', '4' =>'>=', '5' =>'<', '6' =>'<=', '7' =>'LIKE', '8' =>'NOT LIKE', '9' =>'IN', '10' =>'NOT IN', '11' =>'BETWEEN', '12' =>'NOT BETWEEN','13' => 'NOT EXISTS');	
		foreach ($campares   as $ckey => $cvalue ) {
			echo '<option value="'.$ckey.'">'.$cvalue.'</option>';
	     }
	?>
	</select><br>
	<span class="desciption"><?php _e("Operator to test. Use it carefully. If you choose 'BETWEEN', then your options should be range." , "WQSF") ;?></span>
	<?php $link = 'http://wordpress.stackexchange.com/questions/70864/meta-query-compare-operator-explanation/70870#70870';
	echo '<span class="desciption">'.sprintf(__("More about compare, please visit <a href='%s' target='_blank'>here</a>", "WQSF"), $link ).'</span>';
	;?>
	</p>
	
	<p><span><?php _e("Dropdown Options","WQSF");?>:</span><br>
	<textarea  id="preopt" name="preopt" rows="5" cols="40"></textarea><br>
	<span class="desciption"><?php _e("Your options should be exactly same you inserted in your posts. Use '|' to separating your option. For range option, using '-' to define the range. " , "WQSF") ;?></span><br>
	<span class="desciption"><?php _e("eg: for normal option value 1 | value 2 | value 3...etc" , "WQSF") ;?></span><br>
	<span class="desciption"><?php _e("eg: for range option 1-100 | 101-200 | 201-300...etc" , "WQSF") ;?></span>
	</p>
	
	
	<input type="submit" value="<?php _e("Add Custom Field","WQSF");?>" class="add-cmf button-secondary" />
	</form>
	</div>
