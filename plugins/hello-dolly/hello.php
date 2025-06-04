<?php
/**
 * @package hello_dolly
 * @author Andy Crawford
 * @version 1.7.2
 */
/*
Plugin Name: Hello Dolly
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: One of my favorite songs by the band Copeland. When activated you will randomly see a lyric from <cite>By My Side</cite> in the upper right of your admin screen on every page.
Author: Andy Crawford
Version: 1.7.2
Author URI: http://dev.khadijacrawford.com/
*/

include "lyrics.php";

// This just echoes the chosen line, we'll position it later.
function by_my_side() {
	$chosen = by_my_side_random_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'By My Side by Copeland:', 'By-My-Side' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'by_my_side' );

// We need some CSS to position the paragraph.
function dolly_css() {
	echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'dolly_css' );
