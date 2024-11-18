<div id="aiasist">
	<div class="tokens-left <?php echo (int) @$this->info->limit < 1000 ? 'wpai-warning-limits' : '' ?>">
		<?php _e('Limits left:', 'wp-ai-assistant') ?> <span id="tokens-left"><?php echo number_format( (int) @$this->info->limit, 0, ' ', ' ' ) ?></span>
	</div>
	
	<label id="aiassist-text-gen-model">
		<div><?php _e('Generation model', 'wp-ai-assistant') ?></div>
		<select name="aiassist-text-model" id="aiassist-change-text-model">
			<option value="gpt3">GPT-4o mini</option>
			<option value="gpt4">GPT-4o</option>
		</select>
		<a href="https://aiwpwriter.com/prices/" target="_blank" class="aiassist-small"><?php _e('Prices', 'wp-ai-assistant') ?></a>
	</label>
	
	<div class="aiassist-tabs">
		<div class="aiassist-tab active" data-tab="standart"><?php _e('Single request generation', 'wp-ai-assistant') ?></div>
		<div class="aiassist-tab" data-tab="long"><?php _e('Generating an article according to a plan (large article)', 'wp-ai-assistant') ?></div>
	</div>
	
	<button type="button" class="aiassist-set-default-promts"><?php _e('Restore default prompts', 'wp-ai-assistant') ?></button>
	
	<div class="aiassist-tab-data active" data-tab="standart">
		
		<div class="aiassist-item center">
			<p><?php _e('Enter the key phrase for which you want to write an article, it will be automatically substituted in the prompt. For meta tags and images to be generated, this field must be filled in.', 'wp-ai-assistant') ?></p>
			<div>
				<input id="aiassist-theme-standart" class="aiassist-prom" placeholder="<?php _e('Enter a subject...', 'wp-ai-assistant') ?>" value="<?php echo esc_attr( isset( $this->steps['aiassist-theme-standart'] ) ? $this->steps['aiassist-theme-standart'] : '' )?>" />
			</div>
			<p><?php _e('You can change the prompt as you wish, it determines how the article will turn out. Instead of the {key} variable, the key phrase will be substituted.', 'wp-ai-assistant') ?></p>
			
			<?php if( @$this->info->promts->lang ){ $lang_id = $this->getDefaultLangId(); ?>
				<div class="aiassist-lang-block">
					<div class="aiassist-lang-promts-item">
						<div>Promt lang: </div>
						<select class="aiassist-lang-promts">
							<?php foreach( $this->info->promts->lang as $k => $lang ){ ?>
								<?php
									if( @$this->steps['promts']['short_lang'] == $k )
										$lang_id = (int) $k;
								?>
							
								<option value="<?php echo (int) $k ?>" <?php echo @$this->steps['promts']['short_lang'] == $k ? 'selected' : '' ?> ><?php echo esc_html( $lang ) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			<?php } ?>
			
			<textarea id="aiassist-article-prom" class="aiassist-prom"><?php echo esc_textarea( @$this->steps['promts']['short'][ $lang_id ] ? trim( $this->steps['promts']['short'][ $lang_id ] ) : @$this->info->promts->short[ $lang_id ] )?></textarea>
		</div>
		
		<div class="next-step">
			<button type="button" id="aiassist-standart-generate"><?php _e('Generate article text', 'wp-ai-assistant') ?></button>
		</div>
		
	</div>
	
	
	<div class="aiassist-tab-data" data-tab="long">
		
		<label>
			<input type="checkbox" id="exclude_context" <?php echo esc_html( @$_COOKIE['excludeContext'] ? 'checked' : '' )?> />
			<?php _e('When generating, consider only the article outline and h1 headline in context', 'wp-ai-assistant') ?> <div class="aiassist-info" title="<?php echo esc_attr( $this->info->newGenerationInfo ) ?>">&#63;</div>
		</label>
	
		<div class="aiassist-item center">
			
			<?php if( @$this->info->promts->lang ){ $lang_id = $this->getDefaultLangId(); ?>
				<div class="aiassist-lang-block">
					<div class="aiassist-lang-promts-item">
						<div><?php _e('Prompts language: ', 'wp-ai-assistant') ?></div>
						<select class="aiassist-lang-promts">
							<?php foreach( $this->info->promts->lang as $k => $lang ){ ?>
								<?php
									if( @$this->steps['promts']['long_lang'] == $k )
										$lang_id = (int) $k;
								?>
							
								<option value="<?php echo (int) $k ?>" <?php echo @$this->steps['promts']['long_lang'] == $k ? 'selected' : '' ?> ><?php echo esc_html( $lang ) ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			<?php } ?>
			
			<?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-theme-prom" class="aiassist-prom" value="<?php echo esc_attr( @$this->steps['promts']['long_header'][ $lang_id ] ? $this->steps['promts']['long_header'][ $lang_id ] : @$this->info->promts->long_header[ $lang_id ] )?>" />
			<br /><br />
			<div>
				<input id="aiassist-theme" class="aiassist-prom" placeholder="<?php _e('Enter a subject...', 'wp-ai-assistant') ?>" value="<?php echo esc_attr( isset( $this->steps['aiassist-theme'] ) ? $this->steps['aiassist-theme'] : '' )?>" />
			</div>
			
			<div class="next-step">
				<button type="button" id="aiassist-theme-generate"><?php _e('Generate article header', 'wp-ai-assistant') ?></button>
			</div>
		</div>
		
		<div class="aiassist-item center step <?php echo esc_attr( isset( $this->steps['header'] ) ? 'active' : '' )?>" id="step1">
			<input name="aiassist_header" id="aiassist-header" value="<?php echo esc_attr( isset( $this->steps['header'] ) ? $this->steps['header'] : '' )?>" />
			<div class="next-step">
				<?php _e('Prompt for an article outline. Instead of the {key} variable, the key phrase will be substituted. ', 'wp-ai-assistant') ?><textarea id="aiassist-structure-prom" class="aiassist-prom"><?php echo esc_attr( @$this->steps['promts']['long_structure'][ $lang_id ] ? $this->steps['promts']['long_structure'][ $lang_id ] : @$this->info->promts->long_structure[ $lang_id ] )?></textarea>
				<button type="button" id="aiassist-structure-generate"><?php _e('Create article structure', 'wp-ai-assistant') ?></button>
			</div>
		</div>
		
		<div class="aiassist-item center step <?php echo esc_attr( isset( $this->steps['structure'] ) ? 'active' : '' )?>" id="step2">
			<textarea id="aiassist-structure"><?php echo esc_textarea( isset( $this->steps['structure'] ) ? $this->steps['structure'] : '' )?></textarea>
			<div class="next-step">
				<?php _e('Prompt:', 'wp-ai-assistant') ?> <textarea id="aiassist-content-prom" class="aiassist-prom"><?php echo esc_attr( @$this->steps['promts']['long'][ $lang_id ] ? $this->steps['promts']['long'][ $lang_id ] : @$this->info->promts->long[ $lang_id ] )?></textarea>
				<button type="button" id="aiassist-content-generate"><?php _e('Generate article text', 'wp-ai-assistant') ?></button>
			</div>
		</div>

	</div>
	
	<div class="aiassist-item center step <?php echo esc_attr( isset( $this->steps['content'] ) ? 'active' : '' )?>" id="step3">
		<?php wp_editor( ( isset( $this->steps['content'] ) ? $this->steps['content'] : '' ), 'AIASSIST', [ 'textarea_name' => 'aiassist_content', 'media_buttons' => false, 'quicktags' => true ] ); ?>
		<div class="next-step">
			<div><?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-title-prom" class="aiassist-prom" value="<?php echo esc_attr( @$this->steps['promts']['long_title'][ $lang_id ] ? $this->steps['promts']['long_title'][ $lang_id ] : @$this->info->promts->long_title[ $lang_id ] )?>" /></div>
			<div><?php _e('Promt:', 'wp-ai-assistant') ?> <input id="aiassist-desc-prom" class="aiassist-prom" value="<?php echo esc_attr( @$this->steps['promts']['long_desc'][ $lang_id ] ? $this->steps['promts']['long_desc'][ $lang_id ] : @$this->info->promts->long_desc[ $lang_id ] )?>" /></div>
			<button type="button" id="aiassist-meta-generate"><?php _e('Generate meta tags', 'wp-ai-assistant') ?></button>
		</div>
	</div>
	
	<div class="aiassist-item center step <?php echo esc_attr( isset( $this->steps['title'] ) ? 'active' : '' )?>" id="step4">
		<input name="aiassist_title" id="aiassist-title" value="<?php echo esc_attr( isset( $this->steps['title'] ) ? $this->steps['title'] : '' )?>" />
		<textarea name="aiassist_desc" id="aiassist-desc"><?php echo esc_textarea( isset( $this->steps['desc'] ) ? $this->steps['desc'] : '' )?></textarea>
	</div>
	
	
	
	<div class="aiassist-item step aiassist-images-generator <?php echo esc_attr( isset( $this->steps['content'] ) ? 'active' : '' )?>" id="step6">
	
		<div class="aiassist-step-title center"><?php _e('Generating images for an article. Select a model:', 'wp-ai-assistant') ?></div>
		
		<select name="aiassist-image-model" id="aiassist-change-image-model">
			<option value="flux">FLUX schnell</option>
			<option value="midjourney">Midjourney</option>
			<option value="dalle">Dalle 3</option>
		</select>
		<a href="https://aiwpwriter.com/prices/" target="_blank" class="aiassist-small aiassist-after-change-image-model"><?php _e('Prices', 'wp-ai-assistant') ?></a>
		
		<div class="aiassist-step-desc"><?php _e('For which headers to generate images:', 'wp-ai-assistant') ?></div>
	
		<label>
			<input type="checkbox" id="aiassist-images-generator-all-headers" /> <?php _e('For all', 'wp-ai-assistant') ?>
		</label>
	
		<div class="aiassist-headers">
			<?php 
				if( ! @$this->steps['header'] )
					$this->steps['header'] = @$this->steps['aiassist-theme-standart'];
			?>
			<?php if( $this->steps['header'] ){ ?>
				<div class="aiassist-header-item aiassist-main-header">
					<div class="left"><?php _e('Featured image', 'wp-ai-assistant') ?></div>
					<label><input type="checkbox" value="<?php echo esc_attr( @$this->steps['header'] )?>" /><span><?php echo esc_html( @$this->steps['header'] )?></span></label>
					<div class="aiassist-translate-promt-image">Prompt: <input id="aiassist-main" value="<?php echo esc_attr( @$this->steps['header'] )?>" data-en="<?php echo esc_attr( @$this->steps[ @$this->steps['header'] ] )?>" /> <div class="image-generate-item"><?php _e('Generate', 'wp-ai-assistant') ?></div></div>
				</div>
			<?php } ?>
			
			<?php if( @preg_match_all('/<h[2-6][^>]*>([^<]+)<\/h[2-6]>/is', @$this->steps['content'], $headers ) ){ ?>
				<?php foreach( $headers[1] as $k => $header ){ ?>
					<div class="aiassist-header-item">
						<label><input type="checkbox" value="<?php echo esc_attr( $header )?>" /><span><?php echo esc_html( $header )?></span></label>
						<div class="aiassist-translate-promt-image">Promt: <input value="<?php echo esc_attr( @$this->steps['header'] .' '. $header )?>" data-en="<?php echo esc_attr( @$this->steps[ @$header ] )?>" /> <div class="image-generate-item"><?php _e('Generate', 'wp-ai-assistant') ?></div></div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>

	
		<div class="next-step">
			<button name="aiassist_generate_image" type="button" id="aiassist-images-generator-start"><?php _e('Generate', 'wp-ai-assistant') ?></button>
		</div>
	</div>
	
	
	
	
	<div class="next-step" id="step5">
		<div><?php _e('The article cost:', 'wp-ai-assistant') ?> <span id="aiassist-article-symbols"><?php echo esc_html( isset( $_COOKIE['spent'] ) ? (int) $_COOKIE['spent'] : 0 )?></span> <?php _e('limits', 'wp-ai-assistant') ?></div>
		<div><?php _e('The time spent on generating images was:', 'wp-ai-assistant') ?> <span id="images-article-symbols"><?php echo esc_html( isset( $_COOKIE['imgSpent'] ) ? (int) $_COOKIE['imgSpent'] : 0 )?></span> <?php _e('limits', 'wp-ai-assistant') ?></div>
		
		<button type="button" id="aiassist-clear-content"><?php _e('Clear', 'wp-ai-assistant') ?></button>
		<button name="aiassist_save" type="button" id="aiassist-save-content"><?php _e('Save', 'wp-ai-assistant') ?></button>
	</div>
	
	<div id="aiassist-regenerate-wrap">
		<div id="aiassist-regenerate-close">&#10006;</div>
		
		<div class="aiassist-regenerate-info">
			<?php _e('To regenerate a piece of text, highlight it and click Generate.To generate a new piece of text, place the cursor where you want to add text, enter a prompt and click Generate.', 'wp-ai-assistant') ?>
		</div>
		
		<button type="button" class="aiassist-set-default-promts-regenerate"><?php _e('Restore default prompts', 'wp-ai-assistant') ?></button>
		
		<?php if( @$this->info->promts->lang ){ $lang_id = $this->getDefaultLangId(); ?>
			<select class="aiassist-lang-promts-regenerate">
				<?php foreach( $this->info->promts->lang as $k => $lang ){ ?>
					<?php
						if( @$this->steps['promts']['regenerate_lang'] == $k )
							$lang_id = (int) $k;
					?>
				
					<option value="<?php echo (int) $k ?>" <?php echo @$this->steps['promts']['regenerate_lang'] == $k ? 'selected' : '' ?> ><?php echo esc_html( $lang ) ?></option>
				<?php } ?>
			</select>
		<?php } ?>
		
		<div class="aiassist-promt-label"><?php _e('Promt:', 'wp-ai-assistant') ?></div> <input id="aiassist-prom-regenerate" class="aiassist-prom" value="<?php echo esc_textarea( @$this->steps['promts']['regenerate'][ $lang_id ] ? trim( $this->steps['promts']['regenerate'][ $lang_id ] ) : @$this->info->promts->regenerate[ $lang_id ] )?>" />
		
		<button type="button" id="aiassist-regenerate"><?php _e('Generate', 'wp-ai-assistant') ?></button>
	</div>
	
	<div id="aiassist-generate-image">
		<div id="aiassist-generate-image-close">&#10006;</div>
		<div class="aiassist-image-tiny">
			<select id="aiassist-tiny-image-model" name="aiassist-image-model">
				<option value="flux">FLUX schnell</option>
				<option value="midjourney">Midjourney</option>
				<option value="dalle">Dalle</option>
			</select>
			<input type="text" name="aiassist-image-promt" id="aiassist-tiny-image-promt" placeholder="Input promt" />
			<button type="button" name="aiassist-generate" id="aiassist-tiny-image-generate">Generate</button>
			<button type="button" name="aiassist-translate" id="aiassist-tiny-image-translate">Translate</button>
			
			<a href="https://aiwpwriter.com/prices/" target="_blank" class="aiassist-small"><?php _e('Prices', 'wp-ai-assistant') ?></a>
			
			<div class="aiassist-image-tiny-item"></div>
			<div class="aiassist-image-tiny-save-button-wrap">
				<button type="button" name="aiassist-save" id="aiassist-tiny-image-save"><?php _e('Save', 'wp-ai-assistant') ?></button>
			</div>
		</div>
	</div>
		
</div>