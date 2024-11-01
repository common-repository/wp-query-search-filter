<?php


class WqsfWidget extends WP_Widget 
{
	
	function WqsfWidget(){
		$widget_ops = array('description' => __("This widget displays the search form at front end.", "WQSF") );
		
		parent::WP_Widget( 'WqsfWidget', __("WP Query Search Filter","WQSF"), $widget_ops);
	}
	
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		?>
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("WQSF Search Filter","WQSF");?></label>
			<input type="text" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" value="<?php echo esc_attr($instance['title']);?>" class="widefat" />
			</p>
			
			
		<?php
	}
	
	function update($new_instance, $old_instance){
		//$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function widget( $args, $instance ){
		extract($args, EXTR_SKIP);
		echo $before_widget;
			//if ( $instance['title'] )
			//echo $args['before_title'] . $instance['title'] . $args['after_title'];
			$title = empty($instance['title']) ? __("WQSF Search Filter","WQSF") : apply_filters('widget_title', $instance['title']);
			
			?>
			<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };?>
			<form method="get"  id="wqsf_search_form" action="<?php echo home_url( '/' ); ?>">
			<input type="hidden" name="s" id="search" value="wqsf09be82574" />
			<?php $options = get_option('wqsf');
			
			if(isset($options['taxo'])){
				$c=0;
				 foreach($options['taxo'] as $k => $v){
					 echo '<div class="wqsf_box"><label class="taxo-label-'.$c.'">'.$v['taxlabel'].'</label><br>';
					 echo '<input  type="hidden" name="taxo['.$c.'][name]" value="'.$v['taxname'].'">';
					 echo  '<select id="taxo-'.$c.'" name="taxo['.$c.'][term]"><option selected value="wqsftaxoall">'.$v['taxall'].'</option>'; 
					
					 $terms = get_terms($v['taxname'],'hide_empty='.$v['hide'].'');
					  
					 $count = count($terms);
					if ( $count > 0 ){
					foreach ( $terms as $term ) {
					
					$selected = (isset($_GET['taxo']) && $_GET['taxo'][$c]['term']==$term->slug) ? 'selected="selected"' : '';
					
					echo '<option value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';
						}}
					echo '</select><br>';
					echo '</div>';
					 $c++;
					 }
								
				}
			if(isset($options['cmf'])){
				$i=0;
				 foreach($options['cmf'] as $k => $v){
					 echo '<div class="wqsf_box"><label class="taxo-cmf-'.$i.'">'.$v['label'].'</label><br>';
					 echo '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$v['metakey'].'">';
					 echo '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$v['compare'].'">';
					 echo  '<select id="cmf-'.$i.'" name="cmf['.$i.'][value]">'; 
					 echo '<option value="wqsfcmfall">'.$v['all'].'</option>';
						$opts = explode("|", $v['opt']);
						foreach ( $opts as $opt ) {
							
					     $selected2 = (isset($_GET['cmf']) && $_GET['cmf'][$i]['value']==$opt) ? 'selected="selected"' : '';
						 
						echo '<option value="'.$opt.'" '.$selected2.'>'.$opt.'</option>';
						}
					echo '</select><br>';
					echo '</div>';
					 $i++;
					 }
								
				}
				   
		
			    
					if(isset($options['string']['enable']) && ($options['string']['enable'] == '1') ){
					echo '<div class="wqsf_box"><label class="wqsf-label-keyword">'.$options['string']['label'].'</label><br>';
					echo '<input id="wqsf_keyword" type="text" name="skeyword" value="" />';
				    echo '<br></div>';
					}
			
			
			
			?>
			<div class="wqsf_box"><p class="wqsf-button"><input type="submit" id="wqsf_submit" value="<?php _e("Search","WQSF") ;?>" alt="[Submit]" name="wqsfsubmit" title="Search" /></p></div>
		</form>
			<?php
			
		echo $after_widget;
	
	}
	
	
	

}// end of widget class
?>
