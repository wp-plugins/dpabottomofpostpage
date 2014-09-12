<?php
defined('ABSPATH') or die("No script kiddies please!");
//include 'spmyfunctions.php';
//define the filename of setup file; 
$spmy_plugins_url = plugins_url().'/dpabottomofpostpage';

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
<img alt="Insert Ads Here" src="'.$spmy_plugins_url.'/advertspace.png'.'" width="728" height="90">
</td></tr>
</table>';


$spmy_setup_file = dirname(__FILE__) ."/setup.txt";
$spmy_setup_seopost_file = dirname(__FILE__) ."/seopost.txt";
$spmy_setup_seopage_file = dirname(__FILE__) ."/seopage.txt";

$spmy_tmpstr = '';
$spmy_counter = 0;
$spmy_page_counter = 0;
unset( $spmy_msg );
unset( $spmy_filename );
unset( $spmy_filename_html );
unset( $spmy_page_msg );
unset( $spmy_page_filename );
unset( $spmy_page_filename_html );

//if the setup file exists go read the contents
//clearstatcache();
if( file_exists( $spmy_setup_file ) ) {
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_setup_file );
	if( strlen( $spmy_tmpstr ) > 2 ){
	$spmy_data_str = unserialize( $spmy_tmpstr);
	$spmy_counter = $spmy_data_str[0];
	$spmy_page_counter = $spmy_data_str[1];
	$spmy_posts = $spmy_data_str[2];
	$spmy_pages = $spmy_data_str[3];
	}
} else {
	$spmy_counter = 0; 
	$spmy_data_str[0] = $spmy_counter ; 
	$spmy_page_counter = 0;
	$spmy_data_str[1] = $spmy_page_counter;
	$spmy_posts = 'DONT';
	$spmy_data_str[2] = $spmy_posts;
	$spmy_pages = 'DONT';
	$spmy_data_str[3] = $spmy_pages;
	$spmy_tmpstr = serialize( $spmy_data_str );	
	spmy_bowpp_write_file( $spmy_setup_file, $spmy_tmpstr );
}

//read in which post message affects SEO and should be in iframe
if( file_exists( $spmy_setup_seopost_file )) {
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_setup_seopost_file );
if( strlen( $spmy_tmpstr ) > 2 ){
	$spmy_post_SEO = unserialize( $spmy_tmpstr);
	}
} else {
for( $spmy_i=0; $spmy_i<4; $spmy_i++){
$spmy_msg[ $spmy_i ] = '';
$spmy_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotmsg'.$spmy_i.'.txt';
$spmy_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopostmsg'.$spmy_i.'.html';
$spmy_post_SEO[$spmy_i][0] = 'NOT SEO';
$spmy_post_SEO[$spmy_i][1] = 790;
$spmy_post_SEO[$spmy_i][2] = 140;
}
}
//read in which page message affects SEO and should be in iframe
if( file_exists( $spmy_setup_seopage_file )){
$spmy_tmpstr = spmy_bowpp_read_file( $spmy_setup_seopage_file );
if( strlen( $spmy_tmpstr ) > 2 ){
	$spmy_page_SEO = unserialize( $spmy_tmpstr);
	}
}  else {
for( $spmy_i=0; $spmy_i<4; $spmy_i++){
$spmy_msg[ $spmy_i ] = '';
$spmy_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmy_i.'.txt';
$spmy_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopagemsg'.$spmy_i.'.html';
$spmy_page_SEO[$spmy_i][0] = 'NOT SEO';
$spmy_page_SEO[$spmy_i][1] = 790;
$spmy_page_SEO[$spmy_i][2] = 140;
}
}



if( $_POST[spmy_type_of_display] == 'Set Display' ){
	//echo '<br>Yes Submit detected';
	if( isset( $_POST[spmy_display_posts] ) ) {
	$spmy_data_str[2] = $_POST[spmy_display_posts];
	$spmy_posts = $spmy_data_str[2] ;
	}
	if( isset( $_POST[spmy_display_pages] ) ) {
	$spmy_data_str[3] = $_POST[spmy_display_pages] ;
	$spmy_pages = $spmy_data_str[3] ;
	}
	$spmy_tmpstr = serialize( $spmy_data_str );	
	spmy_bowpp_write_file( $spmy_setup_file, $spmy_tmpstr );
} 

if( $spmy_posts == 'DISPLAY' ){
$spmy_post_button = 'checked="checked"' ;
$spmy_post_button1 = '' ;
} else {
$spmy_post_button = '' ;
$spmy_post_button1 = 'checked="checked"' ;
}

if( $spmy_pages == 'DISPLAY' ){
$spmy_page_button = 'checked="checked"' ;
$spmy_page_button1 = '' ;
} else {
$spmy_page_button = '' ;
$spmy_page_button1 = 'checked="checked"' ;
}		
		
if( $_POST[spmy_total_messages] == 'Submit' ){
	//echo '<br>Yes Submit detected';
	if( isset( $_POST[spmy_message_counter] ) ) {
	$spmy_counter = trim( $_POST[spmy_message_counter] )*1;
	$spmy_data_str[0] = $spmy_counter;
	$spmy_page_counter = trim( $_POST[spmy_message_page_counter] )*1;
	$spmy_data_str[1] = $spmy_page_counter;
	$spmy_tmpstr = serialize( $spmy_data_str );	
	spmy_bowpp_write_file( $spmy_setup_file, $spmy_tmpstr );
	}
} 
		

//initialise variables
for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++){
$spmy_msg[ $spmy_i ] = '';
$spmy_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotmsg'.$spmy_i.'.txt';
$spmy_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopostmsg'.$spmy_i.'.html';
}

for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){
$spmy_page_msg[ $spmy_i ] = '';
$spmy_page_filename[ $spmy_i ] = dirname(__FILE__) .'/mybotpagemsg'.$spmy_i.'.txt';
$spmy_page_filename_html[ $spmy_i ] = dirname(__FILE__) .'/seopagemsg'.$spmy_i.'.html';
}

$spmy_tmpstr = '';
for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++){	
if( file_exists( $spmy_filename[ $spmy_i] )){ 
	//if file exist
	if( filesize( $spmy_filename[ $spmy_i ] ) > 0 ){
		$spmy_msg[ $spmy_i ] = spmy_bowpp_read_file( $spmy_filename[ $spmy_i] );
		}
	} 
} 	
$spmy_tmpstr = '';
for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++){	
if( file_exists( $spmy_page_filename[ $spmy_i] )){ 
	//if file exist
	if( filesize( $spmy_page_filename[ $spmy_i ] ) > 0 ){
		$spmy_page_msg[ $spmy_i ] = spmy_bowpp_read_file( $spmy_page_filename[ $spmy_i] );
		}
	} 
} 	

if( $_POST[spmy_bottom_messages] == 'Save Post Messages' ){
	//echo '<br>Yes Submit detected';
	for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++) {
		if( isset( $_POST[spmy_txtarea][$spmy_i] ) ) {
			$spmy_tmpstr =  stripslashes( trim( $_POST[spmy_txtarea][$spmy_i] ) );
			$spmy_msg[ $spmy_i ] = $spmy_tmpstr;
			spmy_bowpp_write_file( $spmy_filename[ $spmy_i ], $spmy_msg[ $spmy_i ] );
			$spmy_tmpstr_html = '<html><head></head><body>'."\r\n".$spmy_tmpstr."\r\n".'</body></html>';
			spmy_bowpp_write_file( $spmy_filename_html[ $spmy_i ], $spmy_tmpstr_html );
			}
	}
	for( $spmy_i=0; $spmy_i<$spmy_counter; $spmy_i++) { 

		if( isset( $_POST[spmy_ppost_SEO][$spmy_i] ) ) {
			$spmy_post_SEO[$spmy_i][0] =  $_POST[spmy_ppost_SEO][$spmy_i] ;
			}
		if( isset( $_POST[spmy_ppost_width][$spmy_i] ) ) {
			$spmy_post_SEO[$spmy_i][1] =  $_POST[spmy_ppost_width][$spmy_i] ;
			}	
		if( isset( $_POST[spmy_ppost_height][$spmy_i] ) ) {
			$spmy_post_SEO[$spmy_i][2] =  $_POST[spmy_ppost_height][$spmy_i] ;
			}		
	if( $spmy_post_SEO[$spmy_i][0] == 'SEO' ){ //if sensitive to SEO save info and display as iframe
	
		$spmy_tempstr = '<iframe src="'.plugins_url( 'seopostmsg'.$spmy_i.'.html' , __FILE__ ) .'" width="'.$spmy_post_SEO[$spmy_i][1].'" height="'.$spmy_post_SEO[$spmy_i][2].'"></iframe>' ; 
		$spmy_post_SEO[$spmy_i][3] = $spmy_tempstr;
		}
	}	
	spmy_bowpp_write_file( $spmy_setup_seopost_file, serialize( $spmy_post_SEO ) );
} 


if( $_POST[spmy_bottom_page_messages] == 'Save Page Messages' ){
	//echo '<br>Yes Submit detected';
	for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++) {
	if( isset( $_POST[spmy_page_txtarea][$spmy_i] ) ) {
		$spmy_tmpstr =  stripslashes( trim( $_POST[spmy_page_txtarea][$spmy_i] ) );
		$spmy_page_msg[ $spmy_i ] = $spmy_tmpstr;
		spmy_bowpp_write_file( $spmy_page_filename[ $spmy_i ], $spmy_page_msg[ $spmy_i ] );
		$spmy_tmpstr_html = '<html><head></head><body>'."\r\n".$spmy_tmpstr."\r\n".'</body></html>';
		spmy_bowpp_write_file( $spmy_page_filename_html[ $spmy_i ], $spmy_tmpstr_html );
		}
	}
	for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++) {
		if( isset( $_POST[spmy_ppage_SEO][$spmy_i] ) ) {
			$spmy_page_SEO[$spmy_i][0] =  $_POST[spmy_ppage_SEO][$spmy_i] ;
			}
		if( isset( $_POST[spmy_ppage_width][$spmy_i] ) ) {
			$spmy_page_SEO[$spmy_i][1] =  $_POST[spmy_ppage_width][$spmy_i] ;
			}
		if( isset( $_POST[spmy_ppage_height][$spmy_i] ) ) {
			$spmy_page_SEO[$spmy_i][2] =  $_POST[spmy_ppage_height][$spmy_i] ;
			}	
	if( $spmy_page_SEO[$spmy_i][0] == 'SEO' ){ //if sensitive to SEO save info and display as iframe
	
		$spmy_tempstr = '<div width="'.$spmy_page_SEO[$spmy_i][1].'" height="'.$spmy_page_SEO[$spmy_i][2].'"><iframe src="'.plugins_url( 'seopagemsg'.$spmy_i.'.html' , __FILE__ ) .'" width="'.$spmy_page_SEO[$spmy_i][1].'" height="'.$spmy_page_SEO[$spmy_i][2].'">   scrolling="auto" </iframe></div>' ; 
		$spmy_page_SEO[$spmy_i][3] = $spmy_tempstr;
		}

			
	}	
	spmy_bowpp_write_file( $spmy_setup_seopage_file, serialize( $spmy_page_SEO ) );	
} 





?>
<div class="wrap">
<?php

echo '<br><span style="color:red;font-size:32px;font-style:normal;">Welcome to dpaBottomofPostPage Setup</span>';

echo '<p><span style="color:blue;font-size:14px;font-style:normal;">This plugin sets up the data files that hold the messages you want to display at the bottom of every post or page.</p></span>
<h3>Whats new in Version 1.01</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">This version has a major improvement. If you are finely tuning your webpage SEO Optimsation, you can disable the individual messages from being part of the webpage. This will prevent any messages displayed affecting you page SEO. Just click on [AFFECTS SEO] (to take it out of the webpage) or [DOES NOT AFFECT SEO] (to keep it as part of the webpage) options shown on the top of the individual message area. </span></p>
<h3>Uses</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">Use the message areas to place text, advertisements, Sign Up forms, Affliate program ads HTML code, ... etc. If you need it displayed, just try it out. It is amazing what you can display in these message areas.</span></p>
<h3>How to use</h3>
<p><span style="color:blue;font-size:14px;font-style:normal;">Firstly enter how many messages you want to display at the bottom of every post and at the bottom of every page then hit the "Submit" button. If you do not want anything displayed enter 0.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">After that, click on radio buttons to indicate whether you would like to display the Post messages and the Page messages and click on "Set Display" button to save.</span></p>
<p><span style="color:blue;font-size:14px;font-style:normal;">Then fill up the Message Areas with the required html code and hit Save Post Messages button or Save Page Messages button. If you need to delete a message, just delete / cut the contents of that message area and hit the Save Messages button. If you have selected the "Affects SEO" option, you will need to specify the dimensions of the messages - width and height. The "DOES NOT AFFECT SEO" option does not use and does not require any dimensions to be specified. Do note that some Themes may limit the dimension of your messages and when this happens, scroll bars will appear in the display. If you see scroll bars on your messages, adjust your message dimensions or reduce the size of images in your messages.</span></p>
';
?>
<br>
<h3>Set up dpaBottomofPostPage</h3>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up number of messages to be placed at the bottom of every post and page.</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table>
<tr><td>Number of messages at bottom of a post : </td><td><input type="text" size="10" name="spmy_message_counter" value="<?php echo $spmy_counter; ?>" ></td></tr>
<tr><td>Number of messages at bottom of a page : </td><td><input type="text" size="10" name="spmy_message_page_counter" value="<?php echo $spmy_page_counter; ?>" ></td></tr>
</table>
<input type="submit" name='spmy_total_messages' value="Submit" >
</form>
<br>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Choose if messages will be displayed on posts and or pages</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table>
<tr><td>Display at Bottom of Posts: </td><td><input type="radio" <?php echo $spmy_post_button; ?> name="spmy_display_posts" value="DISPLAY">Display</td><td><input type="radio" <?php echo $spmy_post_button1; ?> name="spmy_display_posts" value="DONT">Don't Display</td></tr>
<tr><td>Display at Bottom of Pages: </td><td><input type="radio" <?php echo $spmy_page_button; ?> name="spmy_display_pages" value="DISPLAY">Display</td><td><input type="radio" <?php echo $spmy_page_button1; ?> name="spmy_display_pages" value="DONT">Don't Display</td></tr>
</table>
<input type="submit" name='spmy_type_of_display' value="Set Display" >
</form>



<br>
<h1>POST MESSAGE SECTION</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up the messages at the bottom of your WordPress Posts</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table>
<?php 
$spmy_defcnt = count( $samplemsg );
if( $spmy_counter < $spmy_defcnt ){
$spmy_loop_counter = $spmy_defcnt;
} else {
$spmy_loop_counter = $spmy_counter;
}
for( $spmy_i=0; $spmy_i<$spmy_loop_counter; $spmy_i++) {
$spmy_j= $spmy_i + 1;
if( $spmy_i < $spmy_defcnt ){
if( $spmy_i == 1 ){
$spmy_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmy_i].'</textarea>';
$spmy_samplestr1 = 'Example of Message '.$spmy_j.': Facebook, Google+ & Twitter Like & Share Buttons. You can copy and paste without modification into Your Message Area';
} else if( $spmy_i == 0 ){
$spmy_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmy_i].'</textarea>';
$spmy_samplestr1 = 'Example of Message '.$spmy_j.': An example Copyright Message with Google Authorship. You can replace any XXX...XXX with your own values or get your own authorship code from Goolge at <a target="_blank"  href="https://plus.google.com/authorship">https://plus.google.com/authorship</a>.'; 
} if( $spmy_i == 2 ){
$spmy_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmy_i].'</textarea>';
$spmy_samplestr1 = 'Example of Message '.$spmy_j.': An example of Google Ads. You can replace any XXX...XXX with your own values or get your own Google code from Google AdSense.';
}if( $spmy_i == 3 ){
$spmy_samplestr = '<textarea rows="10" cols="45">'.$samplemsg[ $spmy_i].'</textarea>';
$spmy_samplestr1 = 'Example of Message '.$spmy_j.': A blank advert that shows your visitors that they can place their advertisements in this message area. Just copy and past it into your message area.';
}
} else {
$spmy_samplestr = '';
$spmy_samplestr1 = ''; 
}
?>
<tr><td valign="bottom">
<?php 
if( $spmy_i < $spmy_counter ){
$checkflag1 = '';
$checkflag2 = '';
if( $spmy_post_SEO[$spmy_i][0] == 'SEO' ){
$checkflag1 = 'checked';
$checkflag2 = '';
} else if( $spmy_post_SEO[$spmy_i][0] == 'NOT SEO') {
$checkflag1 = '';
$checkflag2 = 'checked';
}
?>
<span style="color:blue">Your Message Area <?php echo $spmy_j; ?> [ AFFECTS SEO<input type="radio" name="spmy_ppost_SEO[<?php echo $spmy_i;?>]" value="SEO"  <?php echo $checkflag1; ?> > DOES NOT AFFECT SEO<input type="radio"  name="spmy_ppost_SEO[<?php echo $spmy_i;?>]" value="NOT SEO" <?php echo $checkflag2; ?>  >][ Width:<input type="text" size="6" name="spmy_ppost_width[<?php echo $spmy_i;?>]" value="<?php echo $spmy_post_SEO[$spmy_i][1];?>" > Height: <input type="text"  size="6" name="spmy_ppost_height[<?php echo $spmy_i;?>]" value="<?php echo $spmy_post_SEO[$spmy_i][2];?>"  >]</span>
<?php
}
?>
</td><td><span style="color:red"><?php echo $spmy_samplestr1; ?></span>
</td></tr>
<tr><td>
<?php 
if( $spmy_i < $spmy_counter ){
?>
<textarea name="<?php echo 'spmy_txtarea['.$spmy_i.']'; ?>" rows="10" cols="80"><?php echo $spmy_msg[ $spmy_i ] ; ?></textarea></td>
<?php
} else {
?>
</td>
<?php
}
?>
<td><?php echo $spmy_samplestr ; ?></td></tr>
<tr><td></td><td></td></tr>
<?php 
}
?>
</table>
<?php
if( $spmy_counter > 0){
?>
<input type="submit" name="spmy_bottom_messages" value="Save Post Messages" >
<?php
}
?>
</form>



<br>
<h1>PAGE MESSAGE SECTION</h1>
<h2><span style="color:blue;font-size:16px;font-style:normal;">Set up the messages at the bottom of your WordPress Pages</span></h2>
<form action="<? echo htmlspecialchars( $PHP_SELF ) ; ?>"  method="post">
<table>
<?php 

for( $spmy_i=0; $spmy_i<$spmy_page_counter; $spmy_i++) {
$spmy_j= $spmy_i + 1;

?>
<tr><td valign="bottom">
<?php 
if( $spmy_i < $spmy_page_counter ){
$checkflag1 = '';
$checkflag2 = '';
if( $spmy_page_SEO[$spmy_i][0] == 'SEO' ){
$checkflag1 = 'checked';
$checkflag2 = '';
} else if( $spmy_page_SEO[$spmy_i][0] == 'NOT SEO') {
$checkflag1 = '';
$checkflag2 = 'checked';
}
?>
<span style="color:blue">Your Message Area <?php echo $spmy_j; ?> [ AFFECTS SEO<input type="radio"  name="spmy_ppage_SEO[<?php echo $spmy_i;?>]" value="SEO"  <?php echo $checkflag1; ?> > DOES NOT AFFECT SEO<input type="radio" name="spmy_ppage_SEO[<?php echo $spmy_i;?>]" value="NOT SEO" <?php echo $checkflag2; ?>  >][ Width:<input type="text" size="6" name="spmy_ppage_width[<?php echo $spmy_i;?>]" value="<?php echo $spmy_page_SEO[$spmy_i][1];?>" > Height: <input type="text"  size="6" name="spmy_ppage_height[<?php echo $spmy_i;?>]" value="<?php echo $spmy_page_SEO[$spmy_i][2];?>"  >]</span>
<?php
}
?>
</td><td></td></tr>
<tr><td>
<?php 
if( $spmy_i < $spmy_page_counter ){
?>
<textarea name="<?php echo 'spmy_page_txtarea['.$spmy_i.']'; ?>" rows="10" cols="80"><?php echo $spmy_page_msg[ $spmy_i ] ; ?></textarea>
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
if( $spmy_page_counter > 0){
?>
<input type="submit" name="spmy_bottom_page_messages" value="Save Page Messages" >
<?php
}
?>
</form>
</div>


<br><br><br>
<?php
$spmy_plugins_url = plugins_url().'/dpabottomofpostpage';
?>
<h3>Other Products by Software Propulsion</h3>
<table width="800">
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;">Contact Form that makes life difficult for spammers. Multiple websites can share one email address.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpacu.com"><img src="<?php echo $spmy_plugins_url.'/contactusformh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;">Very effective anti hacking software that blocks hackers, stop brute force login attemtps and defends against ddos attacks to protect your WordPress website</td><td style="vertical-align:top;"><a target="_blank" href="https://www.dpabadbot.com"><img src="<?php echo $spmy_plugins_url.'/blockbadboth30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;">Not for WordPress, Joomla or other blogs but for other php websites. PHP Caching Software</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpaxfc.com"><img src="<?php echo $spmy_plugins_url.'/xfcphpcacheh30.png'; ?>" width="402" height="30"></a></td></tr>
<tr><td style="color:darkblue;font-size:14px;font-style:normal;vertical-align:top;">Image Compression. Compresses images you have saved on your websites.</td><td style="vertical-align:top;"><a target="_blank" href="http://www.dpaic.com"><img src="<?php echo $spmy_plugins_url.'/imagecompressionh30.png'; ?>"  width="402" height="30"></a></td></tr>
<tr><td style="color:blue;font-size:14px;font-style:normal;vertical-align:top;">Web Hosting Services</td><td style="vertical-align:top;"><a target="_blank" href="http://www.peterpublishing.com"><img src="<?php echo $spmy_plugins_url.'/webhostingservicesh30.png'; ?>" width="405" height="30"></a></td></tr>
</table>

