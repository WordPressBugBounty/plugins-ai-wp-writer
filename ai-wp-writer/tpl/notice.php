<?php if( ! isset( $_COOKIE['disabled_notice_1'] ) ){ ?>
	<div class="notice notice-info is-dismissible aiwriter-notice logo" data-notice="disabled_notice_1">
		<div class="wpai-logo"></div>
		
		<div class="aiwriter-notice-content">
			<div class="aiwriter-title"><?php _e('Use AI WP Writer with maximum benefit!', 'wp-ai-assistant') ?></div>
			<div class="aiwriter-notice-text"><?php _e('Create high-quality, SEO-optimized articles that drive real traffic - all at unbeatable rates.', 'wp-ai-assistant') ?></div>
			<div class="aiwriter-notice-text"><?php _e('Subscribe now and <b>save up to $100!</b>', 'wp-ai-assistant') ?></div>
			
			
			<div class="aiwriter-notice-buttons">
				<a href="/wp-admin/admin.php?page=wpai-assistant#rates"><button><?php _e('See rates and sign up for subscription!', 'wp-ai-assistant') ?></button></a>
			</div>
		
		</div>
		
	</div>
<?php } ?>

<?php
	if( ! $timer = get_option('activated_time') ){
		$timer = time();
		update_option('activated_time', $timer);
	}
	
	$time = time() - 60*60*24*3;
?>

<?php if( ! isset( $_COOKIE['disabled_notice_2'] ) && $time >= $timer ){ ?>
	<div class="notice notice-info is-dismissible aiwriter-notice halvin" data-notice="disabled_notice_2">
		<div class="aiwriter-notice-content">
			<div class="aiwriter-notice-text"><?php _e('Thank you for using AI WP Writer to generate high quality content!', 'wp-ai-assistant') ?></div>
			<div class="aiwriter-notice-text"><?php _e('WordPress, this motivates us to make the plugin better and helps it develop.', 'wp-ai-assistant') ?></div>
		
			<div class="aiwriter-notice-buttons">
				<a href="https://wordpress.org/support/plugin/ai-wp-writer/reviews/#new-post" target="_blank"><button><?php _e('Ok, you deserve it', 'wp-ai-assistant') ?></button></a>
				<button class="notice-action-button close-notice"><?php _e('I\'ve already done it', 'wp-ai-assistant') ?></button>
				<a href="https://t.me/wpwriter" target="_blank"><button class="notice-action-button"><?php _e('I need support', 'wp-ai-assistant') ?></button></a>
				<button class="notice-action-button close-notice"><?php _e('Not now', 'wp-ai-assistant') ?></button>
			</div>
			
		</div>
	</div>
<?php } ?>