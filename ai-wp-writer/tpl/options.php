<div id="aiassist-settings">
	<div class="wpai-header">
		<div class="wpai-logo-block">
			<div class="f-left">
				<div id="wpai-logo"></div>
			</div>
		</div>
		
		<div class="wpai-info">
			<?php if( isset( $this->options->token ) ){ ?>
				<div class="wpai-symbols <?php echo (int) @$this->info->limit < 1000 ? 'wpai-warning-limits' : '' ?>">
					<div id="wpai-symbols-text"><?php _e('Limits left:', 'wp-ai-assistant') ?></div>
					<div id="wpai-symbols"><?php echo number_format( (int) @$this->info->limit, 0, ' ', ' ' )?></div>
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
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="rewrite"><?php _e('Rewrite', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="guide"><?php _e('Generation in editor', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab <?php echo ! esc_attr( @$this->options->token ) ? 'aiassist-tab-inactive' : ''?>" data-tab="referrals"><?php _e('Affiliate Program', 'wp-ai-assistant') ?></div>
	</div>
	
	<form id="aiassist-get-bonus" class="aiassist-tab-data" data-tab="referrals">
		
		<div class="aiassist-white-bg">
			<?php _e('Attract new users to the plugin and earn from it!<br />New users who enter the referral code will receive a 15% discount on their first deposit, <br />and you will receive a 10% payout on your first and subsequent webmaster deposits. <br />The more you attract active users, the more your earnings will be. <br />Payment is made on request, within a day, to the USDT trc20 wallet. <br />A network commission of 1.4 USDT is charged on the payout. <br />By participating in the referral program you agree with <a href="https://aiwpwriter.com/user-agreement/">rules</a>.', 'wp-ai-assistant') ?>
		</div>
		<br /><br />
		
		<div class="aiassist-bonus-item">
			<b><?php _e('Referral Code:', 'wp-ai-assistant') ?></b> <span id="aiassist-promocode"><?php echo esc_html( @$this->info->referral )?></span>
		</div>
		
		<div class="aiassist-bonus-item">
			<b><?php _e('Your balance:', 'wp-ai-assistant') ?></b> <?php echo (float) @$this->info->bonus->amount ?> р. (<?php echo (float) @$this->info->bonus->amount_usdt ?>$)
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
				<div><?php _e('Minimum payout amount:', 'wp-ai-assistant') ?> <?php echo (int) @$this->info->bonus->min_payment ?> р</div>
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
		
		<textarea class="aiassist-prom" id="aiassist-rewrite-prom"><?php echo esc_textarea( @$this->steps['promts']['rewrite'][ $lang_id ] ? trim( $this->steps['promts']['rewrite'][ $lang_id ] ) : @$this->info->promts->rewrite[ $lang_id ] )?></textarea>
		
		<div class="aiassist-option-item">
			<?php _e('Images generation for rewrited article based on headlines. If you leave the checkboxes empty, the rewrited version will be done without images.', 'wp-ai-assistant') ?>
			
			<label class="aiassist-option-item">
				<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-images" <?php echo esc_attr( @$rewrites['images'] ? 'checked' : '' ) ?> <?php echo esc_attr( @$rewrites['thumb'] && ! @$rewrites['images'] ? 'disabled' : '' ) ?> /> <?php _e('Generate all possible images for the post', 'wp-ai-assistant') ?>
			</label>
			
			<label class="aiassist-option-item">
				<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-thumb" <?php echo esc_attr( @$rewrites['thumb'] ? 'checked' : '' ) ?> <?php echo esc_attr( @$rewrites['images'] && ! @$rewrites['thumb'] ? 'disabled' : '' ) ?> /> <?php _e('Generate only the thumbnail (record image)', 'wp-ai-assistant') ?>
			</label>
			
			<label class="aiassist-option-item">
				<input type="checkbox" class="aiassist-rewrite-options" id="aiassist-rewrite-draft" <?php echo esc_attr( @$rewrites['draft'] ? 'checked' : '' ) ?> /> <?php _e('Send generated articles to draft (only for third-party sites rewriting)', 'wp-ai-assistant') ?>
			</label>
			
			<div>
				<div><?php _e('Text generation model', 'wp-ai-assistant') ?></div>
				<select name="aiassist-text-model" class="aiassist-rewrite-options" id="aiassist-rewrite-text-model">
					<option value="gpt3" <?php echo @$rewrites['textModel'] == 'gpt3' ? 'selected' : '' ?>>GPT-4o mini</option>
					<option value="gpt4" <?php echo @$rewrites['textModel'] == 'gpt4' ? 'selected' : '' ?>>GPT-4o</option>
				</select>
				<a href="https://aiwpwriter.com/prices/" target="_blank" class="aiassist-small"><?php _e('View rates', 'wp-ai-assistant') ?></a>
			</div>
			
			<div>
				<div><?php _e('Image generation model', 'wp-ai-assistant') ?></div>
				<select name="aiassist-image-model" class="aiassist-rewrite-options" id="aiassist-rewrite-image-model">
					<option value="flux" <?php echo @$rewrites['imageModel'] == 'flux' ? 'selected' : '' ?>>FLUX schnell</option>
					<option value="dalle" <?php echo @$rewrites['imageModel'] == 'dalle' ? 'selected' : '' ?>>Dalle 3</option>
					<option value="midjourney" <?php echo @$rewrites['imageModel'] == 'midjourney' ? 'selected' : '' ?>>Midjourney</option>
				</select>
			</div>
			
		</div>
		
		<div>
			<?php _e('The text of the original articles from your own site will be replaced by the rewritten text. If the third-party site pages are rewritten, new articles will be created. You can use the “Restore original texts” buttons only if you rewrite articles on your own site.', 'wp-ai-assistant') ?>
		</div>
		
		<div class="aiassist-option-item">
			<button id="start-rewrite-generations" <?php echo @$rewrites['start'] ? 'disabled' : '' ?>><?php _e('Start a rewrite', 'wp-ai-assistant') ?></button>
			<button id="stop-rewrite-generations" <?php echo ! @$rewrites['start'] ? 'disabled' : '' ?>><?php _e('Stop rewriting', 'wp-ai-assistant') ?></button>
			<button id="clear-rewrite-generations"><?php _e('Clear URL list', 'wp-ai-assistant') ?></button>
			<button id="restore-rewrite-generations" class="aiassist-orange"><?php _e('Restore all original texts', 'wp-ai-assistant') ?></button>
		</div>
		
		
		<div id="aiassist-rewrite-status">
			<?php if( ! @$this->options->token ){ ?>	
				<span class="wpai-warning-limits"><?php _e('You have not added the API key! The key is sent to the mail after registration in the plugin. Register and add the key from the email to the special field in the plugin settings and generation will become available.', 'wp-ai-assistant') ?></span>
			<?php } elseif( (int) @$this->info->limit < 1 ){ ?>					
				<span class="wpai-warning-limits"><?php _e('Limits have expired, to continue generating (rewriting) top up your balance!', 'wp-ai-assistant') ?></span>
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
										<?php if( (int) @$rewrite['check'] < 60 && @$this->info->limit > 1 ){ ?>
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

	<div class="aiassist-tab-data active" data-tab="settings">
		<form method="POST" class="wpai-form">
			<div class="license">
				<div class="input-block">
					<div class="title"><?php _e('Enter API key', 'wp-ai-assistant') ?></div>
					<?php if( ! isset( $this->options->token ) ){ ?>
						<label class="title"><p style="font-size: 16px; line-height:1.5;"><?php _e('The key will be sent to your email after registration, if the email has not arrived, check your spam folder. One key can be used on multiple sites. If you have any questions, write to <a href="https://t.me/wpwriter" target="_blank">Telegram</a>.', 'wp-ai-assistant') ?></p></label>
					<?php } ?>
					
					<input name="token" value="<?php echo esc_attr( @$this->options->token ) ?>" /><br /><br /><br />
				</div>
				<div class="row">
					<button name="save"><?php _e('Save', 'wp-ai-assistant') ?></button>
				</div>
			</div>
		</form>

		<?php if( @$this->options->token ){ ?>
			<div class="title"><?php _e('Statistics', 'wp-ai-assistant') ?></div>
			<form id="aiassist-stat">
				<button name="step" value="<?php echo esc_attr( date('Y-m-d') )?>|<?php echo esc_html( date('Y-m-d') )?>"><?php _e('Day', 'wp-ai-assistant') ?></button>
				<button name="step" value="<?php echo esc_attr( date('Y-m-d', time() - 60*60*24*7) )?>|<?php echo esc_html( date('Y-m-d') )?>"><?php _e('Week', 'wp-ai-assistant') ?></button>
				<button name="step" value="<?php echo esc_attr( date('Y-m-d', time() - 60*60*24*30) )?>|<?php echo esc_html( date('Y-m-d') )?>"><?php _e('Month', 'wp-ai-assistant') ?></button>
				<br />
				<input type="date" name="dateStart" />
				<input type="date" name="dateEnd" />
				<button><?php _e('Show report', 'wp-ai-assistant') ?></button>
			</form>

			<div id="area-chat"></div>
		<?php } ?>
		
		<?php if( ! @$this->options->token ){ ?>
			<div class="wpai-tabs">
				<div class="wpai-tab active" data-action="signIn" ><?php _e('Sign in', 'wp-ai-assistant') ?></div>
				<div class="wpai-tab" data-action="signUp"><?php _e('Sign up', 'wp-ai-assistant') ?></div>
			</div>
			<form method="POST" class="wpai-form" id="aiassist-sign" data-action="signIn">
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
						<input type="checkbox" name="license" /> <?php _e('By registering, you agree to', 'wp-ai-assistant') ?> <a href="https://aiwpwriter.com/privacy-policy/" target="_blank"><?php _e('privacy policy', 'wp-ai-assistant') ?></a>, <a href="https://aiwpwriter.com/publichnaja-oferta-o-zakljuchenii-dogovora-ob-okazanii-uslug/" target="_blank"><?php _e('offer', 'wp-ai-assistant') ?></a> <?php _e('and', 'wp-ai-assistant') ?> <a href="https://aiwpwriter.com/user-agreement/" target="_blank"><?php _e('user agreement', 'wp-ai-assistant') ?></a>.
					</label>
				</div>
				
				<div class="row">
					<button></button>
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
	
	
	<div class="aiassist-tab-data" data-tab="rates">
		
		<div class="pay-methods">
			<div class="pay-method active">
				<div class="robokassa"></div>
				<div class="pay-method-label visa">Visa, Mastercard, Мир, ЮMoney</div>
			</div>
			
			<div class="pay-method">
				<div class="cryptocloud"></div>
				<div class="pay-method-label">USDT, Bitcoin, Ethereum</div>
			</div>
		</div>
	
		<h2 class="rates-header"><?php _e('Payment & Pricing', 'wp-ai-assistant') ?></h2>
		
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
		
		<div class="rates-block-robokassa">
		
			<div class="rates-item">
				<div class="title"><?php _e('Payment for any amount', 'wp-ai-assistant') ?></div>
				<div class="title-label"><?php _e('Enter any amount for payment. Limits will not disappear, you can generate text and images at any time.', 'wp-ai-assistant') ?></div>
				
				<form id="aiassist-custom-buy" class="aiassist-buy-form">
					<div class="header"><?php _e('Buy limits', 'wp-ai-assistant') ?></div>
					<div><?php _e('Price', 'wp-ai-assistant') ?> <b><?php echo (float) @$this->info->price ?> <?php _e('rubles for 1,000 limits.</b> Enter <b>any</b> amount to top up your balance:', 'wp-ai-assistant') ?></div>
					<input type="number" step="1" min="0" id="out_summ" placeholder="5000 руб" required />
					<button class="aiassist-buy" data-type="custom"><?php _e('Buy', 'wp-ai-assistant') ?></button>
				</form>
			</div>
			
			<div class="rates-item">
				<div class="title"><?php _e('Basic limit package', 'wp-ai-assistant') ?></div>
				<div class="title-label"><?php _e('For those who generate in small volumes', 'wp-ai-assistant') ?></div>
				
				<div class="aiassist-buy-form">
					<div class="header"><b><?php echo number_format( @$this->info->rates->base_rate, 0, ' ', ' ' )?> <?php _e('rub', 'wp-ai-assistant') ?></b> <?php _e('instead of', 'wp-ai-assistant') ?> <i><?php echo number_format( @$this->info->rates->base_rate_after, 0, ' ', ' ' ) ?></i> <?php _e('saving', 'wp-ai-assistant') ?> <?php echo number_format( @$this->info->rates->base_rate_economy, 0, ' ', ' ' ) ?> р. </div>
					
					<div><?php _e('The balance will be credited', 'wp-ai-assistant') ?> <b><?php echo number_format( @$this->info->rates->base_rate_symbols, 0, ' ', ' ' )?> <?php _e('limits', 'wp-ai-assistant') ?></b></div>
					<div><?php _e('Within the tariff the price will be', 'wp-ai-assistant') ?> <b><?php echo (float) @$this->info->rates->base_rate_price ?> <?php _e('rubles per 1000 limits', 'wp-ai-assistant') ?></b></div>
					<button type="button" class="aiassist-buy" data-type="base"><?php _e('Buy', 'wp-ai-assistant') ?></button>
				</div>
			</div>
			
			<div class="rates-item">
				<div class="title"><?php _e('Professional limit package', 'wp-ai-assistant') ?></div>
				<div class="title-label"><?php _e('For those who generate in large volumes', 'wp-ai-assistant') ?></div>
				
				<div class="aiassist-buy-form">
					<div class="header"><b><?php echo number_format( @$this->info->rates->prof_rate, 0, ' ', ' ' )?> <?php _e('rub', 'wp-ai-assistant') ?></b> <?php _e('instead of', 'wp-ai-assistant') ?> <i><?php echo number_format( @$this->info->rates->prof_rate_after, 0, ' ', ' ' ) ?></i> <?php _e('saving', 'wp-ai-assistant') ?> <?php echo number_format( @$this->info->rates->prof_rate_economy, 0, ' ', ' ' ) ?> р. </div>
					<div><?php _e('The balance will be credited', 'wp-ai-assistant') ?> <b><?php echo number_format( @$this->info->rates->prof_rate_symbols, 0, ' ', ' ' )?> <?php _e('limits', 'wp-ai-assistant') ?></b></div>
					<div><?php _e('Within the tariff the price will be', 'wp-ai-assistant') ?> <b><?php echo (float) @$this->info->rates->prof_rate_price ?> <?php _e('rubles per 1000 limits', 'wp-ai-assistant') ?></b></div>
					<button type="button" class="aiassist-buy" data-type="professional"><?php _e('Buy', 'wp-ai-assistant') ?></button>
				</div>
			</div>
		
		</div>
		
		<div class="rates-block-cryptocloud hide">
		
			<div class="rates-item">
				<div class="title"><?php _e('Payment for any amount', 'wp-ai-assistant') ?></div>
				<div class="title-label"><?php _e('Enter any amount for payment. Limits will not disappear, you can generate text and images at any time.', 'wp-ai-assistant') ?></div>
				
				<form id="aiassist-custom-buy" class="aiassist-buy-form">
					<div class="header"><?php _e('Buy limits', 'wp-ai-assistant') ?></div>
					<div><?php _e('Price', 'wp-ai-assistant') ?> <b><?php echo (float) @$this->info->price_usdt ?> <?php _e('USDT for 1,000 limits.</b> Enter <b>any</b> amount to top up your balance:', 'wp-ai-assistant') ?></div>
					<input type="number" step="1" min="0" id="out_summ_usdt" placeholder="50 USDT" required />
					<button class="aiassist-buy" data-type="custom"><?php _e('Buy', 'wp-ai-assistant') ?></button>
				</form>
			</div>
			
			<div class="rates-item">
				<div class="title"><?php _e('Basic limit package', 'wp-ai-assistant') ?></div>
				<div class="title-label"><?php _e('For those who generate in small volumes', 'wp-ai-assistant') ?></div>
				
				<div class="aiassist-buy-form">
					<div class="header"><b><?php echo number_format( @$this->info->rates->base_rate_usdt, 0, ' ', ' ' )?> USDT</b> <?php _e('instead of', 'wp-ai-assistant') ?> <i><?php echo number_format( @$this->info->rates->base_rate_after_usdt, 0, ' ', ' ' ) ?></i> <?php _e('saving', 'wp-ai-assistant') ?> <?php echo number_format( @$this->info->rates->base_rate_economy_usdt, 0, ' ', ' ' ) ?> USDT </div>
					
					<div><?php _e('The balance will be credited', 'wp-ai-assistant') ?> <b><?php echo number_format( @$this->info->rates->base_rate_symbols_usdt, 0, ' ', ' ' )?> <?php _e('limits', 'wp-ai-assistant') ?></b></div>
					<div><?php _e('Within the tariff the price will be', 'wp-ai-assistant') ?> <b><?php echo (float) @$this->info->rates->base_rate_price_usdt ?> <?php _e('USDT for 1000 limits', 'wp-ai-assistant') ?></b></div>
					<button type="button" class="aiassist-buy" data-type="base"><?php _e('Buy', 'wp-ai-assistant') ?></button>
				</div>
			</div>
			
			<div class="rates-item">
				<div class="title"><?php _e('Professional limit package', 'wp-ai-assistant') ?></div>
				<div class="title-label"><?php _e('For those who generate in large volumes', 'wp-ai-assistant') ?></div>
				
				<div class="aiassist-buy-form">
					<div class="header"><b><?php echo number_format( @$this->info->rates->prof_rate_usdt, 0, ' ', ' ' )?> USDT</b> <?php _e('instead of', 'wp-ai-assistant') ?> <i><?php echo number_format( @$this->info->rates->prof_rate_after_usdt, 0, ' ', ' ' ) ?></i> <?php _e('saving', 'wp-ai-assistant') ?> <?php echo number_format( @$this->info->rates->prof_rate_economy_usdt, 0, ' ', ' ' ) ?> USDT </div>
					<div><?php _e('The balance will be credited', 'wp-ai-assistant') ?> <b><?php echo number_format( @$this->info->rates->prof_rate_symbols_usdt, 0, ' ', ' ' )?> <?php _e('limits', 'wp-ai-assistant') ?></b></div>
					<div><?php _e('Within the tariff the price will be', 'wp-ai-assistant') ?> <b><?php echo (float) @$this->info->rates->prof_rate_price_usdt ?> <?php _e('USDT for 1000 limits', 'wp-ai-assistant') ?></b></div>
					<button type="button" class="aiassist-buy" data-type="professional"><?php _e('Buy', 'wp-ai-assistant') ?></button>
				</div>
			</div>
		
		</div>
		
	</div>
	
	
	<div class="aiassist-tab-data" data-tab="generations">
		<h2 class="generations-header"><?php _e('Bulk generation', 'wp-ai-assistant') ?></h2>
		
		<div class="aiassist-article-items">
		
			<div class="aiassist-article-item">
				<div><?php _e('Add keywords in a list, each row is a new article. You can specify one or more key phrases in a row, separated by commas', 'wp-ai-assistant') ?></div>
				<textarea class="aiassist-keywords-item"></textarea>
				
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

		<textarea class="aiassist-prom" id="aiassist-generation-prom"><?php echo esc_textarea( @$this->steps['promts']['multi'][ $lang_id ] ? trim( $this->steps['promts']['multi'][ $lang_id ] ) : @$this->info->promts->multi[ $lang_id ] )?></textarea>
		
		<div class="aiassist-option-item">
			<div><?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-title-prom-multi" class="aiassist-prom" value="<?php echo esc_attr( @$this->steps['promts']['multi_title'][ $lang_id ] ? $this->steps['promts']['multi_title'][ $lang_id ] : @$this->info->promts->multi_title[ $lang_id ] )?>" /></div>
			<div><?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-desc-prom-multi" class="aiassist-prom" value="<?php echo esc_attr( @$this->steps['promts']['multi_desc'][ $lang_id ] ? $this->steps['promts']['multi_desc'][ $lang_id ] : @$this->info->promts->multi_desc[ $lang_id ] )?>" /></div>
		</div>
		
		<div class="aiassist-option-item">
			<?php _e('The number of articles to generate and publish per day. If you leave the input form blank, the articles will be generated and published for all specified keys as soon as possible.', 'wp-ai-assistant') ?>
			<input type="number" class="aiassist-auto-options" id="publish-article-in-day" value="<?php echo (int) @$autoGen['publishInDay'] ?>" placeholder="0" />
		</div>
		
		<div class="aiassist-option-item">
			<?php _e('The images to generate for the article. If you leave the input form blank, the articles will be generated without images.', 'wp-ai-assistant') ?>
			
			<label class="aiassist-option-item">
				<input type="checkbox" class="aiassist-auto-options" id="aiassist-auto-images" <?php echo esc_attr( @$autoGen['images'] ? 'checked' : '' ) ?> <?php echo esc_attr( @$autoGen['thumb'] && ! @$autoGen['images'] ? 'disabled' : '' ) ?> /> <?php _e('Generate images for all headers', 'wp-ai-assistant') ?>
			</label>
			
			<label class="aiassist-option-item">
				<input type="checkbox" class="aiassist-auto-options" id="aiassist-auto-thumb" <?php echo esc_attr( @$autoGen['thumb'] ? 'checked' : '' ) ?> <?php echo esc_attr( @$autoGen['images'] && ! @$autoGen['thumb'] ? 'disabled' : '' ) ?> /> <?php _e('Generate only the thumbnail (record image)', 'wp-ai-assistant') ?>
			</label>
			
			<label class="aiassist-option-item">
				<input type="checkbox" class="aiassist-auto-options" id="aiassist-auto-draft" <?php echo esc_attr( @$autoGen['draft'] ? 'checked' : '' ) ?> /> <?php _e('Send the generated articles to draft', 'wp-ai-assistant') ?>
			</label>
			
			<div>
				<div><?php _e('Text generation model', 'wp-ai-assistant') ?></div>
				<select name="aiassist-text-model" class="aiassist-auto-options" id="aiassist-change-text-model">
					<option value="gpt3">GPT-4o mini</option>
					<option value="gpt4">GPT-4o</option>
				</select>
				<a href="https://aiwpwriter.com/prices/" target="_blank" class="aiassist-small"><?php _e('Prices', 'wp-ai-assistant') ?></a>
			</div>
			
			<div>
				<div><?php _e('Image generation model', 'wp-ai-assistant') ?></div>
				<select name="aiassist-image-model" class="aiassist-auto-options" id="aiassist-image-model">
					<option value="flux" <?php echo @$autoGen['imageModel'] == 'flux' ? 'selected' : '' ?>>FLUX schnell</option>
					<option value="dalle" <?php echo @$autoGen['imageModel'] == 'dalle' ? 'selected' : '' ?>>Dalle 3</option>
					<option value="midjourney" <?php echo @$autoGen['imageModel'] == 'midjourney' ? 'selected' : '' ?>>Midjourney</option>
				</select>
			</div>
			
		</div>
		
		<div class="aiassist-option-item">
			<button id="start-articles-generations" <?php echo @$autoGen['start'] ? 'disabled' : '' ?>><?php _e('Start generating articles', 'wp-ai-assistant') ?></button>
			<button id="stop-articles-generations" <?php echo ! @$autoGen['start'] ? 'disabled' : '' ?>><?php _e('Stop generation', 'wp-ai-assistant') ?></button>
			<button id="clear-articles-generations"><?php _e('Clear the list of key phrases', 'wp-ai-assistant') ?></button>
		</div>
		
		
		<?php if( ! @$this->options->token ){ ?>
			
			<span class="wpai-warning-limits"><?php _e('You have not added the API key! The key is sent to the mail after registration in the plugin. Register and add the key from the email to the special field in the plugin settings and generation will become available.', 'wp-ai-assistant') ?></span>
		
		<?php } elseif( (int) @$this->info->limit < 1 ){ ?>
		
			<span class="wpai-warning-limits"><?php _e('Limits have expired, top up your balance to continue generating!', 'wp-ai-assistant') ?></span>
		
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
		
		<div class="aiassist-option-item <?php echo ! isset( $autoGen['start'] ) ? 'hidden' : ''?>" id="aiassist-generation-progress"><?php _e('Generated by', 'wp-ai-assistant') ?>  <span id="aiassist-count-publish"><?php echo (int) @$autoGen['publish'] ?></span>  <?php _e('articles from', 'wp-ai-assistant') ?><?php echo (int) @$autoGen['count'] ?></div>
		
		<div class="aiassist-articles-queue">
			<?php if( ! empty( $autoGen['articles'] ) ){ $queue = false; ?>
				<?php foreach( $autoGen['articles'] as $id => $article ){ ?>
					<?php if( isset( $article['post_id'] ) ){ ?>
						<?php $queue = false; ?>
						<div class="aiassist-article-queue"><a href="<?php echo get_edit_post_link( $article['post_id'] ) ?>" target="_blank"><?php echo esc_attr( $article['keywords'] ) ?></a> <span class="aiassist-queue-status"><?php _e('Generated by', 'wp-ai-assistant') ?></span></div>
					<?php } else { ?>
					
						<div class="aiassist-article-queue aiassist-queue"><div class="aiassist-article-item-close" data-key="<?php echo (int) $id ?>"></div> 
						<span class="aiassist-queue-keyword">
							<?php echo esc_attr( $article['keywords'] ) ?></span> 
							
							<span class="aiassist-queue-status">
								<?php if( ! $queue ){ ?>
									
									<?php if( ( (int) @$article['check'] < 60 && @$this->info->limit > 1 ) ){ ?>
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
	

</div>