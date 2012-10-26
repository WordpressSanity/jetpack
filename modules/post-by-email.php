<?php

/**
 * Module Name: Post by Email
 * Module Description: Publish posts to your blog directly from your personal email account.
 * First Introduced: 1.9
 * Sort Order: 4
 */

class Jetpack_Post_By_Email {
	function &init() {
		static $instance = NULL;

		if ( !$instance ) {
			$instance = new Jetpack_Post_By_Email;
		}

		return $instance;
	}

	function __construct() {
		add_action( 'init', array( &$this, 'action_init' ) );
	}

	function action_init() {
		add_action( 'profile_personal_options', array( &$this, 'user_profile' ) );
		add_action( 'admin_print_scripts-profile.php', array( &$this, 'profile_scripts' ) );

		add_action( 'wp_ajax_jetpack_post_by_email_enable', array( &$this, 'create_post_by_email_address' ) );
		add_action( 'wp_ajax_jetpack_post_by_email_regenerate', array( &$this, 'regenerate_post_by_email_address' ) );
		add_action( 'wp_ajax_jetpack_post_by_email_disable', array( &$this, 'delete_post_by_email_address' ) );
	}

	function profile_scripts() {
		wp_enqueue_script( 'post-by-email', plugins_url( 'post-by-email.js', __FILE__ ), array( 'jquery' ) );
	}

	function user_profile() {
		$email = $this->get_post_by_email_address();
?>
<table class="form-table">
	<tr>
		<th scope="row"><?php _e( 'Post By Email', 'jetpack' ); ?></th>
		<td>
<?php
		if ( empty( $email ) ) {
			$enable_hidden = '';
			$info_hidden = ' hidden="hidden"';
		}
		else {
			$enable_hidden = ' hidden="hidden"';
			$info_hidden = '';
		}
		// TODO: Add a spinner, or some such feedback for when the API calls are occurring
?>
		<input type="button" name="jp-pbe-enable" id="jp-pbe-enable" value="<? _e( 'Enable Post By Email', 'jetpack' ); ?> "<?php echo $enable_hidden; ?> />
		<div id="jp-pbe-info"<?php echo $info_hidden; ?>>
			<span id="jp-pbe-email-wrapper"><strong><?php _e( 'Email Address:', 'jetpack' ); ?></strong> <span id="jp-pbe-email"><?php echo $email; ?></span></span><br/>
			<input type="button" name="jp-pbe-regenerate" id="jp-pbe-regenerate" value="<? _e( 'Regenerate Address', 'jetpack' ); ?> " />
			<input type="button" name="jp-pbe-disable" id="jp-pbe-disable" value="<? _e( 'Disable Post By Email', 'jetpack' ); ?> " />
		</div>
		</td>
	</tr>
</table>
<?php
	}

	// TODO: API call to get the actual email address
	function get_post_by_email_address() {
		return NULL;
	}

	// TODO: API call to enable PBE
	function create_post_by_email_address() {
		echo 'test@email.address';
		die();
	}

	// TODO: API call to regenerate the email address
	function regenerate_post_by_email_address() {
		echo 'new@email.address';
		die();
	}

	// TODO: API call to disable PBE
	function delete_post_by_email_address() {
		die();
	}
}

Jetpack_Post_By_Email::init();
