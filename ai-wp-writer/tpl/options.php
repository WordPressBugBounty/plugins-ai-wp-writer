<div id="aiassist-settings">
	<div class="wpai-header">
		<div class="wpai-logo-block">
			<div class="f-left">
				<div id="wpai-logo"></div>
			</div>
		</div>
		
		<div class="wpai-info">
			<?php if( isset( $this->options->token ) ){ ?>
				<div class="wpai-symbols">
					<div class="wpai-symbols-item <?php echo (int) @$this->info->limit < 1 ? 'aiassist-warning-limits aiassist-empty-limit' : '' ?>">
						<div id="wpai-symbols-text"><?php _e('Extra credits:', 'wp-ai-assistant') ?></div>
						<div id="wpai-symbols"><?php echo number_format( (int) @$this->info->limit, 0, ' ', ' ' )?></div>
					</div>
					<div class="wpai-symbols-item <?php echo (int) @$this->info->sLimit < 1 ? 'aiassist-warning-limits aiassist-empty-limit' : '' ?>">
						<div id="wpai-symbols-text-subscribe"><?php _e('Subscription credits:', 'wp-ai-assistant') ?></div>
						<div id="wpai-symbols-subscribe"><?php echo number_format( (int) @$this->info->sLimit, 0, ' ', ' ' )?></div>	
					</div>
				</div>
			<?php } ?>
			
			<div class="wpai-telegram">
				<div id="wpai-doc"></div>
				
				<div class="help-block">
					<div id="wpai-title"><?php _e('Need help?', 'wp-ai-assistant') ?></div>
					<div onclick="window.open('https://t.me/wpwriter', '_blank')" id="telegram"><?php _e('Write in Telegram', 'wp-ai-assistant') ?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="aiassist-tabs">
		<div class="aiassist-tab active" data-tab="settings"><?php _e('Settings', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="rates"><?php _e('Payment & Pricing', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="generations"><?php _e('Bulk generation', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?> <?php echo ! in_array( @$this->info->subscribe->type, [ 'pro', 'premium' ] ) ? 'aiassist-lock' : ''?>" data-tab="rewrite"><?php _e('Rewrite', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?> <?php echo ! @$this->info->subscribe->expire ? 'aiassist-lock' : ''?>" data-tab="images"><?php _e('Image uniqueization', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="guide"><?php _e('Generation in editor', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="referrals"><?php _e('Affiliate Program', 'wp-ai-assistant') ?></div>
	</div>
	
	
	<div class="aiassist-tab-data active" data-tab="settings">
		<form method="POST" class="wpai-form">
			<div class="license">
				<div class="input-block">
					<div class="title"><?php _e('Thank you for choosing AI WP Writer. API key settings:', 'wp-ai-assistant') ?></div>
					<?php if( ! isset( $this->options->token ) ){ ?>
						<label class="title"><p style="font-size: 16px; line-height:1.5;"><?php _e('<b>Getting started with the plugin is easy and free!</b> </br> 1. Fill out the registration form below. </br> 2. The API key will be sent to your email address. If you do not receive the email please check your spam folder. </br> 3. Save the API key in the appropriate field. After registration you will receive 10000 free credits. One key can be used on multiple sites, all sites will have a common balance and one common subscription. </br></br> Notice! If the site is hosted on localhost, the plugin may not work correctly, and free credits will not be accrued. Use the plugin for sites hosted on a server or web hosting. </br> For a quicker understanding of the plugin functionality, check out the documentation on our <a href="https://aiwpw.com/docs/" target="_blank">official website</a>. </br> If you still have any questions, write to us via <a href="https://t.me/wpwriter" target="_blank">Telegram</a>. <br /><br /> <b>Enter the API key:</b>', 'wp-ai-assistant') ?></p></label>
					<?php } ?>
					
					<input name="token" value="<?php echo esc_attr( @$this->options->token ) ?>" /><br /><br /><br />
				</div>

				<div class="row">
					<label>
						<input type="checkbox" name="cron" <?php echo @$this->options->cron || @$this->info->cron_enabled || ! isset( $this->options->token ) ? 'checked' : ''?> />
						<?php _e('This enables requests to be sent from the plugin server to the website. This is required for background tasks such as bulk generation, rewriting or ensuring image uniqueness. This allows you to generate content when there is no traffic on the website and the admin panel is closed.', 'wp-ai-assistant') ?>
					</label>
				</div>
			
				<div class="row">
					<button name="save"><?php _e('Save', 'wp-ai-assistant') ?></button>
				</div>
			</div>
			<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('aiassist'); ?>" />
		</form>

		<?php if( @$this->options->token ){ ?>
			<div class="title"><?php _e('Statistics', 'wp-ai-assistant') ?></div>
			<form id="aiassist-stat">
				
				<div class="aiassist-stat-item">
					<button name="step" value="<?php echo esc_attr( date('Y-m-d') )?>|<?php echo esc_html( date('Y-m-d') )?>"><?php _e('Day', 'wp-ai-assistant') ?></button>
					<button name="step" value="<?php echo esc_attr( date('Y-m-d', time() - 60*60*24*7) )?>|<?php echo esc_html( date('Y-m-d') )?>"><?php _e('Week', 'wp-ai-assistant') ?></button>
					<button name="step" value="<?php echo esc_attr( date('Y-m-d', time() - 60*60*24*30) )?>|<?php echo esc_html( date('Y-m-d') )?>"><?php _e('Month', 'wp-ai-assistant') ?></button>
				</div>
				
				<div class="aiassist-stat-item">
					<?php if( @$this->info->hosts ){ ?>
						<select name="host">
							<option value="all"><?php _e('All domains', 'wp-ai-assistant') ?></option>
							<?php foreach( $this->info->hosts as $host ){ ?>
								<option value="<?php echo esc_attr( $host ) ?>"><?php echo esc_html( $host ) ?></option>
							<?php } ?>
						</select>
					<?php } ?>
					
					<input type="date" name="dateStart" required />
					<input type="date" name="dateEnd" required />	
					<button id="aiassist-show-report"><?php _e('Show report', 'wp-ai-assistant') ?></button>
				</div>
				
			</form>

			<div id="area-chat"></div>
		<?php } ?>
		
		<?php if( ! @$this->options->token ){ ?>
			<div class="wpai-tabs">
				<div class="wpai-tab active" data-action="signUp"><?php _e('Sign up', 'wp-ai-assistant') ?></div>
			</div>
			<form method="POST" class="wpai-form" id="aiassist-sign" data-action="signUp">
				<div id="wpai-errors-messages"></div>
				<div class="row">
					<div><?php _e('Mail', 'wp-ai-assistant') ?></div>
					<input type="email" name="email" required />
				</div>
				
				<div class="row">
					<div><?php _e('Your password', 'wp-ai-assistant') ?></div>
					<input type="password" name="password" required />
				</div>
				
				<div class="row password2">
					<div><?php _e('Repeat password', 'wp-ai-assistant') ?></div>
					<input type="password" name="password2" />
					
					<label> 
						<input type="checkbox" name="license" required /> <?php _e('By registering, you agree to', 'wp-ai-assistant') ?> <a href="https://aiwpwriter.com/privacy-policy/" target="_blank"><?php _e('privacy policy', 'wp-ai-assistant') ?></a>, <a href="https://aiwpwriter.com/publichnaja-oferta-o-zakljuchenii-dogovora-ob-okazanii-uslug/" target="_blank"><?php _e('offer', 'wp-ai-assistant') ?></a> <?php _e('and', 'wp-ai-assistant') ?> <a href="https://aiwpwriter.com/user-agreement/" target="_blank"><?php _e('user agreement', 'wp-ai-assistant') ?></a>.
					</label>
				</div>
				
				<div class="row">
					<button><?php _e('Registration', 'wp-ai-assistant') ?></button>
				</div>
				
			</form>
		<?php } ?>
		
		<div class="aiassist-how-to-use-info">
			<h3><?php _e('How to use the AI WP Writer plugin', 'wp-ai-assistant') ?></h3>
			<ul>
				<li><?php _e('- After entering the key, a plugin widget appears under the Classic Editor and Gutenberg text editor.', 'wp-ai-assistant') ?></li>
				<li><?php _e('- To generate images anywhere in the new articles, as for the old ones, there is an <b>AI image creator</b> button. In the Gutenberg editor, add a new block and type <b>AI image creator</b> in the widget search.', 'wp-ai-assistant') ?></li>
				<li><?php _e('- The <b>AI assist</b> button will help to regenerate a piece of text you do not like or generate a text fragment in the editor where the cursor is. It works in the classic editor. To regenerate, select a piece of text, press <b>AI assist</b>, use standard or enter your own prompt. You can use regeneration or generation of text in an arbitrary place for any articles, including already published ones.', 'wp-ai-assistant') ?></li>
				<li><?php _e('- The <b>Bulk generation</b> tab is used to create articles in large volumes based on a list of key phrases. You can schedule a certain number of articles to be automatically published every day.', 'wp-ai-assistant') ?></li>
				<li><?php _e('- The <b>Rewrite</b> tab is used when you need to rewrite the text preserving its meaning. It can be used both for the articles on your own site and for the rewriting articles on third-party sites by url list.', 'wp-ai-assistant') ?></li>
			</ul>
		</div>
		
	</div>
	
	
	<?php if( @$this->info->success ){ ?>
	
		<div class="aiassist-tab-data" data-tab="images">
			<h2 class="generations-header"><?php _e('Image regeneration and uniqueization', 'wp-ai-assistant') ?></h2>
			<div class="center"><?php _e('You can make images on your website unique by using neural networks. How it works: we take the original image, generate a similar image and automatically replace it on the site pages. Supported extensions: PNG (.png), JPEG (.jpeg and .jpg), WEBP (.webp), non-animated GIF (.gif). Images must not be subject to censorship or other restrictions imposed by neural networks. If the image cannot be regenerated, we skip it and move on to the next one.', 'wp-ai-assistant') ?><br /></div>
			<br />
		
			<div>
				<div><?php _e('Regenerate all images of posts in the category:', 'wp-ai-assistant') ?></div>
				<select id="cat-images">
					<option value="0"><?php _e('Categories', 'wp-ai-assistant') ?></option>
					<?php if( $cats ){ ?>
						<?php foreach( $cats as $cat ){ ?>
							<option value="<?php echo esc_attr( $cat->term_id )?>"><?php echo esc_html( $cat->name )?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>	
				
			<div class="aiassist-images-options-items">
				<div class="aiassist-images-type-label"><?php _e('Regenerate images for the following post types:', 'wp-ai-assistant') ?></div>
					
				<div class="mb-15 images-block-type">
					<label><input type="checkbox" id="replace-images-all"/><?php _e('Regenerate all images on this site', 'wp-ai-assistant') ?></label>
					<?php if( $types = get_post_types( [ 'public' => true ] ) ){ unset( $types['attachment'] ); ?>
						<?php foreach( $types as $type ){?>
							<label><input type="checkbox" name="images_type[]" value="<?php echo esc_attr( $type )?>" <?php echo esc_attr( @in_array($type, ( @$options->post_type ? @$options->post_type : [] ) ) ? 'checked' : '' )?> /> <?php echo esc_html( $type )?></label>
						<?php } ?>
					<?php } ?>
				</div>
				
				<div class="aiassist-images-item-block">	
					<label><?php _e('Or specify a list of URLs where you would like to regenerate images:', 'wp-ai-assistant') ?></label>
					<textarea id="aiassist-images-item"></textarea>
				</div>
			</div>
			
			<div>
				<div><?php _e('Image generation model', 'wp-ai-assistant') ?></div>
				<select name="aiassist-image-model" class="aiassist-images-options" id="aiassist-images-model">
					<option value="flux" <?php echo @$images['imageModel'] == 'flux' ? 'selected' : '' ?>>FLUX schnell</option>
					<option value="dalle" <?php echo @$images['imageModel'] == 'dalle' ? 'selected' : '' ?>>Dalle 3</option>
					<option value="gptImage" <?php echo @$images['imageModel'] == 'gptImage' ? 'selected' : '' ?>>GPT-image</option>
					<option value="midjourney" <?php echo @$images['imageModel'] == 'midjourney' ? 'selected' : '' ?>>Midjourney</option>
				</select>
			</div>
			
			<br />
				<div><?php echo _e('<b>Important!</b> To make generation work faster in the background, the option to send requests from the plugin server to the site must be enabled in the <b>Settings</b> tab.', 'wp-ai-assistant') ?></div>
			
			<div class="aiassist-options-images">
				<button id="start-images" <?php echo @$images['start'] ? 'disabled' : '' ?>><?php _e('Start', 'wp-ai-assistant') ?></button>
				<button id="stop-images" <?php echo ! @$images['start'] ? 'disabled' : '' ?>><?php _e('Stop', 'wp-ai-assistant') ?></button>
				<button id="reset-images"><?php _e('Reset', 'wp-ai-assistant') ?></button>
				<button id="restore-images" class="aiassist-orange"><?php _e('Restore original / removing generated images', 'wp-ai-assistant') ?></button>
				<button id="remove-images" class="aiassist-orange"><?php _e('Remove original images', 'wp-ai-assistant') ?></button>
			</div>
			
			<?php
				$images_all = count( $images['attachments'] );
				$images_compleate = count(array_filter($images['attachments'], function($attach) {
					return array_key_exists('replace_id', $attach);
				}));
			?>
			<div id="aiassist-images-status">
				<?php if( ! @$this->options->token ){ ?>
					<span class="aiassist-warning-limits"><?php _e('You have not added the API key! The key is sent to the mail after registration in the plugin. Register and add the key from the email to the special field in the plugin settings and generation will become available.', 'wp-ai-assistant') ?></span>
				<?php } elseif( ( (int) @$this->info->limit + (int) @$this->info->sLimit ) < 1 ){ ?>
					<span class="aiassist-warning-limits"><?php _e('The balance has reached its limits, after replenishing the balance, the process will automatically continue', 'wp-ai-assistant') ?></span>
				<?php } else { ?>
					<?php if( @$images['start'] && @$images_all > $images_compleate ){ ?>
						<?php _e('The process of regeneration is underway...', 'wp-ai-assistant') ?>
					<?php } elseif( ! @$images['start'] && isset( $images['attachments'] ) && @$images_all < $images_compleate ){ ?>
						<?php _e('The regeneration process has been stopped.', 'wp-ai-assistant') ?>
					<?php } elseif( isset( $images['attachments'] ) && @$images_all >= $images_compleate ){ ?>
						<?php _e('The regeneration process is complete.', 'wp-ai-assistant') ?>
					<?php } ?>
				<?php } ?>
			</div>
			
			<div id="aiassist-images-progress">
				<?php _e('Regenerated', 'wp-ai-assistant') ?> <b id="aiassist-images-compleat-count"><?php echo $images_compleate ?> </b>
				<?php _e('images of', 'wp-ai-assistant') ?> <b id="aiassist-images-all-count"><?php echo $images_all ?></b>
			</div>

		</div>
		
		<form id="aiassist-get-bonus" class="aiassist-tab-data" data-tab="referrals">
			
			<div class="aiassist-white-bg">
				<?php _e('Attract new users to the plugin and earn money!<br />New users who enter the referral code will receive a 15% discount on their first deposit, <br />and you will receive 10% on your balance from all webmaster payments. <br />The more active users you can attract, the more money you will make. <br />Payment is made on request, within a day, to the USDT trc20 wallet. <br />A network commission of 1.4 USDT is charged on the payout. <br />By participating in the referral program you agree with <a href="https://aiwpwriter.com/user-agreement">rules</a>.', 'wp-ai-assistant') ?>
			</div>
			<br /><br />
			
			<div class="aiassist-bonus-item">
				<b><?php _e('Referral Code:', 'wp-ai-assistant') ?></b> <span id="aiassist-promocode"><?php echo esc_html( @$this->info->referral )?></span>
			</div>
			
			<div class="aiassist-bonus-item">
				<b><?php _e('Your balance:', 'wp-ai-assistant') ?></b> <?php echo (float) @$this->info->bonus->amount_usdt ?>$
			</div>
			
			<div class="aiassist-bonus-item">
				<b><?php _e('Attracted referrals:', 'wp-ai-assistant') ?></b> <?php echo (int) @$this->info->bonus->count ?>
			</div>
			
			<div class="aiassist-bonus-item">
				<b><?php _e('Method for receiving the payout:', 'wp-ai-assistant') ?></b>
				<div>
					<select name="method" required>
						<option value="usdt">USDT trc-20</option>
					</select>
				</div>
			</div>
			
			<div class="aiassist-bonus-item">
				<b><?php _e('Specify the wallet number to receive the payment:', 'wp-ai-assistant') ?></b>
				<div>
					<input name="wallet" required />
				</div>
			</div>
			
			<div class="aiassist-bonus-item">
				<b><?php _e('Please provide us with your Telegram or email to contact you if any additional questions arise:', 'wp-ai-assistant') ?></b>
				<div>
					<input name="info" required />
				</div>
			</div>
			
			
			<div class="aiassist-bonus-item">
			
				<?php if( isset( $this->info->bonus->payment_request ) ){ ?>
					<div><?php _e('The request for payment has been accepted:', 'wp-ai-assistant') ?> <?php echo date( 'd.m.Y H:i', $this->info->bonus->payment_request ) ?></div>
				<?php } ?>
				
				<?php if( (int) @$this->info->bonus->min_payment > (int) @$this->info->bonus->amount ){ ?>
					<div><?php _e('Minimum payout amount:', 'wp-ai-assistant') ?> <?php echo (int) @$this->info->bonus->min_payment ?> $</div>
				<?php } ?>
				
				<button class="aiassist-button <?php echo isset( $this->info->bonus->payment_request ) || $this->info->bonus->min_payment > (int) @$this->info->bonus->amount ? 'disabled' :'' ?>"><?php _e('Request payment', 'wp-ai-assistant') ?></button>
			</div>
		
		</form>
		
		<div class="aiassist-tab-data" data-tab="guide">
		
			<div class="aiassist-white-bg">
				<?php _e('You can generate articles directly in the Wordpress editor. The plugin functionality is located at the bottom of the page, under the main editor. <br />You can also generate images in any articles and in any place pressing the button (or widget in Gutenberg editor) AI image creator. <br />To regenerate any text fragment in any articles use the AI Assist button. To do it, select the text fragment, press AI Assist and the <b>Regenerate</b> button.', 'wp-ai-assistant') ?>
			</div>
			
			<div class="aiassist-guide-button">
				<a href="/wp-admin/post-new.php#ai_assistant" target="_blank" id="aiassist-new-post"><?php _e('Generate article', 'wp-ai-assistant') ?></a>
				<a href="/wp-admin/post-new.php?post_type=page#ai_assistant" target="_blank" id="aiassist-new-page"><?php _e('Generate page', 'wp-ai-assistant') ?></a>
			</div>
		
		</div>
		
		<div class="aiassist-tab-data" data-tab="rewrite">
			
			<h2 class="generations-header"><?php _e('Rewrite', 'wp-ai-assistant') ?></h2>
			
			<div class="aiassist-rewrite-items">
			
				<div class="center"><?php _e('You can rewrite your entire site, individual pages, categories.  Also there is an opportunity to rewrite pages of third-party sites by url. We tried to maintain the highest quality of rewritten third-party sites. It is important to take into account that third-party sites have different markup, layout and structure, that’s why in the rewritten article can occur unwanted elements. For testing we recommend you to do a few pages. If you find a lot of unwanted elements in your articles, feel free to contact our support team. We are ready to customize the plugin for specific third-party sites for active users of the plugin.', 'wp-ai-assistant') ?><br /></div>
				
				<div><?php _e('Rewrite mode', 'wp-ai-assistant') ?></div>
				<select name="rewrite-split" id="aiassist-rewrite-split" class="aiassist-rewrite-options">
					<option value="3" <?php echo esc_attr( @$rewrites['split'] == 3 ? 'selected' : '' )?>><?php _e('Rewriting the entire text', 'wp-ai-assistant') ?></option>
					<option value="1" <?php echo esc_attr( @$rewrites['split'] == 1 ? 'selected' : '' )?>><?php _e('Paragraph by paragraph', 'wp-ai-assistant') ?></option>
					<option value="2" <?php echo esc_attr( @$rewrites['split'] == 2 ? 'selected' : '' )?>><?php _e('Rewrite by segments between headings', 'wp-ai-assistant') ?></option>
				</select>
				<br /><br />
				
				
				<div>
					<div><?php _e('Category of rerighting', 'wp-ai-assistant') ?></div>
					<select class="cat-rewrite">
						<option value="0"><?php _e('Categories', 'wp-ai-assistant') ?></option>
						<?php if( $cats ){ ?>
							<?php foreach( $cats as $cat ){ ?>
								<option value="<?php echo esc_attr( $cat->term_id )?>"><?php echo esc_html( $cat->name )?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				
				<div class="aiassist-rewrite-type-label"><?php _e('Specify the types of records that need to be rewritten:', 'wp-ai-assistant') ?></div>
				
				<div class="mb-15 rewrite-block-type">
					<label><input type="checkbox" id="rewrite_all"/><?php _e('Rewrite all the articles on this site', 'wp-ai-assistant') ?></label>
					<?php if( $types = get_post_types( [ 'public' => true ] ) ){ unset( $types['attachment'] ); ?>
						<?php foreach( $types as $type ){?>
							<label><input type="checkbox" name="rewrite_type[]" value="<?php echo esc_attr( $type )?>" <?php echo esc_attr( @in_array($type, ( @$options->post_type ? @$options->post_type : [] ) ) ? 'checked' : '' )?> /> <?php echo esc_html( $type )?></label>
						<?php } ?>
					<?php } ?>
				</div>
				
				<div class="aiassist-rewrite-item-block">	

					<label><?php _e('Or specify a list of URLs you want to rewrite. You can add any links, including links on third-party sites', 'wp-ai-assistant') ?></label>
					
					<textarea class="aiassist-rewrite-item"></textarea>
					
					<div class="aiassist-cats-item">
						<?php _e('Choose the category in which to place the articles after rewriting:', 'wp-ai-assistant') ?>
						<select class="cats-item">
							<option value="0"><?php _e('Category', 'wp-ai-assistant') ?></option>
							<?php if( $cats ){ ?>
								<?php foreach( $cats as $cat ){ ?>
									<option value="<?php echo esc_attr( $cat->term_id )?>"><?php echo esc_html( $cat->name )?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
					
				</div>
				
				
			</div>
			
			<div class="aiassist-item-repeater">
				<button id="aiassist-addItemRewrite"><?php _e('Add another list of URLs for another category', 'wp-ai-assistant') ?></button>
			</div>
			
			<div class="aiassist-option-item"><?php _e('Promt for article rewriting. This promt will be used to rewrite titles, paragraphs, meta title and description.', 'wp-ai-assistant') ?></div>
			
			<br /><br /><br />
			<div class="relative">
				<button type="button" class="aiassist-set-default-promts"><?php _e('Restore the default prompt.', 'wp-ai-assistant') ?></button>
			</div>
			
			<?php $lang_id = 0; ?>
			<?php if( @$this->info->promts->lang ){ $lang_id = $this->getDefaultLangId(); ?>
				<div class="relative">
					<div class="aiassist-lang-promts-item">
						<label><?php _e('Prompt language: ', 'wp-ai-assistant') ?></label>
						<select class="aiassist-lang-promts">
							<?php foreach( $this->info->promts->lang as $k => $lang ){ ?>
								<?php
									if( @$this->steps['promts']['rewrite_lang'] == $k )
										$lang_id = (int) $k;
								?>
							
								<option value="<?php echo (int) $k ?>" <?php echo @$this->steps['promts']['rewrite_lang'] == $k ? 'selected' : '' ?> ><?php echo esc_html( $lang ) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			<?php } ?>
			
			<textarea class="aiassist-prom" id="aiassist-rewrite-prom"><?php echo esc_textarea( isset( $this->steps['promts']['rewrite'][ $lang_id ] ) ? trim( $this->steps['promts']['rewrite'][ $lang_id ] ) : @$this->info->promts->rewrite[ $lang_id ] )?></textarea>
			
			
			<div class="aiassist-option-item">
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-excude-h1" <?php echo @$rewrites['excude_h1'] ? 'checked' : '' ?> />
					<?php echo _e('Don\'t rewrite h1 header', 'wp-ai-assistant') ?>
				</label>
				
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-excude-title" <?php echo @$rewrites['excude_title'] ? 'checked' : '' ?> />
					<?php echo _e('Don\'t rewrite meta title', 'wp-ai-assistant') ?>
				</label>
				
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-excude-desc" <?php echo @$rewrites['excude_desc'] ? 'checked' : '' ?> />
					<?php echo _e('Don\'t rewrite meta description', 'wp-ai-assistant') ?>
				</label>
			</div>
			
			
			<div class="aiassist-option-item">
				<?php _e('Images generation for rewrited article based on headlines. If you leave the checkboxes empty, the rewrited version will be done without images.', 'wp-ai-assistant') ?>
				
				<label class="aiassist-option-item">
					<select class="aiassist-rewrite-options" id="aiassist-rewrite-multi-images">
						<option value="without" <?php echo esc_attr( @$rewrites['pictures'] == 'without' ? 'selected' : '' ) ?>><?php echo _e('Generate an article without pictures', 'wp-ai-assistant') ?></option>
						<option value="all" <?php echo esc_attr( @$rewrites['pictures'] == 'all' ? 'selected' : '' ) ?>><?php echo _e('Generate pictures for all headlines', 'wp-ai-assistant') ?></option>
						<option value="h2" <?php echo esc_attr( @$rewrites['pictures'] == 'h2' ? 'selected' : '' ) ?>><?php echo _e('Generate pictures for h2 headlines only', 'wp-ai-assistant') ?></option>
					</select>
				</label>
				
				<label class="aiassist-option-item">
					<div><?php echo _e('Maximum number of pictures to generate', 'wp-ai-assistant') ?></div>
					<input type="number" class="aiassist-rewrite-options" id="aiassist-rewrite-max-pictures" value="<?php echo @$rewrites['max_pictures'] ? (int) @$rewrites['max_pictures'] : '' ?>" min="0" />
				</label>
				
				
				
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-thumb" <?php echo esc_attr( @$rewrites['thumb'] ? 'checked' : '' ) ?> <?php echo esc_attr( @$rewrites['images'] && ! @$rewrites['thumb'] ? 'disabled' : '' ) ?> /> <?php _e('Generate the thumbnail (record image)', 'wp-ai-assistant') ?>
				</label>
				
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-draft" <?php echo esc_attr( @$rewrites['draft'] ? 'checked' : '' ) ?> /> <?php _e('Send generated articles to draft (only for third-party sites rewriting)', 'wp-ai-assistant') ?>
				</label>
				
				<div>
					<div><?php _e('Text generation model', 'wp-ai-assistant') ?></div>
					<select name="aiassist-text-model" class="aiassist-rewrite-options" id="aiassist-rewrite-text-model">
						<option value="gpt3" <?php echo @$rewrites['textModel'] == 'gpt3' ? 'selected' : '' ?>>GPT-4.1 mini</option>
						<option value="gpt4_nano" <?php echo @$rewrites['textModel'] == 'gpt4_nano' ? 'selected' : '' ?>>GPT-4.1 nano</option>
						<option value="gpt4" <?php echo @$rewrites['textModel'] == 'gpt4' ? 'selected' : '' ?>>GPT-4.1</option>
						<option value="gpt_o3_mini" <?php echo @$rewrites['textModel'] == 'gpt_o3_mini' ? 'selected' : '' ?>>o3-mini</option>
					</select>
					<a href="<?php echo get_locale() == 'ru_RU' ? 'https://aiwpwriter.com/prices/' : 'https://aiwpw.com/prices/ ' ?>" target="_blank" class="aiassist-small"><?php _e('View rates', 'wp-ai-assistant') ?></a>
				</div>
				
				<div>
					<div><?php _e('Image generation model', 'wp-ai-assistant') ?></div>
					<select name="aiassist-image-model" class="aiassist-rewrite-options" id="aiassist-rewrite-image-model">
						<option value="flux" <?php echo @$rewrites['imageModel'] == 'flux' ? 'selected' : '' ?>>FLUX schnell</option>
						<option value="dalle" <?php echo @$rewrites['imageModel'] == 'dalle' ? 'selected' : '' ?>>Dalle 3</option>
						<option value="gptImage" <?php echo @$rewrites['imageModel'] == 'gptImage' ? 'selected' : '' ?>>GPT-image</option>
						<option value="midjourney" <?php echo @$rewrites['imageModel'] == 'midjourney' ? 'selected' : '' ?>>Midjourney</option>
					</select>
				</div>
				
			</div>
			
			<div>
				<?php _e('The text of the original articles from your own site will be replaced by the rewritten text. If the third-party site pages are rewritten, new articles will be created. You can use the “Restore original texts” buttons only if you rewrite articles on your own site.', 'wp-ai-assistant') ?><br />
				<?php echo _e('<b>Important!</b> To make generation work faster in the background, the option to send requests from the plugin server to the site must be enabled in the <b>Settings</b> tab.', 'wp-ai-assistant') ?>
			</div>
			
			<div class="aiassist-option-item">
				<button id="start-rewrite-generations" <?php echo @$rewrites['start'] ? 'disabled' : '' ?>><?php _e('Start a rewrite', 'wp-ai-assistant') ?></button>
				<button id="stop-rewrite-generations" <?php echo ! @$rewrites['start'] ? 'disabled' : '' ?>><?php _e('Stop rewriting', 'wp-ai-assistant') ?></button>
				<button id="clear-rewrite-generations"><?php _e('Clear URL list', 'wp-ai-assistant') ?></button>
				<button id="restore-rewrite-generations" class="aiassist-orange"><?php _e('Restore all original texts', 'wp-ai-assistant') ?></button>
			</div>
			
			
			<div id="aiassist-rewrite-status">
				<?php if( ! @$this->options->token ){ ?>	
					<span class="aiassist-warning-limits"><?php _e('You have not added the API key! The key is sent to the mail after registration in the plugin. Register and add the key from the email to the special field in the plugin settings and generation will become available.', 'wp-ai-assistant') ?></span>
				<?php } elseif( ( (int) @$this->info->limit + (int) @$this->info->sLimit ) < 1 ){ ?>
					<span class="aiassist-warning-limits"><?php _e('Limits have expired, to continue generating (rewriting) top up your balance!', 'wp-ai-assistant') ?></span>
				<?php } else { ?>
						
					<?php if( @$rewrites['start'] ){ ?>
							<?php _e('The process of rewriting articles is in progress, the information is updated automatically. If this does not happen, refresh the browser page to see the current list of articles that have been rewritten.', 'wp-ai-assistant') ?>
					<?php } elseif( ! @$rewrites['start'] && isset( $rewrites['posts'] ) && @$rewrites['counter'] < count( $rewrites['posts'] ) ){ ?>
						<?php _e('The process of rewriting articles has been suspended.', 'wp-ai-assistant') ?>
					<?php } elseif( isset( $rewrites['posts'] ) && @$rewrites['counter'] >= count( $rewrites['posts'] ) ){ ?>
							<?php _e('The process of rewriting articles is complete.', 'wp-ai-assistant') ?>
					<?php } ?>
					
				<?php } ?>
			</div>
			<div class="aiassist-option-item <?php echo ! isset( $rewrites['start'] ) ? 'hidden' : ''?>" id="aiassist-rewrite-progress"><?php _e('Rewriting completed', 'wp-ai-assistant') ?> <span id="aiassist-rewrite-count-publish"><?php echo (int) @$rewrites['publish'] ?></span> <?php _e('articles from', 'wp-ai-assistant') ?> <?php echo isset( $rewrites['posts'] ) ? (int) count( @$rewrites['posts'] ) : 0 ?></div>
			
			<div class="aiassist-rewrites-queue">
				<?php if( ! empty( $rewrites['posts'] ) ){ $queue = false; ?>
					<?php foreach( $rewrites['posts'] as $rewrite ){ ?>
						<div title="<?php echo esc_attr( isset( $rewrite['url'] ) ? $rewrite['url'] : $rewrite['title'] ) ?>">
							<?php if( isset( $rewrite['post_id'] ) ){ ?>
								<?php $queue = false; ?>
								<div class="aiassist-rewrite-queue"><a href="<?php echo get_edit_post_link( $rewrite['post_id'] ) ?>" target="_blank"><?php echo esc_attr( isset( $rewrite['url'] ) ? $rewrite['url'] : $rewrite['title'] ) ?></a> 
									
									<span class="aiassist-queue-status">
										<?php if( isset( $rewrite['restore'] ) ){ ?>
											<?php _e('Restored', 'wp-ai-assistant') ?>
										<?php } else { ?>
											<?php _e('Generated', 'wp-ai-assistant') ?>
										<?php } ?>
									</span> 
								
									<?php if( isset( $rewrite['revision_id'] ) && ! isset( $rewrite['restore'] ) ){ ?>
										<span class="aiassist-post-restore aiassist-orange" post_id="<?php echo (int) $rewrite['post_id'] ?>" revision_id="<?php echo (int) $rewrite['revision_id'] ?>"><?php _e('Restore original text', 'wp-ai-assistant') ?></span>
									<?php } ?>
								</div>
							
							<?php } else { ?>
								<div class="aiassist-rewrite-queue aiassist-queue">
									<span class="aiassist-queue-rewrite">
										<?php echo esc_attr( isset( $rewrite['url'] ) ? $rewrite['url'] : $rewrite['title'] ) ?>
									</span> 
									<span class="aiassist-queue-status">
										<?php if( ! $queue ){ ?>
											<?php if( (int) @$rewrite['check'] < 60 && ( @$this->info->limit > 1 || @$this->info->sLimit > 1 ) ){ ?>
												<?php _e('Generation in progress', 'wp-ai-assistant') ?>
											<?php } else { ?>
												
												<?php _e('Suspended', 'wp-ai-assistant') ?>
											<?php } ?>
										<?php } else { ?>
											<?php _e('In line', 'wp-ai-assistant') ?>
										<?php } ?>
									</span> 
								</div>
							<?php $queue = true; ?>
							<?php } ?>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		
		</div>
		
		
		<div class="aiassist-tab-data" data-tab="rates">
			
			<h2 class="rates-header"><?php _e('Payment & Pricing', 'wp-ai-assistant') ?></h2>
			
			<div class="pay-methods">
				<div class="pay-method active">
					<div class="robokassa"></div>
					<div class="pay-method-label visa"><?php _e('Visa, Mastercard, Мир, ЮMoney', 'wp-ai-assistant') ?></div>
				</div>
				
				<div class="pay-method">
					<div class="cryptocloud"></div>
					<div class="pay-method-label"><?php _e('USDT, Bitcoin, Ethereum', 'wp-ai-assistant') ?></div>
				</div>
			</div>
			
			<?php if( isset( $this->info->rates ) ){ ?>
			
				<form method="POST" class="aiassist-promocode">
					<label>
						<span><?php _e('Promo code:', 'wp-ai-assistant') ?></span>
						<input name="promocode" value="<?php echo isset( $_POST['promocode'] ) ? esc_attr( $_POST['promocode'] ) : '' ?>" />
						<button id="aiassist-promocode-set"><?php _e('Apply', 'wp-ai-assistant') ?></button>
						
						<?php if( isset( $_POST['promocode'] ) ){ ?>
							<div class="aiassist-promocode-status <?php echo ! isset( $this->info->rates->discount ) ? 'error-discount' : '' ?>">
								<?php if( isset( $this->info->rates->discount ) ){ ?> 
									<?php _e('Promo code activated!', 'wp-ai-assistant') ?>
								<?php } else { ?>
									<?php _e('The promo code is not correct!', 'wp-ai-assistant') ?>
								<?php } ?> 
							</div>
						<?php } ?>
						
					</label>
				</form>
				
				<div class="aiassist-rates-wrap">
					
					<div class="aiassist-rates-items">
						
						<div class="aiassist-rates-item">
							<?php if( @$this->info->rates->subscribe_basic_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							<div class="aiassist-rate-title">
								<div><?php _e('Basic', 'wp-ai-assistant') ?></div>
								<div><span data-usdt="<?php echo (float) @$this->info->rates->subscribe_basic_rate_usdt ?>$"><?php echo (float) @$this->info->rates->subscribe_basic_rate ?><?php _e('$', 'wp-ai-assistant') ?></span>/<?php _e('month', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><?php _e('Instead of', 'wp-ai-assistant') ?> <i data-usdt="<?php echo $rateMainUsdt = round( @$this->info->rates->subscribe_basic_symbols / 1000 * @$this->info->price_usdt )?>$"><?php echo $rateMain = round( @$this->info->rates->subscribe_basic_symbols / 1000 * @$this->info->price ) ?><?php _e('$', 'wp-ai-assistant') ?></i></div>
								<div><?php _e('Savings of', 'wp-ai-assistant') ?> <span data-usdt="<?php echo round( $rateMainUsdt - @$this->info->rates->subscribe_basic_rate_usdt )?>$"><?php echo $rateMain - @$this->info->rates->subscribe_basic_rate ?><?php _e('$', 'wp-ai-assistant') ?></span>*</div>	
							</div>
							<div class="aiassist-rate-title"><?php echo number_format( @$this->info->rates->subscribe_basic_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?>/<?php _e('month', 'wp-ai-assistant') ?></div>
							
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->subscribe_basic_rate_usdt / @$this->info->rates->subscribe_basic_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->subscribe_basic_rate / @$this->info->rates->subscribe_basic_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							
							<div class="aiassist-rate-desc">
								<?php _e('How much content can be generated<br />~ 4 400 000 characters GPT-4.1 nano**<br />~ 2 640 000 characters GPT-4.1 mini**<br />~ 660 000 characters GPT-4.1**<br /><br />~ 1 320 000 characters o3-mini**<br />~ 942 images FLUX Schnell<br />~ 165 generations Midjourney v7<br />~ 188 images Dalle 3<br />~ 165 images GPT-image', 'wp-ai-assistant') ?>			
							</div>
							<div class="aiassist-rate-checklist">
								<div class="aiassist-rate-check"><?php _e('Neural Networks: GPT-4.1, GPT-4.1-mini, GPT-4.1-nano, o3-mini (reasoning), Midjourney v7, Dalle 3, GPT-image, FLUX.', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Bulk generation and generation articles in the editor', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('AI Assist, AI image creator', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Image uniqueization', 'wp-ai-assistant') ?></div>
							</div>
							
							<?php if( @$this->info->subscribe->type == 'basic' ){ ?>
								<button type="button" class="aiassist-subscribe-type"><?php _e('Subscription active', 'wp-ai-assistant') ?></button>
							<?php } else {?>
								<button type="button" class="aiassist-buy" data-type="subscribe_basic"><?php _e('Subscribe', 'wp-ai-assistant') ?></button>
							<?php } ?>
						</div>
						
						
						<div class="aiassist-rates-item">
							
							<?php if( @$this->info->rates->subscribe_pro_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							
							<div class="aiassist-rate-title">
								<div>Pro</div>
								<div><span data-usdt="<?php echo (float) @$this->info->rates->subscribe_pro_rate_usdt ?>$"><?php echo (float) @$this->info->rates->subscribe_pro_rate ?><?php _e('$', 'wp-ai-assistant') ?></span>/<?php _e('month', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><?php _e('Instead of', 'wp-ai-assistant') ?> <i data-usdt="<?php echo $rateMainUsdt = round( @$this->info->rates->subscribe_pro_symbols / 1000 * @$this->info->price_usdt ) ?>$"><?php echo $rateMain = round( @$this->info->rates->subscribe_pro_symbols / 1000 * @$this->info->price ) ?><?php _e('$', 'wp-ai-assistant') ?></i></div>
								<div><?php _e('Savings of', 'wp-ai-assistant') ?> <span data-usdt="<?php echo $rateMainUsdt - @$this->info->rates->subscribe_pro_rate_usdt ?>$"><?php echo $rateMain - @$this->info->rates->subscribe_pro_rate ?><?php _e('$', 'wp-ai-assistant') ?></span>*</div>
							</div>
							
							<div class="aiassist-rate-title"><?php echo number_format( @$this->info->rates->subscribe_pro_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?>/<?php _e('month', 'wp-ai-assistant') ?></div>
							
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->subscribe_pro_rate_usdt / @$this->info->rates->subscribe_pro_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->subscribe_pro_rate / @$this->info->rates->subscribe_pro_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							
							<div class="aiassist-rate-desc">
								<?php _e('How much content can be generated<br />~ 13 666 000 characters GPT-4.1 nano**<br />~ 8 200 000 characters GPT-4.1 mini**<br />~ 2 050 000 characters GPT-4.1**<br />~ 4 100 000 characters o3-mini**<br />~ 2 928 images FLUX Schnell<br />~ 512 generations Midjourney v7<br />~ 585 images Dalle 3<br />~ 512 images GPT-image', 'wp-ai-assistant') ?>						
							</div>
							<div class="aiassist-rate-checklist">
								<div class="aiassist-rate-check"><?php _e('Neural Networks: GPT-4.1, GPT-4.1-mini, GPT-4.1-nano, o3-mini (reasoning), Midjourney v7, Dalle 3, GPT-image, FLUX.', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Bulk generation and generation articles in the editor', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('AI Assist, AI image creator', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Rewrite articles on your site and pages from other sites', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Image uniqueization', 'wp-ai-assistant') ?></div>
							</div>
							
							<?php if( @$this->info->subscribe->type == 'pro' ){ ?>
								<button type="button" class="aiassist-subscribe-type"><?php _e('Subscription active', 'wp-ai-assistant') ?></button>
							<?php } else {?>
								<button type="button" class="aiassist-buy" data-type="subscribe_pro"><?php _e('Subscribe', 'wp-ai-assistant') ?></button>
							<?php } ?>
							
						</div>
						
						
						<div class="aiassist-rates-item">
							<?php if( @$this->info->rates->subscribe_premium_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							<div class="aiassist-rate-title">
								<div>Premium</div>
								<div><span data-usdt="<?php echo (float) @$this->info->rates->subscribe_premium_rate_usdt ?>$"><?php echo (float) @$this->info->rates->subscribe_premium_rate ?><?php _e('$', 'wp-ai-assistant') ?></span>/<?php _e('month', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><?php _e('Instead of', 'wp-ai-assistant') ?> <i data-usdt="<?php echo $rateMainUsdt = round( @$this->info->rates->subscribe_premium_symbols / 1000 * @$this->info->price_usdt ) ?>$"><?php echo $rateMain = round( @$this->info->rates->subscribe_premium_symbols / 1000 * @$this->info->price ) ?><?php _e('$', 'wp-ai-assistant') ?></i></div>
								<div><?php _e('Savings of', 'wp-ai-assistant') ?> <span data-usdt="<?php echo $rateMainUsdt - @$this->info->rates->subscribe_premium_rate_usdt ?>$"><?php echo $rateMain - @$this->info->rates->subscribe_premium_rate ?><?php _e('$', 'wp-ai-assistant') ?></span>*</div>
							</div>
							<div class="aiassist-rate-title"><?php echo number_format( @$this->info->rates->subscribe_premium_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?>/<?php _e('month', 'wp-ai-assistant') ?></div>
							
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->subscribe_premium_rate_usdt / @$this->info->rates->subscribe_premium_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->subscribe_premium_rate / @$this->info->rates->subscribe_premium_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							
							<div class="aiassist-rate-desc">
								<?php _e('How much content can be generated<br />~ 33 333 000 characters GPT-4.1 nano**<br />~ 20 000 000 characters GPT-4.1 mini**<br />~ 5 000 000 characters GPT-4.1**<br />~ 10 000 000 characters o3-mini**<br />~ 7 142 images FLUX Schnell<br />~ 1 250 generations Midjourney v7<br />~ 1 428 images Dalle 3<br />~ 1 250 images GPT-image', 'wp-ai-assistant') ?>
							</div>
							<div class="aiassist-rate-checklist">
								<div class="aiassist-rate-check"><?php _e('Neural Networks: GPT-4.1, GPT-4.1-mini, GPT-4.1-nano, o3-mini (reasoning), Midjourney v7, Dalle 3, GPT-image, FLUX.', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Bulk generation and generation articles in the editor', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('AI Assist, AI image creator', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Rewrite articles on your site and pages from other sites', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Image uniqueization', 'wp-ai-assistant') ?></div>
							</div>
							
							<?php if( @$this->info->subscribe->type == 'premium' ){ ?>
								<button type="button" class="aiassist-subscribe-type"><?php _e('Subscription active', 'wp-ai-assistant') ?></button>
							<?php } else {?>
								<button type="button" class="aiassist-buy" data-type="subscribe_premium"><?php _e('Subscribe', 'wp-ai-assistant') ?></button>
							<?php } ?>
							
						</div>	
						
					</div>
					
					
					<div class="aiassist-rates-free">
						<div class="aiassist-rate-title"><?php _e('Free plan', 'wp-ai-assistant') ?></div>
						<div class="aiassist-rates-items">
							<div class="aiassist-rates-free-item">
								<?php _e('Once you sign up, you will receive 10,000 free credits. You can also buy credits in packages or for any amount. These credits do not expire and remain on your balance until you use them.', 'wp-ai-assistant') ?>
							</div>
							<div class="aiassist-rate-checklist aiassist-rates-free-item">
								<div class="aiassist-rate-check"><?php _e('Bulk generation', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('Generation in the editor', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('AI Assist', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-checklist aiassist-rates-free-item">
								<div class="aiassist-rate-check"><?php _e('Neural networks: GPT-4.1-mini, GPT-4.1-nano, FLUX', 'wp-ai-assistant') ?></div>
								<div class="aiassist-rate-check"><?php _e('AI image creator', 'wp-ai-assistant') ?></div>
							</div>
						</div>
					</div>
					
					
					<div class="aiassist-rates-note-block">
						<?php _e('* If you buy the same number of credits that you get by subscribing to the program. <br />** Payment is spent only for generating characters or images. No hidden fees! You don\'t pay for tokens used to send context. You do not pay for sending context, you do not pay for sending requests for generation, you do not pay for tokens used to markup articles, you do not pay for spaces. articles, payment for whitespace is not deducted.', 'wp-ai-assistant') ?>
					</div>
					
					<div class="aiassist-rate-title"><?php _e('Add extra credits by packages or any amount.', 'wp-ai-assistant') ?></div>
					<div class="aiassist-rates-note-block center"><?php _e('Limits purchased by packages or any amount will <b>not disappear.</b>', 'wp-ai-assistant') ?></div>
					
					
					<div class="aiassist-rates-items">
						
						<div class="aiassist-rates-package">
							<?php if( @$this->info->rates->packege_base_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							<div class="aiassist-rate-title">
								<div data-usdt="<?php echo (float) @$this->info->rates->packege_base_rate_usdt ?>$"><?php echo (float) @$this->info->rates->packege_base_rate ?><?php _e('$', 'wp-ai-assistant') ?></div>
								<div><?php echo number_format( @$this->info->rates->packege_base_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->packege_base_rate_usdt / @$this->info->rates->packege_base_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->packege_base_rate / @$this->info->rates->packege_base_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							<button type="button" class="aiassist-buy" data-type="base"><?php _e('Buy a package', 'wp-ai-assistant') ?></button>
						</div>
					
						<div class="aiassist-rates-package">
							<?php if( @$this->info->rates->packege_pro_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							<div class="aiassist-rate-title">
								<div data-usdt="<?php echo (float) @$this->info->rates->packege_pro_rate_usdt ?>$"><?php echo (float) @$this->info->rates->packege_pro_rate ?><?php _e('$', 'wp-ai-assistant') ?></div>
								<div><?php echo number_format( @$this->info->rates->packege_pro_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->packege_pro_rate_usdt / @$this->info->rates->packege_pro_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->packege_pro_rate / @$this->info->rates->packege_pro_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							<button type="button" class="aiassist-buy" data-type="professional"><?php _e('Buy a package', 'wp-ai-assistant') ?></button>
						</div>
						
						<div class="aiassist-rates-package">
							<?php if( @$this->info->rates->packege_popular_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							
							<div class="aiassist-rate-title">
								<div data-usdt="<?php echo (float) @$this->info->rates->packege_popular_rate_usdt ?>$"><?php echo (float) @$this->info->rates->packege_popular_rate ?><?php _e('$', 'wp-ai-assistant') ?></div>
								<div><?php echo number_format( @$this->info->rates->packege_popular_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->packege_popular_rate_usdt / @$this->info->rates->packege_popular_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->packege_popular_rate / @$this->info->rates->packege_popular_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							<button type="button" class="aiassist-buy" data-type="popular"><?php _e('Buy a package', 'wp-ai-assistant') ?></button>
						</div>
						
						<div class="aiassist-rates-package">
							<?php if( @$this->info->rates->packege_max_best ){ ?>
								<div class="aiassist-popular"><?php _e('Popular', 'wp-ai-assistant') ?></div>
							<?php } ?>
							<div class="aiassist-rate-title">
								<div data-usdt="<?php echo (float) @$this->info->rates->packege_max_rate_usdt ?>$"><?php echo (float) @$this->info->rates->packege_max_rate ?><?php _e('$', 'wp-ai-assistant') ?></div>
								<div><?php echo number_format( @$this->info->rates->packege_max_symbols, 0, ' ', ' ' ) ?> <?php _e('credits', 'wp-ai-assistant') ?></div>
							</div>
							<div class="aiassist-rate-info">
								<div><span data-usdt="<?php echo @round( @$this->info->rates->packege_max_rate_usdt / @$this->info->rates->packege_max_symbols * 1000000 ) ?>$"><?php echo @round( @$this->info->rates->packege_max_rate / @$this->info->rates->packege_max_symbols * 1000000 ) ?><?php _e('$', 'wp-ai-assistant') ?></span> - <?php _e('1 million credits', 'wp-ai-assistant') ?></div>
							</div>
							<button type="button" class="aiassist-buy" data-type="max"><?php _e('Buy a package', 'wp-ai-assistant') ?></button>
						</div>
					
					</div>
					
					<div class="aiassist-rates-custom">
						<div class="aiassist-rate-title"><?php _e('Payment for any amount', 'wp-ai-assistant') ?></div>
						<div class="aiassist-rate-info"><?php _e('Enter amount to top up your balance (minimum 5$). Credits do not disappear, you can generate text and images at any time.', 'wp-ai-assistant') ?></div>
						
						<form id="aiassist-custom-buy" class="aiassist-buy-form">
							<input type="number" step="1" min="<?php echo (float) @$this->info->rates->min_buy ?>" id="out_summ" placeholder="<?php _e('5 $', 'wp-ai-assistant') ?>" data-usdt="5 $" required />
							<button type="submit" class="aiassist-buy" data-type="custom"><?php _e('Buy', 'wp-ai-assistant') ?></button>
						</form>	
						
						<div>
							<?php _e('Price', 'wp-ai-assistant') ?> 
							<b data-usdt="<?php echo (float) @$this->info->price_usdt ?> $"><?php echo (float) @$this->info->price ?> <?php _e('$', 'wp-ai-assistant') ?></b> 
							<?php _e('for 1000 credits.', 'wp-ai-assistant') ?>
						</div>
					</div>
					
					<?php if( @$this->info->subscribe->expire ){ ?>
						<div class="aiassist-rates-custom aiassist-subscribe-block">
							<div class="aiassist-rate-info"><?php _e('You have an active subscription ', 'wp-ai-assistant') ?> <b><?php echo esc_html( @$this->info->subscribe->type ) ?></b> <?php _e('until', 'wp-ai-assistant') ?> <?php echo date('d.m.Y', (int) @$this->info->subscribe->expire ) ?></div>
							<button type="button" class="aiassist-buy" data-type="subscribe_<?php echo esc_attr( @$this->info->subscribe->type ) ?>"><?php _e('Renew subscription', 'wp-ai-assistant') ?></button>
						</div>
					<?php } ?>
					
					
					<div class="aiassist-rate-title"><?php _e('Rates Questions and Answers', 'wp-ai-assistant') ?></div>
					<br /><br />
					
					<div class="aiassist-rates-note-wrap">
						<div class="aiassist-rate-note-title"><?php _e('I already have a subscription. Can I purchase additional credits?', 'wp-ai-assistant') ?></div>
						<div class="aiassist-rates-note-block">
							<?php _e('Yes, you can. Subscription credits and purchased credits in packages are counted separately. First of all, the subscription credits are deducted from the balance, if they have run out, the credits purchased in packages will be deducted.', 'wp-ai-assistant') ?>
						</div>
					</div>
						
					<div class="aiassist-rates-note-wrap">
						<div class="aiassist-rate-note-title"><?php _e('Do purchased credits disappear?', 'wp-ai-assistant') ?></div>
						<div class="aiassist-rates-note-block">
							<?php _e('The credits included in the subscription are renewed every 30 days. Credits purchased in packages or for any amount will not disappear and will remain on your balance until you use them.', 'wp-ai-assistant') ?>
						</div>
					</div>
					
				</div>
			<?php } ?>
			
		</div>
		
			
		<div class="aiassist-tab-data" data-tab="generations">
			<h2 class="generations-header"><?php _e('Bulk generation', 'wp-ai-assistant') ?></h2>
			
			<div class="aiassist-article-items">
			
				<div id="aiassist-selection-box"></div>
				<div class="aiassist-article-item">
					<div><?php _e('Add article topics in a list in the left column, each row being a new article. If desired, add one or more keywords, separated by commas, in the right column.', 'wp-ai-assistant') ?></div>
					
					<div class="aiassist-multi-items">
						<div class="aiassist-multi-themes">
							<label class="aiassist-multi-item-label"><?php _e('Main topic of the article', 'wp-ai-assistant') ?></label>
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
						</div>
						
						<div class="aiassist-multi-keywords">
							<label class="aiassist-multi-item-label"><?php _e('Key phrases', 'wp-ai-assistant') ?></label>
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
							<input class="aiassist-multi-item" />
						</div>
					</div>
					
					
					<div class="aiassist-cats-item">
						<?php _e('Select a category to publish articles to', 'wp-ai-assistant') ?>
						
						<select class="cats-item">
							<option value="0"><?php _e('Category', 'wp-ai-assistant') ?></option>
							<?php if( $cats ){ ?>
								<?php foreach( $cats as $cat ){ ?>
									<option value="<?php echo esc_attr( $cat->term_id )?>"><?php echo esc_html( $cat->name )?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
				
				
			</div>
			
			<div class="aiassist-item-repeater">
				<button id="aiassist-addItemArticle"><?php _e('Add another list of keys for another category', 'wp-ai-assistant') ?></button>
			</div>
			
			
			<div class="aiassist-option-item"><?php _e('Prompt for generating articles. Instead of the {key} variable, key phrases from the list are substituted.', 'wp-ai-assistant') ?></div>
			
			<br /><br /><br />
			<div class="relative">
				<button type="button" class="aiassist-set-default-promts"><?php _e('Restore default prompts', 'wp-ai-assistant') ?></button>
			</div>
				
			<?php if( @$this->info->promts->lang ){ $lang_id = $this->getDefaultLangId(); ?>
				<div class="relative">
					<div class="aiassist-lang-promts-item">
						<label><?php _e('Prompts language: ', 'wp-ai-assistant') ?></label>
						<select class="aiassist-lang-promts">
							<?php foreach( $this->info->promts->lang as $k => $lang ){ ?>
								<?php
									if( @$this->steps['promts']['multi_lang'] == $k )
										$lang_id = (int) $k;
								?>
							
								<option value="<?php echo (int) $k ?>" <?php echo @$this->steps['promts']['multi_lang'] == $k ? 'selected' : '' ?> ><?php echo esc_html( $lang ) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<div>
				<?php $promt = esc_textarea( @$this->steps['promts']['multi'][ $lang_id ] ? trim( $this->steps['promts']['multi'][ $lang_id ] ) : @$this->info->promts->multi[ $lang_id ] ); ?>
				<textarea class="aiassist-prom" id="aiassist-generation-prom" data-check="{key}"><?php echo $promt ?></textarea>
				<?php if( strpos( $promt, '{key}') === false ){ ?>
					<div class="aiassist-check-key"><?php _e('There is no variable {key} (or {header}) in your prompt. Add it in the place where the key word should be. If you generate an article without the variable, the text won’t be relevant to your topic.', 'wp-ai-assistant') ?></div>
				<?php } ?>
				
				<?php $promt = esc_textarea( @$this->steps['promts']['multi_keywords'][ $lang_id ] ? trim( $this->steps['promts']['multi_keywords'][ $lang_id ] ) : @$this->info->promts->multi_keywords[ $lang_id ] ); ?>
				<textarea class="aiassist-prom aiassist-keywords-area" id="aiassist-generation-prom-keywords"><?php echo $promt ?></textarea>
			</div>
			
			<div class="aiassist-option-item">
				<div>
					<?php $promt = esc_attr( @$this->steps['promts']['multi_title'][ $lang_id ] ? $this->steps['promts']['multi_title'][ $lang_id ] : @$this->info->promts->multi_title[ $lang_id ] )?>
					<?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-title-prom-multi" class="aiassist-prom" data-check="{key}" value="<?php echo $promt ?>" />
					<?php if( strpos( $promt, '{key}') === false ){ ?>
						<div class="aiassist-check-key"><?php _e('There is no variable {key} (or {header}) in your prompt. Add it in the place where the key word should be. If you generate an article without the variable, the text won’t be relevant to your topic.', 'wp-ai-assistant') ?></div>
					<?php } ?>
				</div>
				
				<div>
					<?php $promt = esc_attr( @$this->steps['promts']['multi_desc'][ $lang_id ] ? $this->steps['promts']['multi_desc'][ $lang_id ] : @$this->info->promts->multi_desc[ $lang_id ] ); ?>
					<?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-desc-prom-multi" class="aiassist-prom" data-check="{key}" value="<?php echo $promt ?>" />
					<?php if( strpos( $promt, '{key}') === false ){ ?>
						<div class="aiassist-check-key"><?php _e('There is no variable {key} (or {header}) in your prompt. Add it in the place where the key word should be. If you generate an article without the variable, the text won’t be relevant to your topic.', 'wp-ai-assistant') ?></div>
					<?php } ?>
				</div>
			</div>
			
			<div class="aiassist-option-item">
				<?php _e('How many articles should be generated in the specified time period. If the field is left blank, articles for all specified keys will be generated as soon as possible.<br /> Specify the number of articles:', 'wp-ai-assistant') ?>
				<div>
					<input type="number" class="aiassist-auto-options" id="publish-article-in-day" value="<?php echo @$autoGen['publishInDay'] ? (int) $autoGen['publishInDay'] : '' ?>" min=0 />
				</div>
				
				<?php _e('How often articles should be generated. (For example, if you specify 2, then the number of articles you specified earlier will be generated every 2 days).<br /> Specify the number of days:', 'wp-ai-assistant') ?>
				<div>
					<input type="number" class="aiassist-auto-options" id="publish-article-every-day" value="<?php echo @$autoGen['publishEveryDay'] ? (int) $autoGen['publishEveryDay'] : 1 ?>" min=0 />
				</div>
			</div>
			
			<div class="aiassist-option-item">
				<?php _e('The images to generate for the article. If you leave the input form blank, the articles will be generated without images.', 'wp-ai-assistant') ?>
				
				<label class="aiassist-option-item">
					<select class="aiassist-auto-options" id="aiassist-auto-multi-images">
						<option value="without" <?php echo esc_attr( @$autoGen['pictures'] == 'without' ? 'selected' : '' ) ?>><?php echo _e('Generate an article without pictures', 'wp-ai-assistant') ?></option>
						<option value="all" <?php echo esc_attr( @$autoGen['pictures'] == 'all' ? 'selected' : '' ) ?>><?php echo _e('Generate pictures for all headlines', 'wp-ai-assistant') ?></option>
						<option value="h2" <?php echo esc_attr( @$autoGen['pictures'] == 'h2' ? 'selected' : '' ) ?>><?php echo _e('Generate pictures for h2 headlines only', 'wp-ai-assistant') ?></option>
					</select>
				</label>
				
				<label class="aiassist-option-item">
					<div><?php echo _e('Maximum number of pictures to generate', 'wp-ai-assistant') ?></div>
					<input type="number" class="aiassist-auto-options" id="aiassist-max-pictures" value="<?php echo @$autoGen['max_pictures'] ? (int) $autoGen['max_pictures'] : '' ?>" min="0" />
				</label>
				
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-auto-options" id="aiassist-auto-thumb" <?php echo esc_attr( @$autoGen['thumb'] ? 'checked' : '' ) ?> <?php echo esc_attr( @$autoGen['images'] && ! @$autoGen['thumb'] ? 'disabled' : '' ) ?> /> <?php _e('Generate the thumbnail (record image)', 'wp-ai-assistant') ?>
				</label>
				
				<label class="aiassist-option-item">
					<input type="checkbox" class="aiassist-auto-options" id="aiassist-auto-draft" <?php echo esc_attr( @$autoGen['draft'] ? 'checked' : '' ) ?> /> <?php _e('Send the generated articles to draft', 'wp-ai-assistant') ?>
				</label>
				
				<div>
					<div><?php _e('Text generation model', 'wp-ai-assistant') ?></div>
					<div class="aiassist-select-wrap">
						<div class="aiassist-select-lable">GPT-4.1 mini</div>
						<div class="aiassist-select">	
							<div class="aiassist-option" data-value="gpt3">GPT-4.1 mini</div>
							<div class="aiassist-option" data-value="gpt4_nano">GPT-4.1 nano</div>
							<div class="aiassist-option <?php echo ! @$this->info->subscribe->expire ? 'aiassist-lock' : ''?>" data-value="gpt4">GPT-4.1</div>
							<div class="aiassist-option <?php echo ! @$this->info->subscribe->expire ? 'aiassist-lock' : ''?>" data-value="gpt_o3_mini">o3-mini</div>
							<input type="hidden" name="aiassist-text-model" class="aiassist-auto-options" id="aiassist-change-text-model" value="gpt3" />
						</div>
					</div>
					<a href="<?php echo get_locale() == 'ru_RU' ? 'https://aiwpwriter.com/prices/' : 'https://aiwpw.com/prices/ ' ?>" target="_blank" class="aiassist-small"><?php _e('Prices', 'wp-ai-assistant') ?></a>
				</div>
				
				<div>
					<div><?php _e('Image generation model', 'wp-ai-assistant') ?></div>
					<div class="aiassist-select-wrap">
						<div class="aiassist-select-lable">FLUX schnell</div>
						<div class="aiassist-select aiassist-image-model-auto">	
							<div class="aiassist-option" data-value="flux">FLUX schnell</div>
							<div class="aiassist-option <?php echo ! @$this->info->subscribe->expire ? 'aiassist-lock' : ''?>" data-value="midjourney">Midjourney</div>
							<div class="aiassist-option <?php echo ! @$this->info->subscribe->expire ? 'aiassist-lock' : ''?>" data-value="dalle">Dalle 3</div>
							<div class="aiassist-option <?php echo ! @$this->info->subscribe->expire ? 'aiassist-lock' : ''?>" data-value="gptImage">GPT-image</div>
							<input type="hidden" name="aiassist-image-model" class="aiassist-auto-options"  id="aiassist-image-model" value="flux" />
						</div>
					</div>
				</div>
				<br />
				<div><?php echo _e('<b>Important!</b> To make generation work faster in the background, the option to send requests from the plugin server to the site must be enabled in the <b>Settings</b> tab.', 'wp-ai-assistant') ?></div>
			</div>
			
			<div class="aiassist-option-item">
				<button id="start-articles-generations" <?php echo @$autoGen['start'] ? 'disabled' : '' ?>><?php _e('Start generating articles', 'wp-ai-assistant') ?></button>
				<button id="stop-articles-generations" <?php echo ! @$autoGen['start'] ? 'disabled' : '' ?>><?php _e('Stop generation', 'wp-ai-assistant') ?></button>
				<button id="clear-articles-generations"><?php _e('Clear the list of key phrases', 'wp-ai-assistant') ?></button>
			</div>
			
			
			<?php if( ! @$this->options->token ){ ?>
				
				<span class="aiassist-warning-limits"><?php _e('You have not added the API key! The key is sent to the mail after registration in the plugin. Register and add the key from the email to the special field in the plugin settings and generation will become available.', 'wp-ai-assistant') ?></span>
			
			<?php } elseif( ( (int) @$this->info->limit + (int) @$this->info->sLimit ) < 1 ){ ?>
			
				<span class="aiassist-warning-limits"><?php _e('Limits have expired, top up your balance to continue generating!', 'wp-ai-assistant') ?></span>
			
			<?php } else { ?>
			
				<div id="aiassist-generation-status">
					<?php if( @$autoGen['start'] ){ ?>
						
						<?php _e('The process of generating articles is in progress, the information is updated automatically. If this does not happen, refresh the browser page to see the current list of generated articles.', 'wp-ai-assistant') ?>
					
					<?php } elseif( ! @$autoGen['start'] && @$autoGen['count'] && @$autoGen['publish'] <= @$autoGen['count'] ){ ?>
						
						<?php _e('The article generation process has been suspended.', 'wp-ai-assistant') ?>
					
					<?php } elseif( @$autoGen['publish'] >= @$autoGen['count'] ){ ?>
							<?php _e('The article generation process is complete.', 'wp-ai-assistant') ?>
					<?php } ?>
				</div>
			<?php } ?>
			
			<div class="aiassist-option-item <?php echo ! isset( $autoGen['start'] ) ? 'hidden' : ''?>" id="aiassist-generation-progress"><?php _e('Generated by', 'wp-ai-assistant') ?>  <span id="aiassist-count-publish"><?php echo (int) @$autoGen['publish'] ?></span>  <?php _e('articles from', 'wp-ai-assistant') ?> <?php echo (int) @$autoGen['count'] ?></div>

			<div class="aiassist-articles-queue">
				<?php if( ! empty( $autoGen['articles'] ) ){ $queue = false; ?>
					<?php foreach( $autoGen['articles'] as $id => $article ){ ?>
						<?php if( isset( $article['post_id'] ) ){ ?>
							<?php $queue = false; ?>
							<div class="aiassist-article-queue"><a href="<?php echo get_edit_post_link( $article['post_id'] ) ?>" target="_blank"><?php echo esc_attr( $article['theme'] ) ?></a> <span class="aiassist-queue-status"><?php _e('Generated by', 'wp-ai-assistant') ?></span></div>
						<?php } else { ?>
						
							<div class="aiassist-article-queue aiassist-queue"><div class="aiassist-article-item-close" data-key="<?php echo (int) $id ?>"></div> 
								<span class="aiassist-queue-keyword"><?php echo esc_attr( $article['theme'] ) ?></span> 
								<span class="aiassist-queue-status">
									<?php if( ! $queue ){ ?>
										
										<?php if( ( (int) @$article['check'] < 60 && ( @$this->info->limit > 1 || @$this->info->sLimit > 1 ) ) && @$autoGen['start'] && ( ! @$autoGen['counter'][ date('Ymd') ] || ! @$autoGen['publishInDay'] || @$autoGen['counter'][ date('Ymd') ] < @$autoGen['publishInDay'] ) ){ ?>
											<?php _e('Generation in progress', 'wp-ai-assistant') ?>
										<?php } else { ?>
											<?php _e('Suspended', 'wp-ai-assistant') ?>
										<?php } ?>
									
									<?php } else { ?>
											<?php _e('In line', 'wp-ai-assistant') ?>
									<?php } ?>
									
								</span>
							</div>
						
						<?php $queue = true; ?>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</div>
			
		</div>
		
	<?php } ?>
	
</div>