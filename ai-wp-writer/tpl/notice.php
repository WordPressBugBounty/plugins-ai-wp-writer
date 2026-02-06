<?php if( ! isset( $_COOKIE['disabled_notice_1'] ) ){ ?>
	<div class="notice notice-info is-dismissible aiwriter-notice logo" data-notice="disabled_notice_1">
		<div class="wpai-logo"></div>
		
		<div class="aiwriter-notice-content">
			<div class="aiwriter-title"><?php echo wp_kses_post( __('Use AI WP Writer with maximum benefit!', 'wp-ai-assistant') ) ?></div>
			<div class="aiwriter-notice-text"><?php echo wp_kses_post( __('Create high-quality, SEO-optimized articles that drive real traffic - all at unbeatable rates.', 'wp-ai-assistant') ) ?></div>
			<div class="aiwriter-notice-text"><?php echo wp_kses_post( __('Subscribe now and <b>save up to $100!</b>', 'wp-ai-assistant') ) ?></div>
			
			
			<div class="aiwriter-notice-buttons">
				<a href="/wp-admin/admin.php?page=wpai-assistant#rates"><button><?php echo wp_kses_post( __('See rates and sign up for subscription!', 'wp-ai-assistant') ) ?></button></a>
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
			<div class="aiwriter-notice-text"><?php echo wp_kses_post( __('Thank you for using AI WP Writer to generate high quality content!', 'wp-ai-assistant') ) ?></div>
			<div class="aiwriter-notice-text"><?php echo wp_kses_post( __('WordPress, this motivates us to make the plugin better and helps it develop.', 'wp-ai-assistant') ) ?></div>
		
			<div class="aiwriter-notice-buttons">
				<a href="https://wordpress.org/support/plugin/ai-wp-writer/reviews/#new-post" target="_blank"><button><?php echo wp_kses_post( __('Ok, you deserve it', 'wp-ai-assistant') ) ?></button></a>
				<button class="notice-action-button close-notice"><?php echo wp_kses_post( __('I\'ve already done it', 'wp-ai-assistant') ) ?></button>
				<a href="https://t.me/wpwriter" target="_blank"><button class="notice-action-button"><?php echo wp_kses_post( __('I need support', 'wp-ai-assistant') ) ?></button></a>
				<button class="notice-action-button close-notice"><?php echo wp_kses_post( __('Not now', 'wp-ai-assistant') ) ?></button>
			</div>
			
		</div>
	</div>
<?php } ?>