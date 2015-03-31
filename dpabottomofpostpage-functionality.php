<?php
/*
Plugin Name: dpabottomofpostpage
Plugin URI: https://www.dpabadbot.com/customise-wordpress-plugin-to-add-messages-ads-bottom-of-post.php
Description: Add some messages to the bottom of each post or page. Very useful if you have several messages like copyright notice, Google Ads, other affliate advertisements, ads and Facebook, Google+ & Twitter Like and Share Buttons... There is no limit as to how many messages you have at the bottom of your posts or pages. You can have different messages for posts and for pages. Now understands that you can fine tune your webpage for SEO and the messages can affect your SEO. Your messages can be saved elsewhere so that they do not affect your page SEO. Just click on "Affects SEO" radio button and set the width and height of message.You can show post messages in Home, Category & Archives summary pages. Now can stop displaying messages in some posts and some pages. 
Version: 1.07 [20150401]  
Author: Dr. Peter Achutha
Author URI: http://facebook/peter.achutha
License: GPL2
*/

/*
	avoid a name collision, make sure this function is not
	already defined */
defined('ABSPATH') or die("No script kiddies please!");
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;

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

function spmy_bottom_saved_posts( $post_id ){
//define the filename of setup file; 
$spmy_setup_file = dirname(__FILE__) ."/setup.txt";
$spmy_published_posts_file = dirname(__FILE__) ."/publishedposts.txt";
$spmy_published_pages_file = dirname(__FILE__) ."/publishedpages.txt";
//posts settings

if( file_exists( $spmy_published_posts_file ) && filesize( $spmy_published_posts_file ) > 6 ){
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_published_posts_file );
$spmy_pplist = unserialize( $spmy_tmpstr );
}

//check number of posts
$spmy_bottom_post_count = wp_count_posts();
$iz = 0 ;
foreach ($spmy_bottom_post_count as $key => $value) {
	$spmy_bottom_post_nos[$key] = $value ;
	$iz++;
}	
$spmy_bottom_post_count = NULL;
unset( $spmy_bottom_post_count ); //clear memory

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmy_bottom_post_nos['publish'] );
$spmy_postslist = get_posts( $args );
$spmy_postslist_sz = count( $spmy_postslist );

$spmy_i =0;
$spmy_imax = 0 ;

//if( count($spmy_pplist) != $spmy_bottom_post_nos['publish'] ){
foreach( $spmy_postslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmy_file_list[ $spmy_i ] = get_permalink();
	   $spmy_pos = strrpos( $spmy_file_list[ $spmy_i ], '/' );
	   $spmy_myfilename = substr($spmy_file_list[ $spmy_i ], 0, $spmy_pos );
	   $spmy_pos = strrpos( $spmy_myfilename, '/' );
	   $spmy_myfilename = substr($spmy_myfilename, ($spmy_pos+1) );
	   $spmy_file_list[ $spmy_i ] = $spmy_myfilename ;
	   $spmy_i++;
	  }
	$spmy_imax = $spmy_i;
	$spmy_file_listX = NULL;
	unset( $spmy_file_listX );	
	$spmy_file_listX = $spmy_pplist; 
	$spmy_pplist = NULL;
	unset( $spmy_pplist );
	
	for( $spmy_i=0; $spmy_i<$spmy_imax; $spmy_i++){
	if( !isset( $spmy_file_listX[ $spmy_file_list[ $spmy_i ] ] ) ) { 
		$spmy_pplist[ $spmy_file_list[ $spmy_i ] ] = 'Checked';
		} else {
		$spmy_pplist[ $spmy_file_list[ $spmy_i ] ]= $spmy_file_listX[ $spmy_file_list[ $spmy_i ] ];
			}
	}
wp_reset_postdata();
//save table
$spmy_tmpstr = serialize( $spmy_pplist ) ;
spmy_bowpp_write_file( $spmy_published_posts_file, $spmy_tmpstr );
//}


//pages settings
if( file_exists( $spmy_published_pages_file ) && filesize( $spmy_published_pages_file ) > 6 ){
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_published_pages_file );
$spmy_ppplist = '';
$spmy_ppplist = unserialize( $spmy_tmpstr );
}
$args = array(  'post_type' => 'page' );
$spmy_pageslist = get_pages( $args );
$spmy_pageslist_sz = count( $spmy_pageslist );

$spmy_i =0;
$spmy_imax = 0 ;
if( count($spmy_ppplist) != $spmy_pageslist_sz ){
$spmy_file_listPP ='';
unset( $spmy_file_listPP );
foreach( $spmy_pageslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmy_file_listPP[ $spmy_i ] = get_permalink();
	   $spmy_pos = strrpos( $spmy_file_listPP[ $spmy_i ], '/' );
	   $spmy_myfilename = substr($spmy_file_listPP[ $spmy_i ], 0, $spmy_pos );
	   $spmy_pos = strrpos( $spmy_myfilename, '/' );
	   $spmy_myfilename = substr($spmy_myfilename, ($spmy_pos+1) );
	   $spmy_file_listPP[ $spmy_i ] = $spmy_myfilename ;
	   $spmy_i++;
	  }
	$spmy_imax = $spmy_i;
	$spmy_file_listX = NULL;
	unset( $spmy_file_listX );	
	$spmy_file_listX = $spmy_ppplist; 
	$spmy_ppplist = NULL;
	unset( $spmy_ppplist );
	
	for( $spmy_i=0; $spmy_i<$spmy_imax; $spmy_i++){
	if( !isset( $spmy_file_listX[ $spmy_file_listPP[ $spmy_i ] ] ) ) { 
		$spmy_ppplist[ $spmy_file_listPP[ $spmy_i ] ] = 'Checked';
		} else {
		$spmy_ppplist[ $spmy_file_listPP[ $spmy_i ] ]= $spmy_file_listX[ $spmy_file_listPP[ $spmy_i ] ];
			}
	}
wp_reset_postdata();
//save table
$spmy_tmpstr = serialize( $spmy_ppplist ) ;
spmy_bowpp_write_file( $spmy_published_pages_file, $spmy_tmpstr );
}

$spmy_file_listX = NULL;
unset( $spmy_file_listX );	
$spmy_ppplist = NULL;
unset( $spmy_ppplist );
$spmy_pplist =NULL;
unset( $spmy_pplist );
$spmy_file_listPP = NULL;
unset( $spmy_file_listPP );
$spmy_file_list = NULL;
unset( $spmy_file_list );
$spmy_postslist = NULL;
unset( $spmy_postslist );
$spmy_pageslist = NULL;
unset( $spmy_pageslist );
}





//declare the function
if( !function_exists( 'dpabottomofpostpage' )){
	function dpabottomofpostpage($content){
	
//define the filename of setup file; 
$spmy_setup_file = dirname(__FILE__) ."/setup.txt";
$spmy_setup_seopost_file = dirname(__FILE__) ."/seopost.txt";
$spmy_setup_seopage_file = dirname(__FILE__) ."/seopage.txt";
$spmy_published_posts_file = dirname(__FILE__) ."/publishedposts.txt";
$spmy_published_pages_file = dirname(__FILE__) ."/publishedpages.txt";

$spmy_tmpstr = '';
$spmy_counter = 0;
$spmy_page_counter = 0;
$spmy_msg  = '';
unset( $spmy_msg );
$spmy_filename = '';
unset( $spmy_filename );
$spmy_page_msg = '';
unset( $spmy_page_msg );
$spmy_page_filename = '';
unset( $spmy_page_filename );

clearstatcache();
$spmy_pplistflag = 'NoFile';
if( file_exists( $spmy_published_posts_file ) && filesize( $spmy_published_posts_file ) > 6 ){
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_published_posts_file );
$spmy_pplist = unserialize( $spmy_tmpstr );

$spmy_pplistflag = 'FileExist';
}
//pages settings
$spmy_ppplistflag = 'NoFile';
if( file_exists( $spmy_published_pages_file ) && filesize( $spmy_published_pages_file ) > 6 ){
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_published_pages_file );
$spmy_ppplist = '';
$spmy_ppplist = unserialize( $spmy_tmpstr );
$spmy_ppplistflag = 'FileExist';
}

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

//$spmy_permalink = get_permalink();
//echo '<br>permalink : '.$spmy_permalink.' ';
//$spmy_tmpstrx = '';
//echo '<br>is_single(): '.is_single().' is_archive(): '.is_archive().' is_category(): '.is_category().' is_home(): '.is_home().' $spmy_posts: '.$spmy_posts.' $spmy_counter: '.$spmy_counter.' ';
$spmy_tmpstrx = '';
	if( (is_single() || is_archive()  || is_category() || is_home()) && $spmy_posts == 'DISPLAY' && $spmy_counter > 0)  {
		$spmy_permalink = get_permalink();
		//echo '<br>1. permalink: '.$spmy_permalink.' ';
		$spmy_pos = strrpos( $spmy_permalink, '/' );
	   $spmy_myfilename = substr($spmy_permalink, 0, $spmy_pos );
	   $spmy_pos = strrpos( $spmy_myfilename, '/' );
	   $spmy_permalinkfilename = substr($spmy_myfilename, ($spmy_pos+1) );
		//echo '<br>2. permalinkfilename: '.$spmy_permalinkfilename.' ';
		//echo '<br>pplist<br>';
		//var_dump( $spmy_pplist );
		//echo '<br><br>';
	   if( $spmy_pplist[$spmy_permalinkfilename] == 'Checked' ) {	   
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
		
		if( $spmy_post_SEO[$spmy_i][0] == 'NOT SEO' ){
		if( file_exists( $spmy_filename[ $spmy_i ] ) && filesize( $spmy_filename[ $spmy_i ] ) > 0 ){
				$spmy_msg[ $spmy_i ] = spmy_bowpp_read_file( $spmy_filename[ $spmy_i] );
			}
		} else if( $spmy_post_SEO[$spmy_i][0] == 'SEO' ){
		if( file_exists( $spmy_filename_html[ $spmy_i ] ) && filesize( $spmy_filename_html[ $spmy_i ] ) > 0 ){
				$spmy_msg[ $spmy_i ] = base64_decode( $spmy_post_SEO[$spmy_i][3] ) ;
			}
		}
			
		}
 		$spmy_tmpstrx = '';  //display
		for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++){	
			//is_single() || is_archive()  || is_category() || is_home()
			if( is_single() ) {
				$spmy_tmpstrx = $spmy_tmpstrx.$spmy_msg[ $spmy_i ];			
			} else if( is_home() && $spmy_post_SEO[$spmy_i][4] == 'HOME'  ) {
				$spmy_tmpstrx = $spmy_tmpstrx.$spmy_msg[ $spmy_i ];			
			} else if( is_category() && $spmy_post_SEO[$spmy_i][5] == 'CAT'  ) {
				$spmy_tmpstrx = $spmy_tmpstrx.$spmy_msg[ $spmy_i ];			
			} else if( is_archive() && $spmy_post_SEO[$spmy_i][6] == 'ARC'  ) {
				$spmy_tmpstrx = $spmy_tmpstrx.$spmy_msg[ $spmy_i ];			
			}
		}
			
		} 	
	} 

	if( (is_page()  && $spmy_pages == 'DISPLAY' && $spmy_page_counter > 0) ) { 
		//if something to be displayed the get files and display
		//initialise variables
		$spmy_permalink = get_permalink();
		$spmy_pos = strrpos( $spmy_permalink, '/' );
	   $spmy_myfilename = substr($spmy_permalink, 0, $spmy_pos );
	   $spmy_pos = strrpos( $spmy_myfilename, '/' );
	   $spmy_permalinkfilename = substr($spmy_myfilename, ($spmy_pos+1) );
		if( $spmy_ppplist[$spmy_permalinkfilename] == 'Checked' ) {
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

		if( $spmy_page_SEO[$spmy_i][0] == 'NOT SEO' ){
		if( file_exists( $spmy_page_filename[ $spmy_i ] ) && filesize( $spmy_page_filename[ $spmy_i ] ) > 0 ){
			$spmy_page_msg[ $spmy_i ] = spmy_bowpp_read_file( $spmy_page_filename[ $spmy_i] );
			}
		}	else if( $spmy_page_SEO[$spmy_i][0] == 'SEO' ){
				if( file_exists( $spmy_page_filename_html[ $spmy_i ] ) && filesize( $spmy_page_filename_html[ $spmy_i ] ) > 0 ){
					$spmy_page_msg[ $spmy_i ] = base64_decode( $spmy_page_SEO[$spmy_i][3] ) ;
					}
			}
		}
		$spmy_tmpstrx = ''; //display
		for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){	
			$spmy_tmpstrx = $spmy_tmpstrx.$spmy_page_msg[ $spmy_i ];			
			} 
		}
	} 	

return $content.stripslashes($spmy_tmpstrx);
}

	/*	add our filter function to the hook */
	add_filter('the_content', 'dpabottomofpostpage');

	if ( is_admin() ){
	add_action( 'save_post', 'spmy_bottom_saved_posts' );	//update & preview = /../../autosave
	add_action( 'post_updated', 'spmy_bottom_saved_posts' ); //preview changes	& update posts	
	add_action( 'edit_post', 'spmy_bottom_saved_posts' );	//preview changes
	add_action( 'publish_post', 'spmy_bottom_saved_posts' );	//update post
	if( function_exists( 'spmy_bowpp_actions')) {
		add_action('admin_menu', 'spmy_bowpp_actions');
		}
	}
}

?>