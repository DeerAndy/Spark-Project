<?php
/**
 * @package by_my_side
 * @version 1.7.2
 */
/*
Plugin Name: Hello Dolly
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.7.2
Author URI: http://ma.tt/
*/

function by_my_side_get_lyric() {
	/** These are the lyrics to Hello Dolly */
	$lyrics = "It's takin' time, all this fear I pushed back to move on
Beating me like a panic attack since you've gone
And if I never fear to be more alone, I do now
I turn to see my faded tracks in the snow
I've come so far with no idea where to go
And if I never fear to be more alone, I do now
I do now
I need you to tell me you'll be right by my side
When I feel alone, you'll be right by my side, ooh
It's takin' hold of a fool with a fondness for pain
And turn to run without a chance to explain
And if I never thought I'd fall like the rain, I do now
I do now
I don't look back to spot where I fell
Don't you look back, and don't you ever tell
'Cause we know pride, it doesn't heal all that well
All that well, all that well
I need you to tell me you'll be right by my side
When I feel alone, you'll be right by my side
In a crazy world, you'll be right by my side
I need you to tell me you'll be right by my side
When I feel alone, you'll be right by my side
In a crazy world...
And I need you to tell me you'll be right by my side
When I feel alone, you'll be right by my side
You'll be right by my side";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function by_my_side() {
	$chosen = by_my_side_get_lyric();
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
