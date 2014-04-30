<?php

function fbsm_get_options()

{

	$options=array(

			'author_name_custom'=>'WPDeveloper'	

	);

	

	$saved_options=get_option('fbsm_options',$options);

	return $saved_options;

}







function fbsm_options_page()

{

	global $wpdb;

	$fbsm_options=fbsm_get_options();

	

	if(isset($_POST['save_options']))

	{

		$options=array(

				'author_name_custom'=>trim($_POST['author_name_custom'])

		);	

	update_option('fbsm_options',$options);

	$fbsm_options=$options;

	}#end if(isset($_POST['save_options']))

	//oneTarek

	global $current_user;	

	?>

	 <div style="width: 1010px; padding-left: 10px;" class="wrap">

		 <div style="width: 700px; float:left;">

		 <div id="icon-options-general" class="icon32"></div>

		 <h2>Facebook Secret Meta Option</h2>



            <form action="" method="post">

            <table class="form-table">

            <tr><td  valign="top" align="right" width="200"><strong>Author By Info:</strong></td><td><input type="text" name="author_name_custom" value="<?php echo ($fbsm_options['author_name_custom'])? $fbsm_options['author_name_custom'] :'WPDeveloper';?>" size="20"  onblur="javascript: if(this.value=='') {this.value='WPDeveloper';}" onclick="javascript: if(this.value=='WPDeveloper') {this.value='';}"  /></td></tr>

           <tr><td>&nbsp;</td><td>           <em> # For personal blog it should be your full name, like <b>"John Doe"</b></em><br /><br />

            

           <em> # For other site, use your legal name or brand name, like -<br />

            a) The Something LLC ; b) The Tech Journal Desk</em><br /></td></tr>

            <tr><td align="right";><input type="submit" name="save_options" value="Save Options" class='button-primary'/></td><td>&nbsp;</td></tr>

            </table>

            </form>

  <div style=" text-align:center; "><h3><b>Premium version with more features coming soon, <a href="http://wpdeveloper.net/go/FSMPro" target="_blank">check</a>.</b></h3><br /></div>



  <div style=" text-align:center; "><b>Example:(<a href="https://www.facebook.com/WPDeveloperNet/posts/745027968850750" target="_blank">Live</a>)</b><br />
  <!--<a target="_blank" href="http://wpdeveloper.net/free-plugin/facebook-secret-meta/"><img style="border:2px solid #ffffff;" src="<?php echo FBSM_PLUGIN_URL."/fsm-live-example-1rs.jpg" ?>" width="500" alt="Facebook Secret Meta" /></a>-->
  </div>
<!-- embeded example -->
<center>
<div id="fb-root"></div> <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-post" data-href="https://www.facebook.com/WPDeveloperNet/posts/745027968850750" data-width="466"><div class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/WPDeveloperNet/posts/745027968850750">Post</a> by <a href="https://www.facebook.com/WPDeveloperNet">WPDeveloper</a>.</div></div>
<img src="<?php echo FBSM_PLUGIN_URL."/arrow.png"?>" id="embed_overlay_image" />
<style type="text/css">
#embed_overlay_image{
position: absolute;
margin-left: -228px;
margin-top: 422px;
width: 150px;
height: 150px;
}
</style>
<br /><br /><br /><br /><br /><br />
</center>
<!-- end embeded example -->
           

            <div style=" text-align:center; margin-top:10px;">Recommended Plugin for You<br /><a target="_blank" href="https://wordpress.org/plugins/wp-author-report-free/"><img style="border:2px solid #ffffff;" src="<?php echo FBSM_PLUGIN_URL."/wp-author-report-banner.png" ?>" width="690" alt="WP Author Report" /></a></div>

<?php

		

		echo "</div>";

	

		include_once(FBSM_PLUGIN_PATH."fbsm-sidebar.php");

		echo '<div style="clear:both"></div>';

	echo "</div>";



}



?>