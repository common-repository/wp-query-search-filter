<?php
/*
Plugin Name: WP Query Search Filter
Plugin URI: 
Description: This plugin let you using wp_query to filter taxonomy,custom meta and post type as search result.
Version: 1.0.7
Author: TC 
Author URI: http://www.9-sec.com/
*/
/*  Copyright 2012 TCK (email: devildai@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
require_once dirname( __FILE__ ) .'/includes/process.php';
if(!class_exists('wqsf')){
	class wqsf{
		const wqsf_ver = 1;//the plugin version
		
		public function __construct(){
			//I18n
			add_action('init', array($this, 'WQSFLanguage'),1);
			//plugin admin setting
			add_action( 'admin_init' , array( $this,'wqsf_init_setting' ) );
			add_action('admin_menu', array($this,'wqsf_menu'));
			//ajax taxo
			add_action( 'wp_ajax_nopriv_adding_taxo_ajax', array( $this,'adding_taxo_ajax') );  
			add_action( 'wp_ajax_adding_taxo_ajax', array( $this,'adding_taxo_ajax') ); 
			// ajax cmf
			add_action( 'wp_ajax_nopriv_adding_cmf_ajax', array( $this,'adding_cmf_ajax') );  
			add_action( 'wp_ajax_adding_cmf_ajax', array( $this,'adding_cmf_ajax') ); 
			//add widget 
			add_action('widgets_init', array($this,'wqsfWidget'));
			// style for front end
			add_action( 'wp_enqueue_scripts', array($this,'wsqf_front_styles'), false, '1.0', 'all',1 );
			//shorcodes
			add_action( 'init', array($this, 'wqsf_register_shortcodes'));
			
		}
		
		function WQSFLanguage(){
			load_plugin_textdomain( 'WQSF', false, 'wp-query-search-filter/lang' );
		}
		
		function wqsf_init_setting(){
			if( false == get_option( 'wqsf_ver' ) ) {    
				 add_option('wqsf_ver', self::wqsf_ver );	//add the version of wqsf.For future plugin enhancement. 
				}
			
				if( false == get_option( 'wqsf' ) ) {    
				 add_option( 'wqsf' );  
				 $default_options = array(
				 'tax' => array('rel' => 'AND' )
				 );
				 update_option('wqsf',$default_options);
				}
			register_setting( 'wqsf_setting', 'wqsf', array($this,'wqsf_db_vd'));
			add_settings_section( 'wpsf_cpt', __("Custom Post Type","WQSF"), array($this,'wpsf_cpt_cb'), 'wqsf_setting' ); 
			add_settings_section( 'wpsf_tax', __("Taxonomy","WQSF"), array($this,'wpsf_tax_cb'), 'wqsf_setting' ); 
			add_settings_section( 'wpsf_cmf', __("Custom Meta Field","WQSF"), array($this,'wpsf_cmf_cb'), 'wqsf_setting' ); 
			add_settings_section( 'wpsf_mis', '', array($this,'wpsf_mis_cb'), 'wqsf_setting' ); 
		}
		
		function wqsf_menu(){
		 // Add a new submenu under Settings:
			$hook = add_options_page(__('WP Query Search Filter','WQSF'), __('WP Query Search Filter','WQSF'), 'manage_options', 'wqsf_setting',array($this,'wqsf_page'));
			add_action('admin_print_scripts-'.$hook, array($this,'jscontrol'));
			add_action('admin_print_styles-'.$hook, array($this,'wqsf_css'));	
		}
		
		function jscontrol(){
			 wp_enqueue_script('thickbox',null,array('jquery'));
		
			wp_enqueue_script('js', plugins_url('js/wqsfjs.js', __FILE__), array('jquery'), '1.0', true);
			wp_localize_script( 'ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) ); 
		}
		
		function wqsf_css(){
			wp_enqueue_style('wqafcss', plugins_url('css/wqsf.css', __FILE__), '1.0', true);
			wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
		}
		
		function wsqf_front_styles()
		{
			// Register the style in the front end for the front:
			wp_register_style( 'wqsf-custom-style', plugins_url( 'css/wqsf-style.css', __FILE__ ), array(),  'all' );
			wp_enqueue_style( 'wqsf-custom-style' );
		}
		
		function wqsf_page(){
			?>
			<div class="wrap">  
			<div id="icon-themes" class="icon32"></div>  
			<h2><?php _e("WP Query Search Filter", "WQSF");?></h2> 
			<form method="post" action="options.php" > 
			<?php settings_fields('wqsf_setting'); ?>
			 <?php do_settings_sections('wqsf_setting' ) ;?>
			 	<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary form_submit" value="<?php _e("Save Changes","WQSF") ;?>"  /></p>	
			</form>
           </div>
			 <?php
			include "html/add_taxo_form.php";
			include "html/add_cmf_form.php";
		}
		
		function wpsf_cpt_cb(){
			include "html/cpt_select.php";
		}
		
		function wpsf_tax_cb(){
			include "html/taxonomy_select.php";
		}
		
		function wpsf_cmf_cb(){
			include "html/cmf_select.php";
		}
		
		function wpsf_mis_cb(){
			include "html/misc.php";
		}
		
		function adding_taxo_ajax(){
			include "html/add_taxo_ajax.php";
		}
		
		function adding_cmf_ajax(){
			include "html/add_cmf_ajax.php";
		}
		
		function wqsf_db_vd($input){// validation goes here
			$output = array(); 
				if(isset($input['cpt'])){
				$output['cpt'] = $input['cpt'];}
				if(isset($input['tax']['rel'])){
				$output['tax']['rel']=  strip_tags( stripslashes($input['tax']['rel']));}
				if(isset($input['taxo'])){
				$c = 0;
				foreach($input['taxo'] as $v){
						$output['taxo'][$c ]['taxname'] = strip_tags( stripslashes($v['taxname']));
						$output['taxo'][$c ]['taxlabel'] = strip_tags( stripslashes($v['taxlabel']));
						$output['taxo'][$c ]['taxall'] = strip_tags( stripslashes($v['taxall']));
						$output['taxo'][$c ]['hide'] = strip_tags( stripslashes($v['hide']));
						$c++;
				}
			}
				if(isset($input['cmft']['rel'])){
				$output['cmft']['rel']=  wp_filter_nohtml_kses($input['cmft']['rel']);}
			
				if(isset($input['cmf'])){
				$i=0;
				foreach($input['cmf'] as $v){
						$output['cmf'][$i ]['metakey'] = strip_tags( stripslashes($v['metakey']));
						$output['cmf'][$i ]['label'] = strip_tags( stripslashes($v['label']));
						$output['cmf'][$i ]['all'] = strip_tags( stripslashes($v['all']));
						$output['cmf'][$i ]['compare'] = wp_filter_nohtml_kses( stripslashes($v['compare']));
						$output['cmf'][$i ]['opt'] = strip_tags( stripslashes($v['opt']));
						$i++;
				}
		     	}
		     	if(isset($input['string'])){
				$output['string']['enable']=  strip_tags( stripslashes($input['string']['enable']));
				$output['string']['label']=  strip_tags( stripslashes($input['string']['label']));}
				if(isset($input['order'])){
				$output['order']['meta']=  strip_tags( stripslashes($input['order']['meta']));
				$output['order']['value']=  strip_tags( stripslashes($input['order']['value']));
				$output['order']['sort']=  strip_tags( stripslashes($input['order']['sort']));
				$output['order']['number']=  strip_tags( stripslashes($input['order']['number']));}
				
			
			return $output;
		}	
		
		function wqsfWidget(){
			require_once('wqsf-widget.php'); // Include the widget file
			register_widget('WqsfWidget'); // Register the widget 'B2TemplateWidget' is the class name of the widget.
	
		}
		
		function wqsf_register_shortcodes(){
			add_shortcode('wqsf-searchform', array($this, 'wqsf_sf_shortcode'));
		}
		
		function wqsf_sf_shortcode(){
			?>
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
		}
		
		
	
	}//end class
}//end if class exists
global $wqsf;
$wqsf = new wqsf();
