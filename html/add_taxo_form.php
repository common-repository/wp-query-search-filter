  <div class="add_tax_form_div"  style="display:none">
	<form id="add_taxo_form">
	<h3><?php _e("Taxonomy Details","WQSF");?></h3>
	
	<p>
	<span><?php _e("Select Taxonomy","WQSF");?></span><br>
	<select id="pretax" name="pre_add_tax">
	<option value="category"><?php _e("category","WQSF");?></option>
	<?php
	
		$args=array('public'   => true, '_builtin' => false); 
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies=get_taxonomies($args,$output,$operator); 
		if  ($taxonomies) {
			foreach ($taxonomies  as $taxonomy ) {
			echo '<option value="'.$taxonomy.'">'.$taxonomy.'</option>';
	     }
		};
	?>
	</select>
	</p>
	<p>
	<span><?php _e("Label","WQSF");?></span><br>
	<input type="text" id="prelabel" name="pre_tax_label" size="20" value=""><br>
	<span class="desciption"><?php _e("To be displayed in the search form", "WQSF");?></span>
	</p>
	<p>
	<span><?php _e("Text For 'Search All' Options","WQSF");?></span><br>
	<input type="text" id="preall" name="pre_all_text" size="20" value="" /><br>
	<span class="desciption"><?php _e("eg, All cities, All genres", "WQSF") ;?></span>
	</p>
	<p>
	<span><?php _e("Hide Empty Terms?","WQSF");?></span><br>
	<label><input type="radio" id="prezero" name="pre_hide_empty" value="1"   />Yes</label>
	<label><input type="radio" id="prezero" name="pre_hide_empty" value="0"   />No</label><br>
	<span class="desciption"><?php _e("Empty terms are the terms that no posts assigned to them. ", "WQSF") ;?></span>
	</p><br>
	<p><input type="submit" value="<?php _e("Add Taxonomy","WQSF");?>" class="add-taxo button-secondary" /></p>
	</form>
	</div>
