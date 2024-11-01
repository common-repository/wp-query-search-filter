=== WP Query Search Filter ===
Contributors: TC.K
Donate link: http://9-sec.com/donation/
Tags: Search Filter, taxonoy, custom post type, custom meta field, taxonomy & meta field filter
Requires at least: 3.4
Tested up to: 3.4.2
Stable tag: 1.0.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WP Query Search Filter let you search through post type, taxonomy and meta field. 

== Description ==

WP_Query Search Filter let your user perform more precisely search by filtering the search through post type, taxonomy and meta field. Ideal for website that have multiple post types, taxonomies and meta fields, eg property website, product website etc.  

**Plugin Features:**

* Admin are free to choose whether the search go through post type, taxonomy, meta field or even all of them.
* Using wp search template to disply the result.
* Admin can define how many result per page.
* Admin can sorting the result page by meta key and meta value.
* Using widget or shorcode to display the search form.


If you have any problems with current plugin, please leave a
message on Forums Posts or goto [Here](http://9-sec.com/2012/10/wp-query-search-filter/).


== Installation ==

1. Upload `wp-query-search-filter` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Find WP Query Search Filter setting page under Settings Menu

== Frequently Asked Questions ==

= How can I styling the search form? =

You can simply refer the wqsf-style.css that come with the folder and alter it or override it at your theme css file.

= What if I want to display the search form in the template? =

Put this into `<?php echo do_shortcode("[wqsf-searchform]"); ?>` your template.




== Screenshots ==
1. WP Query Search Filter setting page 1
2. WP Query Search Filter setting page 2
3. WP Query Search Filter search form in the content and sidebar


== Changelog ==


= 1.0 =
* First version.

= 1.0.1 =
* Fix search redirect error.

= 1.0.2 =
* Fix header sent error.

= 1.0.3 =
* Fix custom meta field search error.

= 1.0.4 =
* Fix shortcode form error.

= 1.0.5 =
* Fix number compare error.

= 1.0.6 =
* Fix number compare '>=' error.

= 1.0.7 =
* Fix number compare '>=' error again.
