<?php
/*
Plugin Name: dpabottomofpostpage
Plugin URI: https://www.dpabadbot.com/customise-wordpress-plugin-to-add-messages-ads-bottom-of-post.php
Description: Add some messages to the bottom of each post or page. Very useful if you have several messages like copyright notice, Google Ads, other affliate advertisements and Facebook, Google+ & Twitter Like and Share Buttons... There is no limit as to how many messages you have at the bottom of your posts or pages. You can have different messages for posts and for pages. With version 1.01 you can save your messages elsewhere so that they do not affect your page SEO. Just click on "Affects SEO" radio button and set the width and height of message.
Version: 1.01
Author: Dr. Peter Achutha
Author URI: http://facebook/peter.achutha
License: GPL2
*/

/*
	avoid a name collision, make sure this function is not
	already defined */
defined('ABSPATH') or die("No script kiddies please!");


function spmy_bowpp_addform(){
include('setup_form.php');
}


function spmy_bowpp_actions() {
add_options_page("dpabottomofpostpage", "dpaBottomOfPostPageMenu", 'administrator', "dpaBottomOfPostPage_Menu", "spmy_bowpp_addform"); 
}

 
function spmy_bowpp_read_file( $f ){
$tmpstr = '';
if( file_exists( $f ) ){
	$fh = fopen( $f, 'r');
	$tmpstr = fread( $fh, filesize( $f ) );
	fclose( $fh );
	}
return( $tmpstr );
}

function spmy_bowpp_write_file( $f, $d ){
$fh = fopen( $f, 'w' );
fwrite( $fh, $d, strlen( $d ) );
fflush( $fh );
fclose( $fh );
}



//declare the function
if( !function_exists( 'dpabottomofpostpage' )){
	function dpabottomofpostpage($content){
	
//define the filename of setup file; 
$spmy_setup_file = dirname(__FILE__) ."/setup.txt";
$spmy_setup_seopost_file = dirname(__FILE__) ."/seopost.txt";
$spmy_setup_seopage_file = dirname(__FILE__) ."/seopage.txt";
$spmy_tmpstr = '';
$spmy_counter = 0;
unset( $spmy_msg );
unset( $spmy_filename );
$spmy_page_counter = 0;
unset( $spmy_page_msg );
unset( $spmy_page_filename );


for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){
$spmy_page_msg[ $spmy_i ] = '';
$spmy_page_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmy_i.'.txt';
$spmy_page_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopagemsg'.$spmy_i.'.html';
}


//if the setup file exists go read the contents
if( file_exists( $spmy_setup_file ) ) {
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_setup_file );
}

if( strlen( $spmy_tmpstr ) > 2 ){
$spmy_data_str = unserialize( $spmy_tmpstr);
$spmy_counter = $spmy_data_str[0];
$spmy_page_counter = $spmy_data_str[1];
$spmy_posts = $spmy_data_str[2] ;
$spmy_pages = $spmy_data_str[3] ;
}

	

	if( is_single() && $spmy_posts == 'DISPLAY' && $spmy_counter > 0){
		//if something to be displayed the get files and display
		//initialise variables
		
		
		//check if message Affects SEO
		if( file_exists( $spmy_setup_seopost_file ) ) {
		//initialise variables
			$spmy_tmpstr = spmy_bowpp_read_file( $spmy_setup_seopost_file );
			$spmy_post_SEO = unserialize( $spmy_tmpstr);
			}
		for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++){
			$spmy_msg[ $spmy_i ] = '';
			$spmy_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotmsg'.$spmy_i.'.txt';
			$spmy_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopostmsg'.$spmy_i.'.html';
			}
		
		for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++){ //don't overload CPU, run this code here

//		$spmy_msg[ $spmy_i ] = '';
//		$spmy_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotmsg'.$spmy_i.'.txt';
		
		if( $spmy_post_SEO[$spmy_i][0] == 'NOT SEO' ){
		if( file_exists( $spmy_filename[ $spmy_i ] ) && filesize( $spmy_filename[ $spmy_i ] ) > 0 ){
				$spmy_msg[ $spmy_i ] = spmy_bowpp_read_file( $spmy_filename[ $spmy_i] );
			}
		} else if( $spmy_post_SEO[$spmy_i][0] == 'SEO' ){
		if( file_exists( $spmy_filename_html[ $spmy_i ] ) && filesize( $spmy_filename_html[ $spmy_i ] ) > 0 ){
		        //$spmy_tmpstr = spmy_bowpp_read_file( $spmy_page_filename_html[ $spmy_i] );
				$spmy_msg[ $spmy_i ] = $spmy_post_SEO[$spmy_i][3] ;
			}
		}
			
		}
 		$spmy_tmpstrx = '';  //display
		for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++){	
//			$spmy_tmpstrx = $spmy_tmpstrx.stripslashes($spmy_msg[ $spmy_i ]);
			$spmy_tmpstrx = $spmy_tmpstrx.$spmy_msg[ $spmy_i ];			
			} 
	} 	

	if( is_page()  && $spmy_pages == 'DISPLAY' && $spmy_page_counter > 0){ 
		//if something to be displayed the get files and display
		//initialise variables
		
		//check is message Affects SEO
		if( file_exists( $spmy_setup_seopage_file ) ) {
			$spmy_tmpstr = spmy_bowpp_read_file( $spmy_setup_seopage_file );
			$spmy_page_SEO = unserialize( $spmy_tmpstr);
			}		
		for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){
			$spmy_page_msg[ $spmy_i ] = '';
			$spmy_page_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmy_i.'.txt';
			$spmy_page_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopagemsg'.$spmy_i.'.html';
			}
		
		for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){ //don't overload CPU, run this code here

//		$spmy_page_msg[ $spmy_i ] = '';
//		$spmy_page_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmy_i.'.txt';
		
		if( $spmy_page_SEO[$spmy_i][0] == 'NOT SEO' ){
		if( file_exists( $spmy_page_filename[ $spmy_i ] ) && filesize( $spmy_page_filename[ $spmy_i ] ) > 0 ){
			$spmy_page_msg[ $spmy_i ] = spmy_bowpp_read_file( $spmy_page_filename[ $spmy_i] );
			}
		}	else if( $spmy_page_SEO[$spmy_i][0] == 'SEO' ){
				if( file_exists( $spmy_page_filename_html[ $spmy_i ] ) && filesize( $spmy_page_filename_html[ $spmy_i ] ) > 0 ){
		        //$spmy_tmpstr = spmy_bowpp_read_file( $spmy_page_filename_html[ $spmy_i] );
				$spmy_page_msg[ $spmy_i ] = $spmy_page_SEO[$spmy_i][3] ;
			}
			}
		}
		$spmy_tmpstrx = ''; //display
		for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){	
			$spmy_tmpstrx = $spmy_tmpstrx.$spmy_page_msg[ $spmy_i ];			
			} 
	} 	
return $content.stripslashes($spmy_tmpstrx);
}

	/*	add our filter function to the hook */

	add_filter('the_content', 'dpabottomofpostpage');
	
	if ( is_admin() ){
	if( function_exists( 'spmy_bowpp_actions')) {
		add_action('admin_menu', 'spmy_bowpp_actions');
		}
	}
}

?>