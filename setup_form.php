<style type="text/css">
table.spmy_X { border:1px solid silver; border-radius: 5px;  border-collapse: collapse;  box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); color:darkred; font-family: Times Roman; font-size:16px}  
table.spmy_X td { padding: 1px; border: 2px solid gray; border-collapse: collapse;  background: white; color:darkblue; font-family: Times Roman; font-size:16px} 
table.spmy_X  th { padding: 1px; border: 2px solid gray; border-collapse: collapse; background: silver; color:darkblue; font-family: Times Roman; font-size:16px} 
table.myoptions { border:1px solid #901C1C; border-collapse: collapse; box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); border-radius: 5px; color:darkblue; font-family: Times Roman; font-size:14px}  
table.myoptions td, th {
    padding: 5px; 
}
 
div.mydisplay { &nbsp;
 color: #901C1C;  /*#000000; */
 font-family: Times Roman, Verdana, Arial, Helvetica, sans-serif; 
 font-size: 12px; 
 margin: 0px; 
 overflow: scroll; 
 padding: 1px; 
  border:1px solid #901C1C; 
  border-collapse: collapse; 
  border-radius: 5px; 
  box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.8); 
  color:darkblue; 
  font-family: Times Roman; 
  font-size:14px
 scrollbar-face-color: #cacaca; 
 scrollbar-highlight-color: #cacaca; 
 scrollbar-3dlight-color: #cacaca; 
 scrollbar-darkshadow-color: #cacaca; 
 scrollbar-shadow-color: #cacaca; 
 scrollbar-arrow-color: #000000; 
 scrollbar-track-color: #cacaca; 
 width: 820px; 
 height: 550px; 
}
</style>
<?php
defined('ABSPATH') or die("No script kiddies please!");
global $id, $authordata, $currentday, $currentmonth, $page, $pages, $multipage, $more, $numpages, $post, $_SERVER;
//define the filename of setup file; 
$spmybp_plugins_url = plugins_url().'/dpabottomofpostpage';


$samplemsg[0] = '<br><br><table><tr><td style="vertical-align: center;"><a style="text-decoration: none;" rel="author" href="https://plus.google.com/XXXXXXXXXXXXXXXXXXXX?rel=author"><img style="border: 0; width: 16px; height: 16px;" src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" /></a></td><td><span style="color: #000080;font-size:10px;">Copyright (c) 2013 - 2014 MY COMPANY - All Rights Reserved<br>
No. 1, Main Street, MyArea, MyTown, MyState, MYCountry<br></span></td></tr></table>';

$samplemsg[1] = '<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=368223343225209";
  fjs.parentNode.insertBefore(js, fjs);
}(document, '."'script'".', '."'facebook-jssdk'".'));</script>

<table>
<tr><td style="vertical-align:top;">
<a name="TellAFriend"><span style="color:green;font-size:18px;">Please Tell A Friend:</span> </td></tr>
<tr><td style="vertical-align:top;">
<div class="fb-like" data-href="" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-annotation="inline" data-width="250"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('."'script'".'); po.type = '."'text/javascript'".'; po.async = true;
    po.src = '."'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- Twitter tag button  -->".'	
    <a href="https://twitter.com/share" class="twitter-share-button" data-via="twitterapi" data-lang="en">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

</td></tr>
</table>';

$samplemsg[2] = '<table>
<tr><td style="color:green;font-size:10px;">Google Ads</td><tr>
<tr><td>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- BottomOfPage -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-XXXXXXXXXXXXXXXX"
     data-ad-slot="XXXXXXXXXX"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</td></tr>
</table>';


$samplemsg[3] = '<table>
<tr><td style="color:green;font-size:10px;">Other Advertisements</td><tr>
<tr><td>
<img alt="Insert Ads Here" src="'.$spmybp_plugins_url.'/advertspace.png'.'" width="728" height="90">
</td></tr>
</table>';

//echo '<br>dirname: '.dirname(__FILE__).' '; 
$spmybp_datadir = dirname(__FILE__) ;
$spmybp_string_position = strpos( $spmybp_datadir , 'dpabottomofpostpage');
$spmybp_datadiralt = substr_replace( $spmybp_datadir , 'dpabottomofpostpagedata' , $spmybp_string_position  );

$spmybp_setup_file_org = dirname(__FILE__) ."/setup.txt";
$spmybp_published_posts_file_org = dirname(__FILE__) ."/publishedposts.txt";
$spmybp_published_pages_file_org = dirname(__FILE__) ."/publishedpages.txt";
$spmybp_setup_seopost_file_org = dirname(__FILE__) ."/seopost.txt";
$spmybp_setup_seopage_file_org = dirname(__FILE__) ."/seopage.txt";
$spmybp_post_scroll_data_file_org = dirname(__FILE__) ."/scrollposts.txt";
$spmybp_page_scroll_data_file_org = dirname(__FILE__) ."/scrollpages.txt";


$spmybp_setup_file = $spmybp_datadiralt ."/setup.txt";
$spmybp_published_posts_file = $spmybp_datadiralt ."/publishedposts.txt";
$spmybp_published_pages_file = $spmybp_datadiralt ."/publishedpages.txt";
$spmybp_setup_seopost_file = $spmybp_datadiralt ."/seopost.txt";
$spmybp_setup_seopage_file = $spmybp_datadiralt ."/seopage.txt";
$spmybp_post_scroll_data_file = $spmybp_datadiralt ."/scrollposts.txt";
$spmybp_page_scroll_data_file = $spmybp_datadiralt ."/scrollpages.txt";

//echo '<br>$spmybp_setup_file : '.$spmybp_setup_file.'  ';
//echo '<br>$spmybp_published_posts_file : '.$spmybp_published_posts_file.'  ';
//echo '<br>$spmybp_published_pages_file : '.$spmybp_published_pages_file.'  ';
//echo '<br>$spmybp_setup_seopost_file : '.$spmybp_setup_seopost_file.'  ';
//echo '<br>$spmybp_setup_seopage_file : '.$spmybp_setup_seopage_file.'  ';
//echo '<br>$spmybp_post_scroll_data_file : '.$spmybp_post_scroll_data_file.'  ';
//echo '<br>$spmybp_page_scroll_data_file : '.$spmybp_page_scroll_data_file.'  ';

if( !file_exists($spmybp_datadiralt) ){
mkdir( $spmybp_datadiralt );
//echo '<br>made alt dir';
if( file_exists( $spmybp_setup_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_setup_file_org );
spmy_bowpp_write_file( $spmybp_setup_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_published_posts_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_published_posts_file_org );
spmy_bowpp_write_file( $spmybp_published_posts_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_published_pages_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_published_pages_file_org );
spmy_bowpp_write_file( $spmybp_published_pages_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_setup_seopost_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_setup_seopost_file_org );
spmy_bowpp_write_file( $spmybp_setup_seopost_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_setup_seopage_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_setup_seopage_file_org );
spmy_bowpp_write_file( $spmybp_setup_seopage_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_post_scroll_data_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_post_scroll_data_file_org );
spmy_bowpp_write_file( $spmybp_post_scroll_data_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_post_scroll_data_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_post_scroll_data_file_org );
spmy_bowpp_write_file( $spmybp_post_scroll_data_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_page_scroll_data_file_org) ) {
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_page_scroll_data_file_org );
spmy_bowpp_write_file( $spmybp_page_scroll_data_file, $spmybp_tempstr );
}
if( file_exists( $spmybp_setup_file ) ) {
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_file );
	if( strlen( $spmybp_tmpstr ) > 2 ){
	$spmybp_data_str = unserialize( $spmybp_tmpstr);
	$spmybp_counter = $spmybp_data_str[0];
	$spmybp_page_counter = $spmybp_data_str[1];
	$spmybp_posts = $spmybp_data_str[2];
	$spmybp_pages = $spmybp_data_str[3];
	}
}
for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++){
$spmybp_filename_tmp1 = dirname(__FILE__) .'/mybotmsg'.$spmybp_i.'.txt'; 
$spmybp_filename_tmp2 = $spmybp_datadiralt .'/mybotmsg'.$spmybp_i.'.txt';
if( file_exists($spmybp_filename_tmp1) ){
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_filename_tmp1 );
spmy_bowpp_write_file( $spmybp_filename_tmp2, $spmybp_tempstr );
}
$spmybp_filename_tmp_html1 = dirname(__FILE__) .'/seopostmsg'.$spmybp_i.'.html';
$spmybp_filename_tmp_html2 = $spmybp_datadiralt.'/seopostmsg'.$spmybp_i.'.html';
if( file_exists($spmybp_filename_tmp_html1) ){
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_filename_tmp_html1 );
spmy_bowpp_write_file( $spmybp_filename_tmp_html2, $spmybp_tempstr );
}
}
for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){
$spmybp_page_filename_tmp1 = dirname(__FILE__) .'/mybotpagemsg'.$spmybp_i.'.txt';
$spmybp_page_filename_tmp2 = $spmybp_datadiralt .'/mybotpagemsg'.$spmybp_i.'.txt';
if( file_exists($spmybp_page_filename_tmp1) ){
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_page_filename_tmp1 );
spmy_bowpp_write_file( $spmybp_page_filename_tmp2, $spmybp_tempstr );
}
$spmybp_page_filename_tmp_html1 = dirname(__FILE__) .'/seopagemsg'.$spmybp_i.'.html';
$spmybp_page_filename_tmp_html2 = $spmybp_datadiralt .'/seopagemsg'.$spmybp_i.'.html';
if( file_exists($spmybp_page_filename_tmp_html1) ){
$spmybp_tempstr = spmy_bowpp_read_file( $spmybp_page_filename_tmp_html1 );
spmy_bowpp_write_file( $spmybp_page_filename_tmp_html2, $spmybp_tempstr );
}
}

} 
//else {
//echo '<br>alt dir exists';
//}


$spmybp_tmpstr = '';
$spmybp_counter = 0;
$spmybp_page_counter = 0;
$spmybp_msg = '';
unset( $spmybp_msg );
$spmybp_filename = '';
unset( $spmybp_filename );
$spmybp_filename_html = '';
unset( $spmybp_filename_html );
$spmybp_page_msg = '';
unset( $spmybp_page_msg );
$spmybp_page_filename = '';
unset( $spmybp_page_filename );
$spmybp_page_filename = '';
unset( $spmybp_page_filename_html );
$spmybp_bottom_post_nos['publish'] = 0;
$spmybp_pplist = '';
$spmybp_ppplist = '';
$spmybp_pageslist = '';
$spmybp_post_offset = 0;

$spmybp_postslist_sz = 0;
$spmybp_pageslist_sz = 0;
//if the setup file exists go read the contents
//clearstatcache();
if( file_exists( $spmybp_setup_file ) ) {
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_file );
	if( strlen( $spmybp_tmpstr ) > 2 ){
	$spmybp_data_str = unserialize( $spmybp_tmpstr);
	$spmybp_counter = $spmybp_data_str[0];
	$spmybp_page_counter = $spmybp_data_str[1];
	$spmybp_posts = $spmybp_data_str[2];
	$spmybp_pages = $spmybp_data_str[3];
	}
} else {
	$spmybp_counter = 0; 
	$spmybp_data_str[0] = $spmybp_counter ; 
	$spmybp_page_counter = 0;
	$spmybp_data_str[1] = $spmybp_page_counter;
	$spmybp_posts = 'DONT';
	$spmybp_data_str[2] = $spmybp_posts;
	$spmybp_pages = 'DONT';
	$spmybp_data_str[3] = $spmybp_pages;
	$spmybp_tmpstr = serialize( $spmybp_data_str );	
	spmy_bowpp_write_file( $spmybp_setup_file, $spmybp_tmpstr );
}

//read in which post message affects SEO and should be in iframe
if( file_exists( $spmybp_setup_seopost_file )) {
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_seopost_file );

if( strlen( $spmybp_tmpstr ) > 2 ){
	$spmybp_post_SEO = unserialize( $spmybp_tmpstr);
	}
} else {
for( $spmybp_i=0; $spmybp_i<4; $spmybp_i++){
$spmybp_msg[ $spmybp_i ] = '';
$spmybp_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotmsg'.$spmybp_i.'.txt';
$spmybp_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopostmsg'.$spmybp_i.'.html';
$spmybp_post_SEO[$spmybp_i][0] = 'NOT SEO';
$spmybp_post_SEO[$spmybp_i][1] = 790; //width of message
$spmybp_post_SEO[$spmybp_i][2] = 140; //height message
$spmybp_post_SEO[$spmybp_i][3] = ''; //used base encode 64 of iframe code 
$spmybp_post_SEO[$spmybp_i][4] = ''; //Home summany page
$spmybp_post_SEO[$spmybp_i][5] = ''; //Category summary page
$spmybp_post_SEO[$spmybp_i][6] = ''; //Archive summary page
$spmybp_post_SEO[$spmybp_i][7] = ''; //Title of Message - so that you will remember what it is about months later
}
}
//read in which page message affects SEO and should be in iframe
if( file_exists( $spmybp_setup_seopage_file )){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_setup_seopage_file );
if( strlen( $spmybp_tmpstr ) > 2 ){
	$spmybp_page_SEO = unserialize( $spmybp_tmpstr);
	}
}  else {
for( $spmybp_i=0; $spmybp_i<4; $spmybp_i++){
$spmybp_msg[ $spmybp_i ] = '';
$spmybp_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotpagemsg'.$spmybp_i.'.txt';
$spmybp_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopagemsg'.$spmybp_i.'.html';
$spmybp_page_SEO[$spmybp_i][0] = 'NOT SEO';
$spmybp_page_SEO[$spmybp_i][1] = 790; //width of message
$spmybp_page_SEO[$spmybp_i][2] = 140; //height of message
$spmybp_page_SEO[$spmybp_i][3] = ''; //used base encode 64 of <iframe code >
$spmybp_page_SEO[$spmybp_i][4] = ''; //Home summany page
$spmybp_page_SEO[$spmybp_i][5] = ''; //Category summary page
$spmybp_page_SEO[$spmybp_i][6] = ''; //Archive summary page
$spmybp_page_SEO[$spmybp_i][7] = ''; //Title of Message - so that you will remember what it is months later
}
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


//posts settings
$spmybp_pplistflag = 'NoFile';
if( file_exists( $spmybp_published_posts_file ) && filesize( $spmybp_published_posts_file ) > 6 ){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_posts_file );
$spmybp_pplist = unserialize( $spmybp_tmpstr );
$spmybp_pplistflag = 'FileExist';
}

$args = array(  'post_status' => 'publish', 'posts_per_page' => $spmybp_bottom_post_nos['publish'] );
$spmybp_postslist = get_posts( $args );
$spmybp_postslist_sz = count( $spmybp_postslist );

$spmybp_i =0;
$spmybp_imax = 0 ;


foreach( $spmybp_postslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmybp_file_list[ $spmybp_i ] = get_permalink();
	   $spmybp_pos = strrpos( $spmybp_file_list[ $spmybp_i ], '/' );
	   $spmybp_myfilename = substr($spmybp_file_list[ $spmybp_i ], 0, $spmybp_pos );
	   $spmybp_pos = strrpos( $spmybp_myfilename, '/' );
	   $spmybp_myfilename = substr($spmybp_myfilename, ($spmybp_pos+1) );
	   $spmybp_file_list[ $spmybp_i ] = $spmybp_myfilename ;
	   $spmybp_i++;
	  }
	$spmybp_imax = $spmybp_i;
	$spmybp_file_listX = NULL;
	unset( $spmybp_file_listX );	
	$spmybp_file_listX = $spmybp_pplist; 
	$spmybp_pplist = NULL;
	unset( $spmybp_pplist );
	
	for( $spmybp_i=0; $spmybp_i<$spmybp_imax; $spmybp_i++){
	if( !isset( $spmybp_file_listX[ $spmybp_file_list[ $spmybp_i ] ] ) ) { 
		$spmybp_pplist[ $spmybp_file_list[ $spmybp_i ] ] = 'Checked';
		} else {
		$spmybp_pplist[ $spmybp_file_list[ $spmybp_i ] ]= $spmybp_file_listX[ $spmybp_file_list[ $spmybp_i ] ];
			}
	}
wp_reset_postdata();
//save table
$spmybp_tmpstr = serialize( $spmybp_pplist ) ;
spmy_bowpp_write_file( $spmybp_published_posts_file, $spmybp_tmpstr );



//pages settings
$spmybp_ppplistflag = 'NoFile';
if( file_exists( $spmybp_published_pages_file ) && filesize( $spmybp_published_pages_file ) > 6 ){
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_pages_file );
$spmybp_ppplist = '';
$spmybp_ppplist = unserialize( $spmybp_tmpstr );
$spmybp_ppplistflag = 'FileExist';
}
$args = array(  'post_type' => 'page' );
$spmybp_pageslist = get_pages( $args );
$spmybp_pageslist_sz = count( $spmybp_pageslist );

$spmybp_i =0;
$spmybp_imax = 0 ;

$spmybp_file_listPP ='';
unset( $spmybp_file_listPP );
foreach( $spmybp_pageslist as $key => $post ) { //get the permalink and strip '/'
       setup_postdata($post); 
	   $spmybp_file_listPP[ $spmybp_i ] = get_permalink();
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




if( isset( $_POST['spmy_diapla_all'] )  &&  $_POST['spmy_diapla_all'] == 'Display On All Posts' ){
	$spmybp_maxi = count( $spmybp_pplist );
	foreach( $spmybp_pplist as $key => &$value ){
		$spmybp_pplist[$key] = 'Checked';
	}
	$spmybp_tmpstr = serialize( $spmybp_pplist );	
	spmy_bowpp_write_file( $spmybp_published_posts_file, $spmybp_tmpstr );
}


if( isset( $_POST['spmy_check_posts'] )  &&  $_POST['spmy_check_posts'] == 'Change Post Display' ){
	$spmybp_maxi = count( $spmybp_pplist );
	foreach( $spmybp_pplist as $key => &$value ){
		if( isset($_POST['spmy_input_pplist'][$key]) && $_POST['spmy_input_pplist'][$key] != '' ){
		$spmybp_pplist[$key] = $_POST['spmy_input_pplist'][$key] ;
		} else {
		$spmybp_pplist[$key] = 'NotChecked';
		}
	}
	$spmybp_tmpstr = serialize( $spmybp_pplist );	
	spmy_bowpp_write_file( $spmybp_published_posts_file, $spmybp_tmpstr );
} 


if( isset( $_POST['spmy_diaplay_all'] )  &&  $_POST['spmy_diaplay_all'] == 'Display On All Pages' ){
	$spmybp_maxi = count( $spmybp_ppplist );
	foreach( $spmybp_ppplist as $key => &$value ){
		$spmybp_ppplist[$key] = 'Checked';
	}
	$spmybp_tmpstr = serialize( $spmybp_ppplist );	
	spmy_bowpp_write_file( $spmybp_published_pages_file, $spmybp_tmpstr );
}

if( isset( $_POST['spmy_check_pages'] )  &&  $_POST['spmy_check_pages'] == 'Change Page Display' ){
	$spmybp_maxi = count( $spmybp_ppplist );
	foreach( $spmybp_ppplist as $key => &$value ){
		if( isset($_POST['spmy_input_ppplist'][$key]) && $_POST['spmy_input_ppplist'][$key] != '' ){
		$spmybp_ppplist[$key] = $_POST['spmy_input_ppplist'][$key] ;
		} else {
		$spmybp_ppplist[$key] = 'NotChecked';
		}
	}
	$spmybp_tmpstr = serialize( $spmybp_ppplist );	
	spmy_bowpp_write_file( $spmybp_published_pages_file, $spmybp_tmpstr );
} 





if( isset( $_POST['spmy_type_of_display'] ) ){
if( $_POST['spmy_type_of_display'] == 'Set Display' ){
	if( isset( $_POST['spmy_display_posts'] ) ) {
	$spmybp_data_str[2] = $_POST['spmy_display_posts'];
	$spmybp_posts = $spmybp_data_str[2] ;
	}
	if( isset( $_POST['spmy_display_pages'] ) ) {
	$spmybp_data_str[3] = $_POST['spmy_display_pages'] ;
	$spmybp_pages = $spmybp_data_str[3] ;
	}
	$spmybp_tmpstr = serialize( $spmybp_data_str );	
	spmy_bowpp_write_file( $spmybp_setup_file, $spmybp_tmpstr );
} 
} 


if( $spmybp_posts == 'DISPLAY' ){
$spmybp_post_button = 'checked="checked"' ;
$spmybp_post_button1 = '' ;
} else {
$spmybp_post_button = '' ;
$spmybp_post_button1 = 'checked="checked"' ;
}

if( $spmybp_pages == 'DISPLAY' ){
$spmybp_page_button = 'checked="checked"' ;
$spmybp_page_button1 = '' ;
} else {
$spmybp_page_button = '' ;
$spmybp_page_button1 = 'checked="checked"' ;
}		

if( isset( $_POST['spmy_total_messages'] )) {
if( $_POST['spmy_total_messages'] == 'Submit' ){
	//echo '<br>Yes Submit detected';
	if( isset( $_POST['spmy_message_counter'] ) ) {
	$spmybp_counter = trim( $_POST['spmy_message_counter'] )*1;
	$spmybp_data_str[0] = $spmybp_counter;
	}
	if( isset( $_POST['spmy_message_page_counter'] ) ) {
	$spmybp_page_counter = trim( $_POST['spmy_message_page_counter'] )*1;
	$spmybp_data_str[1] = $spmybp_page_counter;
	}
	$spmybp_tmpstr = serialize( $spmybp_data_str );	
	spmy_bowpp_write_file( $spmybp_setup_file, $spmybp_tmpstr );
} 
}		

//initialise variables
for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++){
$spmybp_msg[ $spmybp_i ] = '';
$spmybp_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotmsg'.$spmybp_i.'.txt';
$spmybp_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopostmsg'.$spmybp_i.'.html';
}

for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){
$spmybp_page_msg[ $spmybp_i ] = '';
$spmybp_page_filename[ $spmybp_i ] = $spmybp_datadiralt .'/mybotpagemsg'.$spmybp_i.'.txt';
$spmybp_page_filename_html[ $spmybp_i ] = $spmybp_datadiralt .'/seopagemsg'.$spmybp_i.'.html';
}

$spmybp_tmpstr = '';
for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++){	
if( file_exists( $spmybp_filename[ $spmybp_i] )){ 
	//if file exist
	if( filesize( $spmybp_filename[ $spmybp_i ] ) > 0 ){
		$spmybp_msg[ $spmybp_i ] = spmy_bowpp_read_file( $spmybp_filename[ $spmybp_i] );
		}
	} 
} 	
$spmybp_tmpstr = '';
for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++){	
if( file_exists( $spmybp_page_filename[ $spmybp_i] )){ 
	//if file exist
	if( filesize( $spmybp_page_filename[ $spmybp_i ] ) > 0 ){
		$spmybp_page_msg[ $spmybp_i ] = spmy_bowpp_read_file( $spmybp_page_filename[ $spmybp_i] );
		}
	} 
} 	


if( isset( $_POST['spmy_bottom_messages'] )){
if( $_POST['spmy_bottom_messages'] == 'Save Post Messages' ){
	for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++) {
		if( isset( $_POST['spmy_txtarea'][$spmybp_i] ) ) {
			$spmybp_tmpstr =  stripslashes( trim( $_POST['spmy_txtarea'][$spmybp_i] ) );
			$spmybp_msg[ $spmybp_i ] = $spmybp_tmpstr;
			spmy_bowpp_write_file( $spmybp_filename[ $spmybp_i ], $spmybp_msg[ $spmybp_i ] );
			$spmybp_tmpstr_html = '<html><head></head><body>'."\r\n".$spmybp_tmpstr."\r\n".'</body></html>';
			spmy_bowpp_write_file( $spmybp_filename_html[ $spmybp_i ], $spmybp_tmpstr_html );
			}
	}
}


	for( $spmybp_i=0; $spmybp_i<$spmybp_counter; $spmybp_i++) { 
		if( isset( $_POST['spmy_ppost_SEO'][$spmybp_i] ) ) {
			$spmybp_post_SEO[$spmybp_i][0] =  $_POST['spmy_ppost_SEO'][$spmybp_i] ;
			} else {
			$spmybp_post_SEO[$spmybp_i][0] =  '';
			}
		if( isset( $_POST['spmy_ppost_width'][$spmybp_i] ) ) {
			$spmybp_post_SEO[$spmybp_i][1] =  $_POST['spmy_ppost_width'][$spmybp_i] ;
			} 
		if( isset( $_POST['spmy_ppost_height'][$spmybp_i] ) ) {
			$spmybp_post_SEO[$spmybp_i][2] =  $_POST['spmy_ppost_height'][$spmybp_i] ;
			} 
		if( isset( $_POST['spmy_ppost_HOME'][$spmybp_i] ) ) {
			$spmybp_post_SEO[$spmybp_i][4] =  $_POST['spmy_ppost_HOME'][$spmybp_i] ;
			} else {
			$spmybp_post_SEO[$spmybp_i][4] = '';
			}
		if( isset( $_POST['spmy_ppost_CAT'][$spmybp_i] ) ) {	
			$spmybp_post_SEO[$spmybp_i][5] =  $_POST['spmy_ppost_CAT'][$spmybp_i] ;
			} else {
			$spmybp_post_SEO[$spmybp_i][5] =  '';
			}
		if( isset( $_POST['spmy_ppost_ARC'][$spmybp_i] ) ) {	
			$spmybp_post_SEO[$spmybp_i][6] =  $_POST['spmy_ppost_ARC'][$spmybp_i] ;
			} else {
			$spmybp_post_SEO[$spmybp_i][6] =  '';
			}			
		if( isset( $_POST['spmy_ppost_TITLE'][$spmybp_i] ) ) {
		$spmybp_post_SEO[$spmybp_i][7] =  trim($_POST['spmy_ppost_TITLE'][$spmybp_i]) ;	//version 1.02 add title
		}
	if( $spmybp_post_SEO[$spmybp_i][0] == 'SEO' ){ //if sensitive to SEO save info and display as iframe
	
		$spmybp_tempstr = base64_encode ( '<iframe src="'.plugins_url( 'seopostmsg'.$spmybp_i.'.html' , __FILE__ ) .'" width="'.$spmybp_post_SEO[$spmybp_i][1].'" height="'.$spmybp_post_SEO[$spmybp_i][2].'"></iframe>' ) ; 
		$spmybp_post_SEO[$spmybp_i][3] = $spmybp_tempstr;
		}
	}	
	spmy_bowpp_write_file( $spmybp_setup_seopost_file, serialize( $spmybp_post_SEO ) );
} 


if( isset( $_POST['spmy_bottom_page_messages'] ) ){
if( $_POST['spmy_bottom_page_messages'] == 'Save Page Messages' ){
	for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++) {
	if( isset( $_POST['spmy_page_txtarea'][$spmybp_i] ) ) {
		$spmybp_tmpstr =  stripslashes( trim( $_POST['spmy_page_txtarea'][$spmybp_i] ) );
		$spmybp_page_msg[ $spmybp_i ] = $spmybp_tmpstr;
		spmy_bowpp_write_file( $spmybp_page_filename[ $spmybp_i ], $spmybp_page_msg[ $spmybp_i ] );
		$spmybp_tmpstr_html = '<html><head></head><body>'."\r\n".$spmybp_tmpstr."\r\n".'</body></html>';
		spmy_bowpp_write_file( $spmybp_page_filename_html[ $spmybp_i ], $spmybp_tmpstr_html );
		}
	}
	for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++) {
		if( isset( $_POST['spmy_ppage_SEO'][$spmybp_i] ) ) {
			$spmybp_page_SEO[$spmybp_i][0] =  $_POST['spmy_ppage_SEO'][$spmybp_i] ;
			}
		if( isset( $_POST['spmy_ppage_width'][$spmybp_i] ) ) {
			$spmybp_page_SEO[$spmybp_i][1] =  $_POST['spmy_ppage_width'][$spmybp_i] ;
			}
		if( isset( $_POST['spmy_ppage_height'][$spmybp_i] ) ) {
			$spmybp_page_SEO[$spmybp_i][2] =  $_POST['spmy_ppage_height'][$spmybp_i] ;
			}	
		if( isset( $_POST['spmy_ppage_TITLE'][$spmybp_i] ) ) {	
		$spmybp_page_SEO[$spmybp_i][7] =  trim($_POST['spmy_ppage_TITLE'][$spmybp_i]) ;
		}
	if( $spmybp_page_SEO[$spmybp_i][0] == 'SEO' ){ //if sensitive to SEO save info and display as iframe
	
		$spmybp_tempstr = base64_encode ( '<div width="'.$spmybp_page_SEO[$spmybp_i][1].'" height="'.$spmybp_page_SEO[$spmybp_i][2].'"><iframe src="'.plugins_url( 'seopagemsg'.$spmybp_i.'.html' , __FILE__ ) .'" width="'.$spmybp_page_SEO[$spmybp_i][1].'" height="'.$spmybp_page_SEO[$spmybp_i][2].'">   scrolling="auto" </iframe></div>' ) ; 
		$spmybp_page_SEO[$spmybp_i][3] = $spmybp_tempstr;
		}

			
	}	
	spmy_bowpp_write_file( $spmybp_setup_seopage_file, serialize( $spmybp_page_SEO ) );	
} 
}




?>
<div class="wrap">
<?php

echo '<br><span style="color:red;font-size:32px;font-style:normal;">Welcome to dpaBottomofPostPage Setup, Version 1.13 [20150706]</span>';

echo '<p><span style="color:blue;font-size:14px;font-style:normal;">This plugin sets up the data files that hold the messages you want to display at the bottom of every post or page.</p></span>
<h3>Uses</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">Use the message areas to place text, advertisements, Sign Up forms, Affliate program ads HTML code, ... etc. If you need it displayed, just try it out. It is amazing what you can display in these message areas.</span></p>
<h3>How to use</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">Firstly enter how many messages you want to display at the bottom of every post and at the bottom of every page then hit the "Submit" button. If you do not want anything displayed enter 0.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">After that, click on radio buttons to indicate whether you would like to display the Post messages and the Page messages and click on "Set Display" button to save.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">Then fill up the Message Areas with the required html code and hit Save Post Messages button or Save Page Messages button. If you need to delete a message, just delete / cut the contents of that message area and hit the Save Messages button. If you have selected the "Affects SEO" option, you will need to specify the dimensions of the messages - width and height. The "DOES NOT AFFECT SEO" option does not use and does not require any dimensions to be specified. Do note that some Themes may limit the dimension of your messages and when this happens, scroll bars will appear in the display. If you see scroll bars on your messages, adjust your message dimensions or reduce the size of images in your messages.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">Further down you will see the options to choose which posts or pages you would like to disable from displaying messages.</span></p>
';
?>
<br>
<h3>Set up dpaBottomofPostPage</h3>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up number of messages to be placed at the bottom of every post and page.</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table>
<tr><td>Number of messages at bottom of a post : </td><td><input type="text" size="10" name="spmy_message_counter" value="<?php echo $spmybp_counter; ?>" ></td></tr>
<tr><td>Number of messages at bottom of a page : </td><td><input type="text" size="10" name="spmy_message_page_counter" value="<?php echo $spmybp_page_counter; ?>" ></td></tr>
</table>
<input type="submit" name='spmy_total_messages' value="Submit" >
</form>
<br>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Choose if messages will be displayed on posts and or pages</span></h2>

<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table>
<tr><td>Display at Bottom of Posts: </td><td><input type="radio" <?php echo $spmybp_post_button; ?> name="spmy_display_posts" value="DISPLAY">Display</td><td><input type="radio" <?php echo $spmybp_post_button1; ?> name="spmy_display_posts" value="DONT">Don't Display</td></tr>
<tr><td>Display at Bottom of Pages: </td><td><input type="radio" <?php echo $spmybp_page_button; ?> name="spmy_display_pages" value="DISPLAY">Display</td><td><input type="radio" <?php echo $spmybp_page_button1; ?> name="spmy_display_pages" value="DONT">Don't Display</td></tr>
</table>
<input type="submit" name='spmy_type_of_display' value="Set Display" >
</form>



<br>
<h1>POST MESSAGE SECTION</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up the messages at the bottom of your WordPress Posts</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table>
<?php 
$spmybp_defcnt = count( $samplemsg );
if( $spmybp_counter < $spmybp_defcnt ){
$spmybp_loop_counter = $spmybp_defcnt;
} else {
$spmybp_loop_counter = $spmybp_counter;
}
for( $spmybp_i=0; $spmybp_i<$spmybp_loop_counter; $spmybp_i++) {
$spmybp_j= $spmybp_i + 1;
if( $spmybp_i < $spmybp_defcnt ){
if( $spmybp_i == 1 ){
$spmybp_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmybp_i].'</textarea>';
$spmybp_samplestr1 = 'Example of Message '.$spmybp_j.': Facebook, Google+ & Twitter Like & Share Buttons. You can copy and paste without modification into Your Message Area';
} else if( $spmybp_i == 0 ){
$spmybp_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmybp_i].'</textarea>';
$spmybp_samplestr1 = 'Example of Message '.$spmybp_j.': An example Copyright Message with Google Authorship. You can replace any XXX...XXX with your own values or get your own authorship code from Goolge at <a target="_blank"  href="https://plus.google.com/authorship">https://plus.google.com/authorship</a>.'; 
} if( $spmybp_i == 2 ){
$spmybp_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmybp_i].'</textarea>';
$spmybp_samplestr1 = 'Example of Message '.$spmybp_j.': An example of Google Ads. You can replace any XXX...XXX with your own values or get your own Google code from Google AdSense.';
}if( $spmybp_i == 3 ){
$spmybp_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmybp_i].'</textarea>';
$spmybp_samplestr1 = 'Example of Message '.$spmybp_j.': A blank advert that shows your visitors that they can place their advertisements in this message area. Just copy and past it into your message area.';
}
} else {
$spmybp_samplestr = '';
$spmybp_samplestr1 = ''; 
}
?>
<tr><td valign="bottom">
<?php 
if( $spmybp_i < $spmybp_counter ){
$checkflag1 = '';
$checkflag2 = '';
if( $spmybp_post_SEO[$spmybp_i][0] == 'SEO' ){
$checkflag1 = 'checked';
$checkflag2 = '';
} else if( $spmybp_post_SEO[$spmybp_i][0] == 'NOT SEO') {
$checkflag1 = '';
$checkflag2 = 'checked';
} 

if( $spmybp_post_SEO[$spmybp_i][4] == 'HOME' ){
$checkHOME = 'checked';
} else {
$checkHOME = '';
}

if( $spmybp_post_SEO[$spmybp_i][5] == 'CAT' ){
$checkCAT = 'checked';
} else {
$checkCAT = '';
}

if( $spmybp_post_SEO[$spmybp_i][6] == 'ARC' ){
$checkARC = 'checked';
} else {
$checkARC = '';
}


?>
<span style="color:blue">Your Message Area <?php echo $spmybp_j; ?> [ AFFECTS SEO<input type="radio" name="spmy_ppost_SEO[<?php echo $spmybp_i;?>]" value="SEO"  <?php echo $checkflag1; ?> > DOES NOT AFFECT SEO<input type="radio"  name="spmy_ppost_SEO[<?php echo $spmybp_i;?>]" value="NOT SEO" <?php echo $checkflag2; ?>  >][ Width:<input type="text" size="6" name="spmy_ppost_width[<?php echo $spmybp_i;?>]" value="<?php echo $spmybp_post_SEO[$spmybp_i][1];?>" > Height: <input type="text"  size="6" name="spmy_ppost_height[<?php echo $spmybp_i;?>]" value="<?php echo $spmybp_post_SEO[$spmybp_i][2];?>"  >]

<br>Show in Summary of: Home Page
<input type="checkbox" name="spmy_ppost_HOME[<?php echo $spmybp_i;?>]" value="HOME"  <?php echo $checkHOME; ?> > Category Page
<input type="checkbox" name="spmy_ppost_CAT[<?php echo $spmybp_i;?>]" value="CAT"  <?php echo $checkCAT; ?> >Archive Page
<input type="checkbox" name="spmy_ppost_ARC[<?php echo $spmybp_i;?>]" value="ARC"  <?php echo $checkARC; ?> ></span>
<br>Title of Message: <br><input type="text" name="spmy_ppost_TITLE[<?php echo $spmybp_i;?>]" value="<?php echo $spmybp_post_SEO[$spmybp_i][7];?>"  size="80" >
<br>The Message:<br>
<?php
}
?>
</td><td><span style="color:red"><?php echo $spmybp_samplestr1; ?></span>
</td></tr>
<tr><td>
<?php 
if( $spmybp_i < $spmybp_counter ){
?>
<textarea name="<?php echo 'spmy_txtarea['.$spmybp_i.']'; ?>" rows="10" cols="80"><?php echo $spmybp_msg[ $spmybp_i ] ; ?></textarea></td>
<?php
} else {
?>
</td>
<?php
}
?>
<td><?php echo $spmybp_samplestr ; ?></td></tr>
<tr><td></td><td></td></tr>
<?php 
}
?>
</table>
<?php
if( $spmybp_counter > 0){
?>
<input type="submit" name="spmy_bottom_messages" value="Save Post Messages" >
<?php
}
?>
</form>



<br>
<h1>PAGE MESSAGE SECTION</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up the messages at the bottom of your WordPress Pages</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table>
<?php 

for( $spmybp_i=0; $spmybp_i<$spmybp_page_counter; $spmybp_i++) {
$spmybp_j= $spmybp_i + 1;

?>
<tr><td valign="bottom">
<?php 
if( $spmybp_i < $spmybp_page_counter ){
$checkflag1 = '';
$checkflag2 = '';
if( $spmybp_page_SEO[$spmybp_i][0] == 'SEO' ){
$checkflag1 = 'checked';
$checkflag2 = '';
} else if( $spmybp_page_SEO[$spmybp_i][0] == 'NOT SEO') {
$checkflag1 = '';
$checkflag2 = 'checked';
}
?>
<span style="color:blue">Your Message Area <?php echo $spmybp_j; ?> [ AFFECTS SEO<input type="radio"  name="spmy_ppage_SEO[<?php echo $spmybp_i;?>]" value="SEO"  <?php echo $checkflag1; ?> > DOES NOT AFFECT SEO<input type="radio" name="spmy_ppage_SEO[<?php echo $spmybp_i;?>]" value="NOT SEO" <?php echo $checkflag2; ?>  >][ Width:<input type="text" size="6" name="spmy_ppage_width[<?php echo $spmybp_i;?>]" value="<?php echo $spmybp_page_SEO[$spmybp_i][1];?>" > Height: <input type="text"  size="6" name="spmy_ppage_height[<?php echo $spmybp_i;?>]" value="<?php echo $spmybp_page_SEO[$spmybp_i][2];?>"  >]</span>
<br>Title of Message: <br><input type="text" name="spmy_ppage_TITLE[<?php echo $spmybp_i;?>]" value="<?php echo $spmybp_page_SEO[$spmybp_i][7];?>"  size="80" >
<br>The Message:<br>
<?php
}
?>
</td><td></td></tr>
<tr><td>
<?php 
if( $spmybp_i < $spmybp_page_counter ){
?>
<textarea name="<?php echo 'spmy_page_txtarea['.$spmybp_i.']'; ?>" rows="10" cols="80"><?php echo $spmybp_page_msg[ $spmybp_i ] ; ?></textarea>
<?php
}
?>
</td>
<td></td></tr>
<tr><td></td><td></td></tr>
<?php 
}
?>
</table>
<?php
if( $spmybp_page_counter > 0){
?>
<input type="submit" name="spmy_bottom_page_messages" value="Save Page Messages" >
<?php
}
?>
</form>
</div>
<!--
<br><br>
<h1>Set up of display of posts and pages tables as shown below</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Here you can adjust how the list of posts, as shown in the table below can adjusted.</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table>
<tr><td>Number of rows in posts display</td><td><input type="text" name='spmy_post_recordsi' value="<?php echo $spmybp_post_rows; ?>" ></td></tr>
<tr><td>Offset position of post in list of posts</td><td><input type="text" name='spmy_post_offseti' value="<?php echo $spmybp_post_offset; ?>" ></td></tr>
<tr><td>Number of rows in pages display</td><td><input type="text" name='spmy_page_recordsi' value="<?php echo $spmybp_page_rows; ?>" ></td></tr>
<tr><td>Offset position of page in list of pages</td><td><input type="text" name='spmy_page_offseti' value="<?php echo $spmybp_page_offset; ?>" ></td></tr>
<tr><td><input type="submit" name='spmy_display_data' value="Submit" ></td><td></td></tr>
</table>
</form>
-->

<br><br>
<h1>Select posts that are to show messages</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">You can select which posts are to show messages.</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table class="myoptions">
<tr><td>All post to show messages </td><td><input type="submit" name='spmy_diapla_all' value="Display On All Posts" ></td></tr>
</table>
</form>
<h1>OR</h1>

<h2><span style="color:blue;font-size:16px;font-style:normal;">The table below shows the list of <?php echo $spmybp_postslist_sz; ?> posts. Check posts that will display messages and uncheck posts that are not to show messages</span></h2>

<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<input type="submit" name='spmy_check_posts' value="Change Post Display" >
<div class="mydisplay">
<table class="spmy_X">
<?php
$spmybp_i=0;
$spmybp_pplist = NULL;
unset( $spmybp_pplist );
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_posts_file );
$spmybp_pplist = unserialize( $spmybp_tmpstr );
echo '<tr><th>Item </th><th>Post </th><th>Display</th></tr>';
foreach( $spmybp_pplist as $key => $value ){
echo '<tr><td>'.($spmybp_i+1).'</td><td>'.$key.'</td><td><input type="checkbox"  name="spmy_input_pplist['.$key.']" value="Checked" '.$value.'></td></tr>';
$spmybp_i++;
}
?>
</table>
</div>
<!-- 
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<input type="submit" name='spmy_post_first_page' value="First Page" >
<input type="submit" name='spmy_post_last_page' value="Last Page" >
<input type="submit" name='spmy_post_prev_page' value="Previous Page" >
<input type="submit" name='spmy_post_next_page' value="Next Page" >
</form>
-->
<input type="submit" name='spmy_check_posts' value="Change Post Display" >
</form>



<br><br>
<h1>Select pages that are to show messages</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">You can select which pages are to show messages.</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<table class="myoptions">
<tr><td>All pages to show messages </td><td><input type="submit" name='spmy_diaplay_all' value="Display On All Pages" ></td></tr>
</table>
</form>
<h1>OR</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">The table below shows the list of <?php echo $spmybp_pageslist_sz; ?> pages. Check pages that will display messages and uncheck pages that are not to show messages</span></h2>
<form action="<? echo htmlspecialchars( $_SERVER['REQUEST_URI'] ) ; ?>"  method="post">
<input type="submit" name='spmy_check_pages' value="Change Page Display" >
<div class="mydisplay">
<table class="spmy_X">
<?php
$spmybp_i=0;
$spmybp_ppplist = NULL;
unset( $spmybp_ppplist );
$spmybp_tmpstr = '';
$spmybp_ppplist ='';
$spmybp_tmpstr = spmy_bowpp_read_file( $spmybp_published_pages_file );
$spmybp_ppplist = unserialize( $spmybp_tmpstr );
echo '<tr><th>Item </th><th>Post </th><th>Display</th></tr>';
foreach( $spmybp_ppplist as $key => $value ){
echo '<tr><td>'.($spmybp_i+1).'</td><td>'.$key.'</td><td><input type="checkbox"  name="spmy_input_ppplist['.$key.']" value="Checked" '.$value.'></td></tr>';
$spmybp_i++;
}
?>
</table>
</div>
<!--
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<input type="submit" name='spmy_page_first_page' value="First Page" >
<input type="submit" name='spmy_page_last_page' value="Last Page" >
<input type="submit" name='spmy_page_prev_page' value="Previous Page" >
<input type="submit" name='spmy_page_next_page' value="Next Page" >
</form>
-->
<input type="submit" name='spmy_check_pages' value="Change Page Display" >
</form>

<br><br><br>
<?php
$spmybp_plugins_url = plugins_url().'/dpabottomofpostpage';
//echo '<br>plugins url : '.plugins_url().'  ';
//echo '<br>full plugins url : '.plugins_url().'/dpabottomofpostpage'.'  ';
?>
<h3>Other Products by Software Propulsion</h3>
<table width="800">
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">The Bad Bot Exterminator</span> - Very effective anti hacking software that blocks hackers, stop brute force login attemtps and defends against ddos attacks to protect your WordPress website</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com"><img src="<?php echo $spmybp_plugins_url.'/bbbh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">SuperFast Cache</span> - A very fast cache for WordPress. SuperFast Cache is in 2 modules. The 1st is the Cache Controller, in SuperFast Cache - a WordPress Plugin & the 2nd is built into dpaBadBot, The Bad Bot Exterminator & Firewall Shield.</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com/amazingly-super-fast-wordpress-plugin-cache-controller-and-php-accelerator.php"><img src="<?php echo $spmybp_plugins_url.'/sfc30.png'; ?>" width="402" height="30"></a></td></tr>

<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">XFC a fast cache combined with an anti hacking firewall for php developers</span> - Not for WordPress, Joomla or other blogs but for other php websites. PHP Caching & Firewall Shield</td><td style="vertical-align:top;"><a target="_blank" href="http://www.xfcphpcache.com"><img src="<?php echo $spmybp_plugins_url.'/xfch30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">Web Hosting Services</span> - from budget hosting to high performance sites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.peterpublishing.com"><img src="<?php echo $spmybp_plugins_url.'/webhostingservicesh30.png'; ?>" width="405" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;"><span style="color:red;">dpaContactUs</span> - Contact Form that makes life difficult for spammers. Multiple websites can share one email address.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpacontactus.com"><img src="<?php echo $spmybp_plugins_url.'/cufh30.png'; ?>" width="402" height="30"></a></td></tr>
</table>

<?php

$spmybp_msg = NULL;
unset( $spmybp_msg );
$spmybp_filename = NULL;
unset( $spmybp_filename );
$spmybp_filename_html = NULL;
unset( $spmybp_filename_html );
$spmybp_page_msg = NULL;
unset( $spmybp_page_msg );
$spmybp_page_filename = NULL;
unset( $spmybp_page_filename );
$spmybp_page_filename_html = NULL;
unset( $spmybp_page_filename_html );
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

?>