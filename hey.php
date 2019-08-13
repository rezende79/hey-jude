<?php
/*
Plugin Name: Hey Jude
Plugin URI: http://wordpress.org/plugins/hey-jude/
Description: This is not just a plugin, it symbolizes the love between a father and his son.
When activated you will randomly see a lyric from <cite>Hey Jude</cite> in the
upper right of your admin screen on every page.
Author: Marcos Rezende
Version: 1.0.0
Author URI: https://www.linkedin.com/in/rezehnde/
*/

function hey_jude_get_lyric() {
	/** These are the lyrics to Hey Jude */
	$lyrics = "Hey Jude, don't make it bad
Take a sad song and make it better
Remember to let her into your heart
Then you can start to make it better
Hey Jude, don't be afraid
You were made to go out and get her
The minute you let her under your skin
Then you begin to make it better
And anytime you feel the pain
Hey Jude, refrain
Don't carry the world upon your shoulders
For well you know that it's a fool
Who plays it cool
By making his world a little colder
Na-na-na, na, na
Na-na-na, na
Hey Jude, don't let me down
You have found her, now go and get her (let it out and let it in)
Remember to let her into your heart (hey Jude)
Then you can start to make it better
So let it out and let it in
Hey Jude, begin
You're waiting for someone to perform with
And don't you know that it's just you
Hey Jude, you'll do
The movement you need is on your shoulder
Na-na-na, na, na
Na-na-na, na, yeah
Hey Jude, don't make it bad
Take a sad song and make it better
Remember to let her under your skin
Then you'll begin to make it better
Better better better better better, ah!";

	// Here we split it into lines.
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line.
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later.
function hey_jude() {
	$chosen = hey_jude_get_lyric();
	$lang   = '';
	if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
		$lang = ' lang="en"';
	}

	printf(
		'<p id="jude"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
		__( 'Quote from Hey Jude song, by John Lennon:', 'hey-jude' ),
		$lang,
		$chosen
	);
}

// Now we set that function up to execute when the admin_notices action is called.
add_action( 'admin_notices', 'hey_jude' );

// We need some CSS to position the paragraph.
function jude_css() {
	echo "
	<style type='text/css'>
	#jude {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #jude {
		float: left;
	}
	.block-editor-page #jude {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#jude,
		.rtl #jude {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
}

add_action( 'admin_head', 'jude_css' );
