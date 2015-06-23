<?php
/*
Plugin Name: dpabottomofpostpage
Plugin URI: https://www.dpabadbot.com/customise-wordpress-plugin-to-add-messages-ads-bottom-of-post.php
Description: Add some messages to the bottom of each post or page. Very useful if you have several messages like copyright notice, Google Ads, other affliate advertisements, ads and Facebook, Google+ & Twitter Like and Share Buttons... There is no limit as to how many messages you have at the bottom of your posts or pages. You can have different messages for posts and for pages. Now understands that you can fine tune your webpage for SEO and the messages can affect your SEO. Your messages can be saved elsewhere so that they do not affect your page SEO. Just click on "Affects SEO" radio button and set the width and height of message.You can show post messages in Home, Category & Archives summary pages. Now can stop displaying messages in some posts and some pages. 
Version: 1.10 [20150623]  
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

function spmy_bottom_trash_posts( $post_id ){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;
echo '<br>Deleting post in bottom of post data';
$spmybp_datadir = dirname(__FILE__) ;
$spmybp_string_position = strpos( $spmybp_datadir , 'dpabottomofpostpage');
$spmybp_datadiralt = substr_replace( $spmybp_datadir , 'dpabottomofpostpagedata' , $spmybp_string_position  );
$spmybp_setup_file = $spmybp_datadiralt ."/setup.txt";
$spmybp_published_posts_file = $spmybp_datadiralt ."/publishedposts.txt";
$spmybp_published_pages_file = $spmybp_datadiralt ."/publishedpages.txt";
//posts settings

//check number of posts
$spmybp_bottom_post_count = wp_count_posts();
$iz = 0 ;
foreach ($spmybp_bottom_post_count as $key => $value) {
	$spmybp_bottom_post_nos[$key] = $value ;
	$iz++;
}	

$spmybp_bottom_post_count = NULL;
unset( $spmybp_bottom_post_count ); //clear memory

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmybp_bottom_post_nos['publish'] );
$spmybp_postslist = get_posts( $args );
$spmybp_postslist_sz = count( $spmybp_postslist );
foreach( $spmybp_postslist as $post ) {
       setup_postdata($post); 
	   $spmybp_file_listPM = get_permalink();
	   $spmybp_pos = strrpos( $spmybp_file_listPM, '/' );
	   $spmybp_myfilename = substr($spmybp_file_listPM, 0, $spmybp_pos );
	   $spmybp_pos = strrpos( $spmybp_myfilename, '/' );
	   $spmybp_myfilename = substr($spmybp_myfilename, ($spmybp_pos+1) );
	   $spmybp_file_listPM = $spmybp_myfilename ;
		$spmybp_pplist[$spmybp_file_listPM] = 'Checked';
	}
wp_reset_postdata();	
//save table
$spmybp_tmpstr = serialize( $spmybp_pplist ) ;
spmy_bowpp_write_file( $spmybp_published_posts_file, $spmybp_tmpstr );
//}

}

function spmy_bottom_saved_posts( $post_id ){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;
//define the filename of setup file; 
//$spmybp_setup_file = dirname(__FILE__) ."/setup.txt";
//$spmybp_published_posts_file = dirname(__FILE__) ."/publishedposts.txt";
//$spmybp_published_pages_file = dirname(__FILE__) ."/publishedpages.txt";
$spmybp_datadir = dirname(__FILE__) ;
$spmybp_string_position = strpos( $spmybp_datadir , 'dpabottomofpostpage');
$spmybp_datadiralt = substr_replace( $spmybp_datadir , 'dpabottomofpostpagedata' , $spmybp_string_position  );
$spmybp_setup_file = $spmybp_datadiralt ."/setup.txt";
$spmybp_published_posts_file = $spmybp_datadiralt ."/publishedposts.txt";
$spmybp_published_pages_file = $spmybp_datadiralt ."/publishedpages.txt";
//posts settings

if( file_exists( $spmybp_published_posts_file ) && filesize( $spmybp_published_posts_file ) > 6 ){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_posts_file );
$spmybp_pplist = unserialize( $spmybp_tmpstr );
}

//check number of posts
$spmybp_bottom_post_count = wp_count_posts();
$iz = 0 ;
foreach ($spmybp_bottom_post_count as $key => $value) {
	$spmybp_bottom_post_nos[$key] = $value ;
	$iz++;
}	

$spmybp_bottom_post_count = NULL;
unset( $spmybp_bottom_post_count ); //clear memory

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmybp_bottom_post_nos['publish'] );
$spmybp_postslist = get_posts( $args );
$spmybp_postslist_sz = count( $spmybp_postslist );
foreach( $spmybp_postslist as $post ) {
       setup_postdata($post); 
	   $spmybp_file_listPM = get_permalink();
	   $spmybp_pos = strrpos( $spmybp_file_listPM, '/' );
	   $spmybp_myfilename = substr($spmybp_file_listPM, 0, $spmybp_pos );
	   $spmybp_pos = strrpos( $spmybp_myfilename, '/' );
	   $spmybp_myfilename = substr($spmybp_myfilename, ($spmybp_pos+1) );
	   $spmybp_file_listPM = $spmybp_myfilename ;
		$spmybp_pplist[$spmybp_file_listPM] = 'Checked';
	}
wp_reset_postdata();	
//save table
$spmybp_tmpstr = serialize( $spmybp_pplist ) ;
spmy_bowpp_write_file( $spmybp_published_posts_file, $spmybp_tmpstr );
//}


//pages settings
if( file_exists( $spmybp_published_pages_file ) && filesize( $spmybp_published_pages_file ) > 6 ){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_pages_file );
$spmybp_ppplist = '';
$spmybp_ppplist = unserialize( $spmybp_tmpstr );
}
$args = array(  'post_type' => 'page' );
$spmybp_pageslist = get_pages( $args );
$spmybp_pageslist_sz = count( $spmybp_pageslist );

$spmybp_i =0;
$spmybp_imax = 0 ;
if( count($spmybp_ppplist) != $spmybp_pageslist_sz ){
$spmybp_file_listPP ='';
unset( $spmybp_file_listPP );
foreach( $spmybp_pageslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmybp_file_listPP[ $spmybp_i ] = get_permalink();
//	   echo '<br>Y. count : '.$spmybp_i.'  : '.$spmybp_file_list[ $spmybp_i ].'  ';
	   $spmybp_pos = strrpos( $spmybp_file_listPP[ $spmybp_i ], '/' );
	   $spmybp_myfilename = substr($spmybp_file_listPP[ $spmybp_i ], 0, $spmybp_pos );
	   $spmybp_pos = strrpos( $spmybp_myfilename, '/' );
	   $spmybp_myfilename = substr($spmybp_myfilename, ($spmybp_pos+1) );
	   $spmybp_file_listPP[ $spmybp_i ] = $spmybp_myfilename ;
	   $spmybp_i++;
	  }
	$spmybp_imax = $spmybp_i;
	$spmybp_file_listX = NULL;
	unset( $spmybp_file_listX );	
	$spmybp_file_listX = $spmybp_ppplist; 
	$spmybp_ppplist = NULL;
	unset( $spmybp_ppplist );
	
	for( $spmybp_i=0; $spmybp_i<$spmybp_imax; $spmybp_i++){
	if( !isset( $spmybp_file_listX[ $spmybp_file_listPP[ $spmybp_i ] ] ) ) { 
		$spmybp_ppplist[ $spmybp_file_listPP[ $spmybp_i ] ] = 'Checked';
		} else {
		$spmybp_ppplist[ $spmybp_file_listPP[ $spmybp_i ] ]= $spmybp_file_listX[ $spmybp_file_listPP[ $spmybp_i ] ];
			}
	}
wp_reset_postdata();
//save table
$spmybp_tmpstr = serialize( $spmybp_ppplist ) ;
spmy_bowpp_write_file( $spmybp_published_pages_file, $spmybp_tmpstr );
}

$spmybp_file_listX = NULL;
unset( $spmybp_file_listX );	
$spmybp_ppplist = NULL;
unset( $spmybp_ppplist );
$spmybp_pplist =NULL;
unset( $spmybp_pplist );
$spmybp_file_listPP = NULL;
unset( $spmybp_file_listPP );
$spmybp_file_list = NULL;
unset( $spmybp_file_list );
$spmybp_postslist = NULL;
unset( $spmybp_postslist );
$spmybp_pageslist = NULL;
unset( $spmybp_pageslist );
}





//declare the function
if( !function_exists( 'dpabottomofpostpage' )){
	function dpabottomofpostpage($content){
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post;	

//define the filename of setup file; 
//$spmybp_setup_file = dirname(__FILE__) ."/setup.txt";
//$spmybp_setup_seopost_file = dirname(__FILE__) ."/seopost.txt";
//$spmybp_setup_seopage_file = dirname(__FILE__) ."/seopage.txt";
//$spmybp_published_posts_file = dirname(__FILE__) ."/publishedposts.txt";
//$spmybp_published_pages_file = dirname(__FILE__) ."/publishedpages.txt";
$spmybp_datadir = dirname(__FILE__) ;
$spmybp_string_position = strpos( $spmybp_datadir , 'dpabottomofpostpage');
$spmybp_datadiralt = substr_replace( $spmybp_datadir , 'dpabottomofpostpagedata' , $spmybp_string_position  );
$spmybp_setup_file = $spmybp_datadiralt ."/setup.txt";
$spmybp_setup_seopost_file = $spmybp_datadiralt ."/seopost.txt";
$spmybp_setup_seopage_file = $spmybp_datadiralt ."/seopage.txt";
$spmybp_published_posts_file = $spmybp_datadiralt ."/publishedposts.txt";
$spmybp_published_pages_file = $spmybp_datadiralt ."/publishedpages.txt";

$spmybp_tmpstr = '';
$spmybp_counter = 0;
$spmybp_page_counter = 0;
$spmybp_msg  = '';
unset( $spmybp_msg );
$spmybp_filename = '';
unset( $spmybp_filename );
$spmybp_page_msg = '';
unset( $spmybp_page_msg );
$spmybp_page_filename = '';
unset( $spmybp_page_filename );

clearstatcache();
$spmybp_pplistflag = 'NoFile';
if( file_exists( $spmybp_published_posts_file ) && filesize( $spmybp_published_posts_file ) > 6 ){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_posts_file );
$spmybp_pplist = unserialize( $spmybp_tmpstr );

$spmybp_pplistflag = 'FileExist';
}
//pages settings
$spmybp_ppplistflag = 'NoFile';
if( file_exists( $spmybp_published_pages_file ) && filesize( $spmybp_published_pages_file ) > 6 ){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_pages_file );
$spmybp_ppplist = '';
$spmybp_ppplist = unserialize( $spmybp_tmpstr );
$spmybp_ppplistflag = 'FileExist';
}

for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){
$spmybp_page_msg[ $spmybp_i ] = '';
//$spmybp_page_filename[ $spmybp_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmybp_i.'.txt';
//$spmybp_page_filename_html[ $spmybp_i ] = dirname(__FILE__) .'/seopagemsg'.$spmybp_i.'.html';
$spmybp_page_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotpagemsg'.$spmybp_i.'.txt';
$spmybp_page_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopagemsg'.$spmybp_i.'.html';
//echo '<br>A. cnt: '.$spmybp_i.'  filename: '.$spmybp_page_filename_html[ $spmybp_i ].'  ';
}


//if the setup file exists go read the contents
if( file_exists( $spmybp_setup_file ) ) {
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_file );
}

if( strlen( $spmybp_tmpstr ) > 2 ){
$spmybp_data_str = unserialize( $spmybp_tmpstr);
$spmybp_counter = $spmybp_data_str[0];
$spmybp_page_counter = $spmybp_data_str[1];
$spmybp_posts = $spmybp_data_str[2] ;
$spmybp_pages = $spmybp_data_str[3] ;
}

//$spmybp_permalink = get_permalink();
//echo '<br>permalink : '.$spmybp_permalink.' ';
//$spmybp_tmpstrx = '';
//echo '<br>is_single(): '.is_single().' is_archive(): '.is_archive().' is_category(): '.is_category().' is_home(): '.is_home().' $spmybp_posts: '.$spmybp_posts.' $spmybp_counter: '.$spmybp_counter.' ';
$spmybp_tmpstrx = '';
wp_reset_query();

	if( (is_single() || is_archive()  || is_category() || is_home()) && $spmybp_posts == 'DISPLAY' && $spmybp_counter > 0)  {
		$spmybp_permalink = get_permalink();
//		echo '<br>1. permalink: '.$spmybp_permalink.' ';
		$spmybp_pos = strrpos( $spmybp_permalink, '/' );
	   $spmybp_myfilename = substr($spmybp_permalink, 0, $spmybp_pos );
	   $spmybp_pos = strrpos( $spmybp_myfilename, '/' );
	   $spmybp_permalinkfilename = substr($spmybp_myfilename, ($spmybp_pos+1) );

	   if( isset($spmybp_pplist[$spmybp_permalinkfilename]) && $spmybp_pplist[$spmybp_permalinkfilename] == 'Checked' ) {	   
		//if something to be displayed the get files and display
		//initialise variables

		//check if message Affects SEO
		if( file_exists( $spmybp_setup_seopost_file ) ) {
		//initialise variables
			$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_seopost_file );
			$spmybp_post_SEO = unserialize( $spmybp_tmpstr);
			}
		for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++){
			$spmybp_msg[ $spmybp_i ] = '';

			$spmybp_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotmsg'.$spmybp_i.'.txt';
			$spmybp_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopostmsg'.$spmybp_i.'.html';			
			}
		
		for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++){ //don't overload CPU, run this code here
		if( $spmybp_post_SEO[$spmybp_i][0] == 'SEO' ){
		if( file_exists( $spmybp_filename_html[ $spmybp_i ] ) && filesize( $spmybp_filename_html[ $spmybp_i ] ) > 0 ){
				$spmybp_msg[ $spmybp_i ] = base64_decode( $spmybp_post_SEO[$spmybp_i][3] ) ;
			}
		} else {
		if( file_exists( $spmybp_filename[ $spmybp_i ] ) && filesize( $spmybp_filename[ $spmybp_i ] ) > 0 ){
				$spmybp_msg[ $spmybp_i ] = spmy_bowpp_read_file( $spmybp_filename[ $spmybp_i] );
			}
		}
			
		}
 		$spmybp_tmpstrx = '';  //display
		for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++){	
			//is_single() || is_archive()  || is_category() || is_home()
			if( is_single() ) {
				$spmybp_tmpstrx = $spmybp_tmpstrx.$spmybp_msg[ $spmybp_i ];	
			} else if( is_home() && $spmybp_post_SEO[$spmybp_i][4] == 'HOME'  ) {
				$spmybp_tmpstrx = $spmybp_tmpstrx.$spmybp_msg[ $spmybp_i ];	
			} 
			else if( (is_category() ) && $spmybp_post_SEO[$spmybp_i][5] == 'CAT'  ) {
				$spmybp_tmpstrx = $spmybp_tmpstrx.$spmybp_msg[ $spmybp_i ];	
			} else if( (is_archive() && !is_category() ) && $spmybp_post_SEO[$spmybp_i][6] == 'ARC'  ) {
				$spmybp_tmpstrx = $spmybp_tmpstrx.$spmybp_msg[ $spmybp_i ];		
			}
		}
			
		} 	
	} 



	if( (is_page()  && $spmybp_pages == 'DISPLAY' && $spmybp_page_counter > 0) ) { 
		//if something to be displayed the get files and display
		//initialise variables
		$spmybp_permalink = get_permalink();
		$spmybp_pos = strrpos( $spmybp_permalink, '/' );
	   $spmybp_myfilename = substr($spmybp_permalink, 0, $spmybp_pos );
	   $spmybp_pos = strrpos( $spmybp_myfilename, '/' );
	   $spmybp_permalinkfilename = substr($spmybp_myfilename, ($spmybp_pos+1) );
		if( $spmybp_ppplist[$spmybp_permalinkfilename] == 'Checked' ) {
		//check is message Affects SEO
		if( file_exists( $spmybp_setup_seopage_file ) ) {
			$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_seopage_file );
			$spmybp_page_SEO = unserialize( $spmybp_tmpstr);
			}		
		for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){
			$spmybp_page_msg[ $spmybp_i ] = '';
			$spmybp_page_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotpagemsg'.$spmybp_i.'.txt';
			$spmybp_page_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopagemsg'.$spmybp_i.'.html';			
			}
		
		for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){ //don't overload CPU, run this code here

		if( $spmybp_page_SEO[$spmybp_i][0] == 'NOT SEO' ){
		if( file_exists( $spmybp_page_filename[ $spmybp_i ] ) && filesize( $spmybp_page_filename[ $spmybp_i ] ) > 0 ){
			$spmybp_page_msg[ $spmybp_i ] = spmy_bowpp_read_file( $spmybp_page_filename[ $spmybp_i] );
			}
		}	else if( $spmybp_page_SEO[$spmybp_i][0] == 'SEO' ){
				if( file_exists( $spmybp_page_filename_html[ $spmybp_i ] ) && filesize( $spmybp_page_filename_html[ $spmybp_i ] ) > 0 ){
					$spmybp_page_msg[ $spmybp_i ] = base64_decode( $spmybp_page_SEO[$spmybp_i][3] ) ;
					}
			}
		}
		$spmybp_tmpstrx = ''; //display
		for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){	
			$spmybp_tmpstrx = $spmybp_tmpstrx.$spmybp_page_msg[ $spmybp_i ];			
			} 
		}
	} 	

return $content.stripslashes($spmybp_tmpstrx);
}


if ( is_admin() ){	
	add_action( 'save_post', 'spmy_bottom_saved_posts' );	//update & preview = /../../autosave
	add_action( 'post_updated', 'spmy_bottom_saved_posts' ); //preview changes	& update posts	
	add_action( 'edit_post', 'spmy_bottom_saved_posts' );	//preview changes
	add_action( 'publish_post', 'spmy_bottom_saved_posts' );	//update post
	add_action( 'pre_post_update', 'spmy_bottom_saved_posts' );	//check through pre update
	add_action( 'trash_post', 'spmy_bottom_trash_posts' );
	if( function_exists( 'spmy_bowpp_actions')) {
		add_action('admin_menu', 'spmy_bowpp_actions');
		}
	}
	/*	add our filter function to the hook */
	add_filter('the_content', 'dpabottomofpostpage');
	
}

?>