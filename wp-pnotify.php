<?php 

/*  
	Plugin Name: WP PNotify
	Author: Rajesh Kumar Sharma
	Author URI: http://sitextensions.com/
	Version: 1.0
	Description: This plugin provides the functionality to show notification messages. You can use this plugin to show pushh notifications on site screen at corner.
	Tags: Message, Notification, Push Notification, Screen Alert, Alert, Alert Message, WP Alert, WP Notification
*/
// Reference URL
// http://notifyjs.com/
// http://sciactive.com/pnotify/#demos-simple



/* 
	Enqueue all assets that will use in pages.
 */
add_action('wp_enqueue_scripts', 'add_pnotify_scripts');
function add_pnotify_scripts(){
	// Add stylesheets.
	wp_enqueue_style('pnotify-custom-min-css', plugin_dir_url( __FILE__ ) . 'assets/pnotify.custom.min.css');

	// Add scripts.
	wp_enqueue_script('pnotify-custom-min-js', plugin_dir_url( __FILE__ ) . 'assets/pnotify.custom.min.js', array( 'jquery' ));
}

/*add_filter('wp_notify_text', 'wp_pnotify_message');
function wp_pnotify_message($message){
	return do_shortcode($message);
}*/

/* 
	Add short that can be used to make notification.
 */
add_shortcode('wp-notify', 'wp_pnotify');
function wp_pnotify($atts){
		$atts = shortcode_atts( array(
							'message' => '',
							'title' => get_bloginfo('name'),
							'width' => '300px',
							'class' => 'custom',
							'delay' => 10000,
							'opacity' => '.8',
							'icon' => '',
							'title_escape' => 0,
		              		'text_escape' => 0,
							'use_plugin_css' => 1,
							), $atts, 'wp-pnotify' );

		$message = $atts['message'];
		// $message = apply_filters('wp_notify_text', $message);

		$title = $atts['title'];
		$width = $atts['width'];
		$class = $atts['class'];
		$delay = $atts['delay'];
		$opacity = $atts['opacity'];
		$icon = $atts['icon'];
		$title_escape = $atts['title_escape'];
		$text_escape = $atts['text_escape'];
	
			if($atts['use_plugin_css']){
				?>
					<style type="text/css">
						.ui-widget{font-size:75%!important;}
						.btn-toolbar{line-height:28px;}
						.btn-toolbar h4{margin:1em 0 .3em;}
						.btn-toolbar .btn-group{vertical-align:middle;}
						.panel .btn{margin-top:5px;}
						.ui-pnotify.custom .ui-pnotify-container{background-color:#4873A8!important;background-image:none!important;border:none!important;}
						.ui-pnotify.custom .ui-pnotify-title,.ui-pnotify.custom .ui-pnotify-text{font-family:Arial,Helvetica,sans-serif!important;text-shadow:2px 2px 3px black!important;font-size:10pt!important;color:#FFF!important;padding-left:20px!important;line-height:1!important;text-rendering:geometricPrecision!important;}
						.ui-pnotify.custom .ui-pnotify-title{font-weight:bold;}
						.ui-pnotify.custom .ui-pnotify-icon{float:left;}
						.ui-pnotify.custom .picon{margin:3px;width:33px;height:33px;}
						.ui-pnotify.stack-bottomright{right:auto;top:auto;left:auto;bottom:auto;}
						.ui-pnotify.stack-custom{top:200px;left:200px;right:auto;}
						.ui-pnotify.stack-custom2{top:auto;left:auto;bottom:200px;right:200px;}
						.ui-pnotify.stack-bar-top{right:0;top:0;}
						.ui-pnotify.stack-bar-bottom{margin-left:15%;right:auto;bottom:0;top:auto;left:auto;}
					</style>
				<?php 
			}
		?>

		    <script type="text/javascript">

		        jQuery(function($){

		        	<?php 
		        		$replace_from = array(PHP_EOL, '\n', '<br>', '<br/>', '<BR/>', '<BR>', '<br />', '<BR />');
		        		$replace_to = array('','','','','','','','');
		        		$message = str_replace($replace_from, $replace_to, $message);
		        		// $message = chop($message);
		        		// $message = htmlspecialchars($message);
		        		// $message = addslashes($message);
		        		// $message = strip_tags($message);
		        		// $message = preg_replace("/[\n\r]/"," ",$message);
		        		$message = trim($message);
		        	?>

		        	var message = '<?php echo $message; ?>';
		        	new PNotify({
		              title: '<?php echo $title; ?>',
		              text: message,
		              title_escape: <?php echo $title_escape; ?>,
		              text_escape: <?php echo $text_escape; ?>,
		              addclass: '<?php echo $class; ?>',
		              width: '<?php echo $width; ?>',
		              // icon: 'picon picon-32 picon-fill-color',
		              icon: '<?php echo $icon; ?>',
		              opacity: <?php echo $opacity; ?>,
		              delay: <?php echo $delay; ?>,
		              nonblock: {
		                nonblock: true
		              }
		            });

		        });
		    </script>
		
		<?php 
}