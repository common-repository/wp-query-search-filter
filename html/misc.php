<?php
	$options = get_option('wqsf');	
	$string = isset($options['string']['enable']) && (sanitize_text_field($options['string']['enable']) == '1') ? 'checked="checked"' : null;
	$slabel = !empty($options['string']['label']) ? sanitize_text_field($options['string']['label']) : __("Search by Keyword","WQSF");
	$meta = isset($options['order']['meta']) ? sanitize_text_field($options['order']['meta']) : null;
	$word =  isset($options['order']['value']) && ($options['order']['value'] == 'meta_value' )  ? 'checked="checked"' : null;
	$number =  isset($options['order']['value']) && ($options['order']['value'] == 'meta_value_num' )  ? 'checked="checked"' : null;
	$desc = isset($options['order']['sort']) && ($options['order']['sort'] == 'DESC' )  ? 'checked="checked"' : null; 
	$asc = isset($options['order']['sort']) && ($options['order']['sort'] == 'ASC' )  ? 'checked="checked"' : null; 
	$defualtresult = get_option('posts_per_page');
	$result = isset($options['order']['number']) ? sanitize_text_field($options['order']['number']) : $defualtresult; 
	
	$html = "";
	$html .= '<h3>'.__("Add String Search?","WQSF").'</h3>';
    $html.= '<p><input '.$string.'  name="wqsf[string][enable]" type="checkbox" value="1" />'.__("Enabling string search","WQSF").'<br>';
    $html.= '<span class="desciption">'.__("This will add string search in the form. Note that when user using this to search, the taxonomy and custom meta filter that defined above will not be used. However, the search will still go through the post type defined above.","WQSF").'</span><br>';
    $html.= '<p><label>'.__("Label for string search.","WQSF").':</label><br>';
    $html.= '<input type="text"  name="wqsf[string][label]" id="stringlabel" value="'.$slabel.'" /><br>';
   
   


    $html .= '<h3>'.__("Result Page Setting","WQSF").'</h3>';
    $html.= '<p><label>'.__("Sorting Meta Key.","WQSF").':</label><br>';
    $html.= '<input type="text" id="sortmeta" name="wqsf[order][meta]" value="'.$meta.'"/><br>';
    $html.= '<span class="desciption">'.__("Insert the meta key that will be used for the result sorting. Leave empty will using the default 'date' value for sorting.","WQSF").'</span></p>';
    
    $html.= '<p><label>'.__("Meta Value Type","WQSF").':</label><br>';
    $html.= '<label><input '.$word.' type="radio" id="taxhide" name="wqsf[order][value]" value="meta_value"/>'.__("Words","WQSF").'</label>';
	$html.= '<label><input '.$number.' type="radio" id="taxhide" name="wqsf[order][value]" value="meta_value_num"/>'.__("Numeric", "WQSF").'</label>';
    $html.= '<br><span class="desciption">'.__("What is the meta value type of the sorting meta key? eg. sorting meta key = 'price', then the meta value type should be numeric. Leave it blank if your sorting meta key is empty.","WQSF").'</span></p>';
    
    $html.= '<p><label>'.__("Sorting Order","WQSF").':</label><br>';
    $html.= '<label><input '.$desc.' type="radio" id="taxhide" name="wqsf[order][sort]" value="DESC"/>'.__("Descending","WQSF").'</label>';
	$html.= '<label><input '.$asc.' type="radio" id="taxhide" name="wqsf[order][sort]" value="ASC"/>'.__("Ascending","WQSF").'</label><br>';
    $html.= '<span class="desciption">'.__("The search result sorting order. Default is descending","WQSF").'</span></p>';
    
    $html.= '<p><label>'.__("Results per Page","WQSF").':</label>';
    $html.= '<input type="text" id="numberpost" name="wqsf[order][number]" value="'.$result.'" size="2"/><br>';
    $html.= '<span class="desciption">'.__("How many posts shows at each result page?","WQSF").'</span></p>';
    
    echo $html;

?>
