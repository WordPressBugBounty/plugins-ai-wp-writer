jQuery( document ).ready(function($){

	const aiWriter = {
		
		init: () => {
			
			aiWriter.cron();
			aiWriter.events();
			
		},
		
		events: () => {
			
			window.addEventListener('beforeunload', function( event ){
				event.stopImmediatePropagation();
			});
			
			$(document).on('click', '.wpai-tab', aiWriter.tabs);
			$(document).on('click', '.aiassist-rates-tab', aiWriter.rateTabs);
			$(document).on('click', '.close-notice, .aiwriter-notice .notice-dismiss', aiWriter.closeNotice);
			$(document).on('click', '.aiassist-tab:not(.aiassist-tab-inactive, .aiassist-lock)', aiWriter.wsTabs);
			$(document).on('click', '.aiassist-tab-inactive', aiWriter.wsTabsInactive);
			$(document).on('submit', '#aiassist-sign', aiWriter.sign);
			$(document).on('submit', '#aiassist-stat', aiWriter.getStat);
			$(document).on('click', 'button[name="step"]', aiWriter.statStep);
			$(document).on('click', '.aiassist-buy', aiWriter.buy);
			$(document).on('click', '.aiassist-recurring-activate', aiWriter.recurringActivate);
			$(document).on('click', '.aiassist-recurring-pause', aiWriter.recurringPause);
			$(document).on('submit', '#aiassist-custom-buy', aiWriter.buyForm);
			$(document).on('focus', '#out_summ', aiWriter.outSummFocus);
			$(document).on('blur', '#out_summ', aiWriter.outSummFocusOut);
			$(document).on('click', '#aiassist-addItemRewrite', aiWriter.addItemRewrite);
			$(document).on('click', '.aiassist-rewrite-item-close', aiWriter.rewriteItemClose);
			$(document).on('click', '#aiassist-addItemArticle', aiWriter.addItemArticle);
			$(document).on('click', '.aiassist-article-queue .aiassist-article-item-close', aiWriter.queueArticleClose);
			$(document).on('click', '.aiassist-article-item .aiassist-article-item-close', aiWriter.articleItemClose);
			$(document).on('click', '#start-articles-generations', aiWriter.startArticlesGeneration);
			$(document).on('click', '#stop-articles-generations', aiWriter.stopArticlesGeneration);
			$(document).on('click', '#clear-articles-generations', aiWriter.clearArticlesGeneration);
			$(document).on('change', '.aiassist-auto-options', aiWriter.autoGenOptions);
			$(document).on('change', '.aiassist-rewrite-options', aiWriter.rewriteOptions);
			$(document).on('click', '#start-rewrite-generations', aiWriter.startRewriteGenerations);
			$(document).on('click', '#clear-rewrite-generations', aiWriter.clearRewritesGeneration);
			$(document).on('click', '#stop-rewrite-generations', aiWriter.stopRewriteGeneration);
			
			if( window.tinymce ){
				interval = setInterval( () => {
					aiWriter.editor = tinymce.get('AIASSIST');
					
					if( ! aiWriter.editor || aiWriter.load )
						return;
					
					clearInterval( interval );
					
					aiWriter.load = true;
					$(document).on('click', '#aiassist-step-stop', aiWriter.stepStop);
					$(document).on('click', '#aiassist-theme-generate', aiWriter.generateHeader);
					$(document).on('click', '#aiassist-structure-generate', aiWriter.generateStructure);
					$(document).on('click', '#aiassist-content-generate', aiWriter.generateContent);
					$(document).on('click', '#aiassist-standart-generate', aiWriter.standartGenerateContent);
					$(document).on('click', '#aiassist-meta-generate', aiWriter.generateMeta);
					$(document).on('click', '#aiassist-save-content', aiWriter.saveContent);
					$(document).on('click', '#aiassist-images-generator-all-headers', aiWriter.checkAllHeaders);
					$(document).on('click', '.image-generate-item', aiWriter.imageGenerator);
					$(document).on('click', '#aiassist-images-generator-start', aiWriter.imagesGenerator);
					$(document).on('click', '.aiassist-images .aiassist-image', aiWriter.selectImage);
					$(document).on('change', '#aiassist-change-image-model', aiWriter.translatePromtsToImages);
				}, 250)
			}
			
			$(document).on('input', '#aiassist-gpt-key', aiWriter.saveKey);
			$(document).on('change', '#aiassist-change-text-model', aiWriter.setTextModel);
			$(document).on('change', '#aiassist-rewrite-text-model', aiWriter.setTextModelRewrite);
			$(document).on('change', '#aiassist-change-text-model-editor', aiWriter.setTextModelEditor);
			$(document).on('change', '#aiassist-change-image-model', aiWriter.setImageModel);
			$(document).on('change', '#aiassist-image-model', aiWriter.setAutoImageModel);
			$(document).on('change', '#aiassist-images-model', aiWriter.setReplaceImageModel);
			$(document).on('change', '#aiassist-rewrite-image-model', aiWriter.setRewriteImageModel);
			$(document).on('click', '#aiassist-tiny-image-save', aiWriter.tinyMceImageSave);
			$(document).on('click', '#aiassist-generate-image-close', aiWriter.tonyMcePopUpHide );
			$(document).on('click', '#aiassist-tiny-image-translate', aiWriter.tinyMceTranslate );
			$(document).on('click', '#aiassist-tiny-image-generate', aiWriter.tinyMceImageGenerate );
			$(document).on('click', '#aiassist-clear-content', aiWriter.clearContent );
			$(document).on('click', '.aiassist-set-default-promts', aiWriter.setDefaultPromts );
			$(document).on('click', '.aiassist-set-default-promts-regenerate', aiWriter.setDefaultPromtsRegenerate );
			$(document).on('click', '.ai-image', aiWriter.selectImageInBlock);
			$(document).on('click', '.aiassist-post-restore', aiWriter.postRestore);
			$(document).on('click', '#restore-rewrite-generations', aiWriter.postsRestores);
			$(document).on('change', '#rewrite_all', aiWriter.rewriteAllSiteChecked);
			$(document).on('change', 'input[name*="rewrite_type"]', aiWriter.rewriteInputsChecked);
			$(document).on('change', '.cat-rewrite-option input[type="checkbox"]', aiWriter.disabledRewriteUrlArea);
			$(document).on('input', '.aiassist-prom', aiWriter.savePromt);
			$(document).on('input', '.aiassist-keywords-input input, .aiassist-multi-keywords .aiassist-multi-item', aiWriter.showKeywordsArea);
			$(document).on('paste', '.aiassist-keywords-input input, .aiassist-multi-keywords .aiassist-multi-item', aiWriter.showKeywordsArea);
			$(document).on('change', 'select.aiassist-lang-promts', aiWriter.changeLangPromts);
			$(document).on('change', 'select.aiassist-lang-promts-regenerate', aiWriter.changeLangPromtsToRegenerate);
			$(document).on('click', '.pay-method:not(.active)', aiWriter.setPayMethod);
			$(document).on('click', '.aiassist-copy', aiWriter.copy);
			$(document).on('submit', '#aiassist-get-bonus', aiWriter.getBonus);
			$(document).on('keydown', '.aiassist-multi-item', aiWriter.multiKeydownItems);
			$(document).on('paste', '.aiassist-multi-item', aiWriter.pastateBuffer);
			
			$(document).on('keydown', aiWriter.keydown);
			$(document).on('mousedown', '.aiassist-multi-items', aiWriter.mousedown);
			$(document).on('mousemove', aiWriter.mousemove ).on('mouseup', aiWriter.mouseup);
			$(document).on('mouseenter', '.aiassist-article-item', aiWriter.activateBlock);
			
			$(document).on('click', '.aiassist-lock', aiWriter.lockEvent);
			$(document).on('mouseenter', '.aiassist-lock', aiWriter.showInfo);
			$(document).on('mouseleave', '.aiassist-lock', aiWriter.hideInfo);
			$(document).on('click', '.aiassist-rate-desc', aiWriter.openRateInfo);
			$(document).on('click', aiWriter.hideSelect);
			$(document).on('click', '.aiassist-select-lable', aiWriter.openSelect);
			$(document).on('click', '.aiassist-option:not(.aiassist-lock)', aiWriter.changeSelect);
			
			if( textModel = aiWriter.getCookie('text-model') )
				$('#aiassist-change-text-model').closest('.aiassist-select').find('.aiassist-option[data-value="'+ textModel +'"]').click();
			
			if( textModelEditor = aiWriter.getCookie('text-model-editor') )
				$('#aiassist-change-text-model-editor').closest('.aiassist-select').find('.aiassist-option[data-value="'+ textModelEditor +'"]').click();
			
			if( textModelRewrite = aiWriter.getCookie('text-model-rewrite') )
				$('#aiassist-rewrite-text-model').closest('.aiassist-select').find('.aiassist-option[data-value="'+ textModelRewrite +'"]').click();
			
			if( imgModel = aiWriter.getCookie('image-model') ){
				$('.aiassist-image-model .aiassist-option[data-value="'+ imgModel +'"]').click();
				setTimeout( aiWriter.translatePromtsToImages, 1500);
			}
			
			if( imgModelAuto = aiWriter.getCookie('image-model-auto') )
				$('.aiassist-image-model-auto .aiassist-option[data-value="'+ imgModelAuto +'"]').click();
			
			if( imgModelReplace = aiWriter.getCookie('image-model-replace') )
				$('.aiassist-image-model-replace .aiassist-option[data-value="'+ imgModelReplace +'"]').click();
			
			if( imgModelRewrite = aiWriter.getCookie('image-model-rewrite') )
				$('.aiassist-image-model-rewrite .aiassist-option[data-value="'+ imgModelRewrite +'"]').click();
			
			if( aiassist.token ){
				if( ( tab = aiWriter.getCookie('activeTab') ) || $('.aiassist-empty-limit').length < 2 )
					$('.aiassist-tab[data-tab="'+ tab +'"]').click();
					
				if( $('.aiassist-empty-limit').length > 1 && $('.aiassist-tab[data-tab="rates"]').length )
					$('.aiassist-tab[data-tab="rates"]').click();
				
				if( window.location.hash == '#rates' )
					aiWriter.scrollToTopUpBalance();
				
				if( ! aiassist.token )
					$('.aiassist-tab[data-tab="settings"]').click();
			}
			
			if( window.location.hash == '#ai_assistant' && $('#ai_assistant').length )
				$('html, body').animate( { scrollTop: $('#ai_assistant').offset().top }, 1000);
			
			
			$(document).on('click', '#stop-images', aiWriter.replaceImagesStop);
			$(document).on('click', '#start-images', aiWriter.replaceImagesStart);
			$(document).on('click', '#reset-images', aiWriter.replaceImagesReset);
			$(document).on('click', '#restore-images', aiWriter.replaceImagesRestore);
			$(document).on('click', '#remove-images', aiWriter.replaceImagesRemove);
			$(document).on('click', 'a[href*="page=wpai-assistant#rates"]', aiWriter.scrollToTopUpBalance);
			
			$(document).on('change', '#cat-images', aiWriter.disabledImagesUrlArea);
			$(document).on('change', '#replace-images-all', aiWriter.replaceAllImagesChecked);
			$(document).on('change', 'input[name*="images_type"]', aiWriter.imagesTypeChecked);
		},
		
		scrollToTopUpBalance: () => {
			$('.aiassist-tab[data-tab="rates"]').click();
			$('html, body').animate( { scrollTop: $('.aiassist-tab[data-tab="rates"]').offset().top }, 1000);
			history.replaceState(null, '', window.location.pathname + window.location.search);
		},
		
		closeNotice: function(){
			const notice = $(this).closest('.aiwriter-notice');
			
			notice.hide();
			aiWriter.setCookie( notice.data('notice'), true );
		},
		
		replaceImagesRemove: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			$('#remove-images').addClass('disabled').text( aiassist.locale['Removing...'] );
			
			await aiWriter.request( { action: 'replaceImagesRemove', nonce: aiassist.nonce } );
			
			$('#aiassist-images-compleat-count, #aiassist-images-all-count').text(0);
			$('#remove-images').removeClass('disabled').text( aiassist.locale['Removeds'] ).delay(3000).queue( next => {
				$('#remove-images').text( aiassist.locale['Remove original images'] ).
				next();
			});
			$('#aiassist-images-status').text( aiassist.locale['Original images removed'] );
		},
		
		replaceImagesRestore: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			$('#restore-images').addClass('disabled').text( aiassist.locale['Restoring...'] );
			
			await aiWriter.request( { action: 'replaceImagesRestore', nonce: aiassist.nonce } );
			
			$('#aiassist-images-compleat-count, #aiassist-images-all-count').text(0);
			$('#restore-images').removeClass('disabled').text( aiassist.locale['Restored'] ).delay(3000).queue( next => {
				$('#restore-images').text( aiassist.locale['Restore original / removing generated images'] ).
				next();
			});
			$('#aiassist-images-status').text( aiassist.locale['Original images installed and generated ones removed'] );
		},
		
		replaceImagesReset: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			$('#stop-images').attr('disabled', true);
			$('#start-images').attr('disabled', false);
			$('#aiassist-images-compleat-count, #aiassist-images-all-count').text(0);
			$('#aiassist-images-status').text( aiassist.locale['The regeneration process has been stopped.'] );
			
			await aiWriter.request( { action: 'replaceImagesReset', nonce: aiassist.nonce } );
		},
		
		replaceImagesStart: async () => {
			$('#start-images').attr('disabled', true);
			$('#stop-images').attr('disabled', false);
			$('#aiassist-images-status').text( aiassist.locale['The process of regeneration is underway...'] );
			
			let args = {
				types: [],
				cat: $('#cat-images').val(),
				all: $('#replace-images-all').prop('checked'),
				links: $('#aiassist-images-item').val().split("\n"),
				no_attach: $('#no-attach').prop('checked'),
				imageModel: $('#aiassist-images-model').val()
			};
			
			if( $('input[name*="images_type"]:checked').length ){
				$('input[name*="images_type"]:checked').each(function(){
					args.types.push( $(this).val() )
				})
			}
			
			$('#aiassist-images-item').val('');
			$('#cat-images option:first').prop('selected', true);
			$('#replace-images-all, input[name*="images_type"]').prop( { checked: false, disabled: false } );
			$('#cat-images, .aiassist-images-item-block, .aiassist-images-options-items').removeClass('disabled');
			
			let data = await aiWriter.request( Object.assign( args, { action: 'replaceImagesStart', nonce: aiassist.nonce } ) );
			
			if( data.attachments && data.attachments.length ){
				$('#aiassist-images-progress').show();
				$('#aiassist-images-compleat-count').text(0);
				$('#aiassist-images-all-count').text( data.attachments.length );
			} else {
				$('#stop-images').attr('disabled', true);
				$('#start-images').attr('disabled', false);
			}
			
		},
		
		replaceImagesStop: async () => {
			$('#start-images').attr('disabled', false);
			$('#stop-images').attr('disabled', true);
			$('#aiassist-images-status').text( aiassist.locale['The regeneration process has been stopped.'] );
			
			await aiWriter.request( { action: 'replaceImagesStop', nonce: aiassist.nonce } ); 
		},
		
		disabledImagesUrlArea: () => {
			$('.aiassist-images-options-items')[ ( $('#cat-images').val() > 0 ? 'addClass' : 'removeClass' ) ]('disabled');
		},
		
		imagesTypeChecked: function(){
			$('.aiassist-images-item-block, #cat-images')[ ( $('input[name*="images_type"]').is(':checked') ? 'addClass' : 'removeClass' ) ]('disabled');
		},
		
		replaceAllImagesChecked: () => {
			let check = $('#replace-images-all').is(':checked');
			$('input[name*="images_type[]"]').prop( { 'checked': check, 'disabled': check } );
			$('.aiassist-images-item-block, #cat-images')[ ( check ? 'addClass' : 'removeClass' ) ]('disabled');
		},
		
		hideSelect: function( event ){
			if( ! $( event.target ).closest('.aiassist-select-wrap').length )
				$('.aiassist-select').removeClass('open');
		},
		
		openSelect: function(){
			let e = $(this);
			let block = e.closest('.aiassist-select-wrap');
			let select = block.find('.aiassist-select');
			
			select.toggleClass('open');
			select.find('.aiassist-option').removeClass('selected');
			select.find('.aiassist-option[data-value="'+ e.attr('value') +'"]').addClass('selected');
		},
		
		changeSelect: function(){
			let e = $(this);
			let block = e.closest('.aiassist-select-wrap');
			let select = block.find('.aiassist-select');
			let value = e.data('value');
			
			block.find('.aiassist-select-lable').text( e.text() ).attr('value', value );
			select.find('input').val( value ).change();
			select.removeClass('open');
		},
		
		openRateInfo: function(){
			$(this).toggleClass('open');
		},
		
		hideInfo: () => {
			$('#aiassist-info').hide();
		},
		
		lockEvent: function( event ){
			event.preventDefault();
			return false;
		},
		
		showInfo: function( event ){
			const e = $(this);
			
			if( ! $('#aiassist-info').length )
				$('body').append('<div id="aiassist-info" />');
			
			$('#aiassist-info').html( aiassist.locale['These neural networks are only available by subscription only'] ).css({
				top: ( event.pageY ) +'px',
				left: ( event.pageX )+'px',
			}).show();
		},
		
		mouseup: () => {
			aiWriter.isMouseDown = false;
			$('#aiassist-selection-box').hide();
		},
		
		mousedown: function( e ){
			aiWriter.isMouseDown = true;
			aiWriter.startX = e.pageX;
			aiWriter.startY = e.pageY;

			$('.aiassist-multi-item').removeClass('selected');
			$('#aiassist-selection-box').css({ top: aiWriter.startY + 'px', left: aiWriter.startX + 'px', width: 0, height: 0, display: 'block' });
		},
		
		mousemove: function( e ){
			if( aiWriter.isMouseDown ){
				let X = e.pageX;
				let Y = e.pageY;

				let selectionLeft = Math.min(X, aiWriter.startX);
				let selectionTop = Math.min(Y, aiWriter.startY);
				let selectionRight = Math.max(X, aiWriter.startX);
				let selectionBottom = Math.max(Y, aiWriter.startY);

				$('#aiassist-selection-box').css({
					top: selectionTop - $(document).scrollTop() + 'px',
					left: selectionLeft + 'px',
					width: selectionRight - selectionLeft + 'px',
					height: selectionBottom - selectionTop + 'px',
				});

				aiWriter.activeBlock.find('.aiassist-multi-item').each(function(){
					let e = $(this);
					let top = e.offset().top;
					let left = e.offset().left;
					let bottom = top + e.outerHeight();
					let right = left + e.outerWidth();

					if( selectionRight > left && selectionLeft < right && selectionBottom > top && selectionTop < bottom )
						aiWriter.activeBlock.find('.aiassist-multi-themes .aiassist-multi-item:eq(' + (e.index() - 1) + '), .aiassist-multi-keywords .aiassist-multi-item:eq(' + (e.index() - 1) + ')').addClass('selected');
				});
			}
		},

		activateBlock: function(){
			aiWriter.activeBlock = $(this);
		},
		
		keydown: function( e ){
			if( e.keyCode === 46 || e.keyCode === 8 ){
				const inputs = $('.aiassist-multi-item.selected');
				
				if( inputs.length ){
					inputs.each(function(){
						$(this).removeClass('selected').val('');
					})
				}
			}
		},
		
		pastateBuffer: function( e ){
			e.preventDefault();
			
			let clipboardData = ( e.originalEvent || e ).clipboardData || window.clipboardData;
			let pasteData = clipboardData.getData('Text');
			
			let lines = pasteData.split(/\r?\n/);
			
			let block = $(this).closest('div');
			let inputs = block.find('.aiassist-multi-item');
			
			let index = inputs.index(this);

			for( let i=0; i<lines.length; i++ ){
				let input = inputs.eq( index + i );
				
				if( ! input.length ){
					$('.aiassist-multi-themes, .aiassist-multi-keywords').append('<input class="aiassist-multi-item" />');
					input = block.find('.aiassist-multi-item').last(); 
				}
				
				if( ! input.val().length )
					input.val( lines[i] );
				else
					input.val( input.val().slice(0, input[0].selectionStart) + lines[i] + input.val().slice( input[0].selectionEnd ) );
			}
		},
		
		multiKeydownItems: function( event ){
			let e = $(this).closest('div');

			switch( event.key ){
				case 'Enter':
				case 'ArrowDown':
					event.preventDefault();
					block = e.find('.aiassist-multi-item');
					
					if( ! block.eq( $(this).index() ).length ){
						$('.aiassist-multi-themes, .aiassist-multi-keywords').append('<input class="aiassist-multi-item" />');
						block = e.find('.aiassist-multi-item');
					}
					
					block.eq( $(this).index() ).focus();
				break;
				case 'ArrowUp':
					event.preventDefault();
					
					block = e.find('.aiassist-multi-item');
					block.eq( block.index( this ) - 1 ).focus();
				break;
			}
		},
				
		getBonus: async function(event){
			event.preventDefault();

			let e = $(this);
			e.find('button').before('<div>'+ aiassist.locale['Payout request sent'] +'</div>').addClass('disabled');
			
			let args = aiWriter.getFormData( e );
			e[0].reset();
			await aiWriter.request( Object.assign( args, { action: 'getBonus', nonce: aiassist.nonce } ) );
		},
		
		copy: function(){
			let e = $(this);
			
			e.addClass('active').delay(200).queue( next => {
				e.removeClass('active');
				next();
			})
			
			aiWriter.buffer( e.text() );
		},
		
		setPayMethod: function(){
			const e = $(this);
			
			$('.pay-method').removeClass('active');
			e.addClass('active');
			
			let billing = e.data('billing');
			$('.aiassist-recurring-agree label')[ ( e.data('recurring') ? 'show' : 'hide' ) ]();
			$('.aiassist-rates-custom')[ ( $('.pay-method.active').data('custom-disabled') ? 'hide' : 'show' ) ]();
			
			if( $('[data-usdt]').length ){
				$('[data-usdt]').each(function(){
					const e = $(this);
					
					let rub = e.text();
					let usdt = e.attr('data-usdt');
					
					/* mod fix s */
						switch( billing ){
							case 'robokassa':
								if( usdt.indexOf('$') != -1 )
									return;
							break;
							default:
								if( usdt.indexOf('$') == -1 )
									return;
						}
					/* mod fix e */
					
					switch( $(this).prop('tagName') ){
						case 'INPUT':
							rub = e.attr('placeholder');
							e.attr('min', parseInt( usdt ) );
							e.attr('placeholder', usdt);
						break;
						default:
							e.text( usdt );
					}
					
					e.attr('data-usdt', rub );
					
				})
			}
		},
		
		showKeywordsArea: function(){
			let e = $(this);
			let show = null;
			
			setTimeout( () => {	
				if( e.hasClass('aiassist-multi-item') ){
					$('.aiassist-multi-keywords .aiassist-multi-item').each(function(){
						if( $(this).val() )
							show = true;
					})
				}
				e.closest('[data-tab]').find('.aiassist-keywords-area')[ ( e.val().length || show ? 'show' : 'hide' ) ]();
			}, 0)
		},
		
		savePromt: async function( event ){
			clearTimeout( aiWriter.t );
			
			let e = $(this);
			let promt = e.val();
			
			/* check vars to promt start */
				if( check = e.attr('data-check') ){
					check = e.val().match( new RegExp( check.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') ) );
					
					if( ! check && ! e.closest('div').find('.aiassist-check-key').length )
						e.after('<div class="aiassist-check-key">'+ aiassist.locale['There is no variable'] +'</div>');
					
					if( check )
						e.closest('div').find('.aiassist-check-key').remove();
				}
			/* check vars to promt end */
			
			let lang_id = parseInt( $('.aiassist-lang-promts:visible:first').val() );
			
			if( isNaN( lang_id ) )
				lang_id = 0;
		
			switch( e.attr('id') ){
				case 'aiassist-rewrite-prom':
					aiassist.promts['rewrite'][ lang_id ] = promt;
				break;
				case 'aiassist-header-prom-rewrite':
					aiassist.promts['rewrite_header'][ lang_id ] = promt;
				break;
				case 'aiassist-title-prom-rewrite':
					aiassist.promts['rewrite_title'][ lang_id ] = promt;
				break;
				case 'aiassist-desc-prom-rewrite':
					aiassist.promts['rewrite_desc'][ lang_id ] = promt;
				break;
				
				case 'aiassist-generation-prom':
					aiassist.promts['multi'][ lang_id ] = promt;
				break;
				
				case 'aiassist-generation-prom-keywords':
					aiassist.promts['multi_keywords'][ lang_id ] = promt;
				break;
				
				case 'aiassist-article-prom-keywords':
					aiassist.promts['keywords'][ lang_id ] = promt;
				break;
				
				case 'aiassist-article-prom-long-keywords':
					aiassist.promts['long_keywords'][ lang_id ] = promt;
				break;
				
				case 'aiassist-title-prom-multi':
					aiassist.promts['multi_title'][ lang_id ] = promt;
				break;
				case 'aiassist-desc-prom-multi':
					aiassist.promts['multi_desc'][ lang_id ] = promt;
				break;
				case 'aiassist-article-prom':
					aiassist.promts['short'][ lang_id ] = promt;
				break;
				case 'aiassist-theme-prom':
					aiassist.promts['long_header'][ lang_id ] = promt;
				break;
				case 'aiassist-structure-prom':
					aiassist.promts['long_structure'][ lang_id ] = promt;
				break;
				case 'aiassist-content-prom':
					aiassist.promts['long'][ lang_id ] = promt;
				break;
				case 'aiassist-title-prom':
					aiassist.promts['long_title'][ lang_id ] = promt;
				break;
				case 'aiassist-desc-prom':
					aiassist.promts['long_desc'][ lang_id ] = promt;
				break;
				case 'aiassist-prom-regenerate':
					aiassist.promts['regenerate'][ parseInt( $('.aiassist-lang-promts-regenerate').val() ) ] = promt;
				break;
				
				case 'aiassist-system-image-prompt-auto':
					aiassist.promts['img_auto'][ aiWriter.getImageModelIndex( $('#aiassist-image-model').val() ) ] = promt;
				break;
				
				case 'aiassist-system-image-prompt-rewrite':
					aiassist.promts['img_rewrite'][ aiWriter.getImageModelIndex( $('#aiassist-rewrite-image-model').val() ) ] = promt;
				break;
				
				case 'aiassist-system-image-prompt-replace':
					aiassist.promts['img_replace'][ aiWriter.getImageModelIndex( $('#aiassist-images-model').val() ) ] = promt;
				break;
			}
			
			aiWriter.t = setTimeout( async () => {
				await aiWriter.request( { val: aiassist.promts, act: 'promts', action: 'saveStep', nonce: aiassist.nonce } );
			}, 1500);
		},
		
		changeLangPromts: async function(){
			aiWriter.setLangPromts( $(this).val() )
		},
		
		setDefaultPromts: () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			aiWriter.setLangPromts( $('.aiassist-lang-promts:visible:first').val(), true )
		},
		
		setDefaultPromtsRegenerate: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			lang = parseInt( $('.aiassist-lang-promts-regenerate').val() );
			
			if( isNaN( lang ) )
				lang = 0;
			
			if( typeof aiassist.promts.regenerate[ lang ] !== 'undefined' ){	
				aiassist.promts.regenerate	= aiassist.info.promts.regenerate;
				$('#aiassist-prom-regenerate').val( aiassist.promts.regenerate[ lang ] )
				await aiWriter.request( { val: aiassist.promts, act: 'promts', action: 'saveStep', nonce: aiassist.nonce } );
			}
		},
		
		changeLangPromtsToRegenerate: async function(){
			let lang = parseInt( $(this).val() );
			
			if( typeof aiassist.promts.regenerate[ lang ] !== 'undefined' && $('#aiassist-prom-regenerate').is(':visible') ){
				aiassist.promts['regenerate_lang'] = lang;
				
				if( $('#aiassist-prom-regenerate').is(':visible') )
					$('#aiassist-prom-regenerate').val( aiassist.promts.regenerate[ lang ] )
				
				await aiWriter.request( { val: aiassist.promts, act: 'promts', action: 'saveStep', nonce: aiassist.nonce } );
			}
		},
		
		setLangPromts: async ( lang, def = false ) => {
			lang = parseInt( lang );
			
			if( isNaN( lang ) )
				lang = 0;
			
			$('.aiassist-check-key:visible').remove();
			
			if( typeof aiassist.promts.multi[ lang ] !== 'undefined' && $('#aiassist-generation-prom').is(':visible') ){
				aiassist.promts['multi_lang'] = lang;
				
				if( def ){
					aiassist.promts.multi[ lang ]			= aiassist.info.promts.multi[ lang ];
					aiassist.promts.multi_title[ lang ]		= aiassist.info.promts.multi_title[ lang ];
					aiassist.promts.multi_desc[ lang ]		= aiassist.info.promts.multi_desc[ lang ];
					aiassist.promts.multi_keywords[ lang ]	= aiassist.info.promts.multi_keywords[ lang ];
					
					aiassist.promts.img_auto.flux			= aiassist.info.promts.img_auto.flux;
					aiassist.promts.img_auto.gptMini		= aiassist.info.promts.img_auto.gptMini;
					aiassist.promts.img_auto.dalle			= aiassist.info.promts.img_auto.dalle;
					aiassist.promts.img_auto.gptImage		= aiassist.info.promts.img_auto.gptImage;
					aiassist.promts.img_auto.banana			= aiassist.info.promts.img_auto.banana;
					aiassist.promts.img_auto.midjourney		= aiassist.info.promts.img_auto.midjourney;
				}
			
				$('#aiassist-image-model').change();
				$('#aiassist-generation-prom').val( aiassist.promts.multi[ lang ] )
				$('#aiassist-title-prom-multi').val( aiassist.promts.multi_title[ lang ] )
				$('#aiassist-desc-prom-multi').val( aiassist.promts.multi_desc[ lang ] )
				$('#aiassist-generation-prom-keywords').val( aiassist.promts.multi_keywords[ lang ] )
			}
			
			
			if( typeof aiassist.promts.rewrite[ lang ] !== 'undefined' && $('#aiassist-rewrite-prom').is(':visible') ){
				aiassist.promts['rewrite_lang'] = lang;
				
				if( def ){
					aiassist.promts.rewrite[ lang ] = aiassist.info.promts.rewrite[ lang ];
					aiassist.promts.rewrite_header[ lang ] = aiassist.info.promts.rewrite_header[ lang ];
					aiassist.promts.rewrite_title[ lang ] = aiassist.info.promts.rewrite_title[ lang ];
					aiassist.promts.rewrite_desc[ lang ] = aiassist.info.promts.rewrite_desc[ lang ];
					
					aiassist.promts.img_rewrite.flux		= aiassist.info.promts.img_rewrite.flux;
					aiassist.promts.img_rewrite.gptMini		= aiassist.info.promts.img_rewrite.gptMini;
					aiassist.promts.img_rewrite.dalle		= aiassist.info.promts.img_rewrite.dalle;
					aiassist.promts.img_rewrite.gptImage	= aiassist.info.promts.img_rewrite.gptImage;
					aiassist.promts.img_rewrite.banana		= aiassist.info.promts.img_rewrite.banana;
					aiassist.promts.img_rewrite.midjourney	= aiassist.info.promts.img_rewrite.midjourney;
				}
				
				$('#aiassist-rewrite-image-model').change();
				$('#aiassist-rewrite-prom').val( aiassist.promts.rewrite[ lang ] );
				$('#aiassist-header-prom-rewrite').val( aiassist.promts.rewrite_header[ lang ] );
				$('#aiassist-title-prom-rewrite').val( aiassist.promts.rewrite_title[ lang ] );
				$('#aiassist-desc-prom-rewrite').val( aiassist.promts.rewrite_desc[ lang ] );
			}
			
			if( typeof aiassist.promts.short[ lang ] !== 'undefined' && $('#aiassist-article-prom').is(':visible') ){
				aiassist.promts['short_lang'] = lang;
				
				if( def ){
					aiassist.promts.short[ lang ]			= aiassist.info.promts.short[ lang ];
					aiassist.promts.long_title[ lang ]		= aiassist.info.promts.long_title[ lang ];
					aiassist.promts.long_desc[ lang ]		= aiassist.info.promts.long_desc[ lang ];
					aiassist.promts.keywords[ lang ]		= aiassist.info.promts.keywords[ lang ];
					aiassist.promts.long_keywords[ lang ]	= aiassist.info.promts.long_keywords[ lang ];
				}
				
				$('#aiassist-article-prom').val( aiassist.promts.short[ lang ] )
				$('#aiassist-title-prom').val( aiassist.promts.long_title[ lang ] )
				$('#aiassist-desc-prom').val( aiassist.promts.long_desc[ lang ] )
				$('#aiassist-article-prom-keywords').val( aiassist.promts.keywords[ lang ] )
			}
			
			if( typeof aiassist.promts.long_header[ lang ] !== 'undefined' && $('#aiassist-theme-prom').is(':visible') ){
				aiassist.promts['long_lang'] = lang;
				
				if( def ){
					aiassist.promts.long_header[ lang ]		= aiassist.info.promts.long_header[ lang ];
					aiassist.promts.long_structure[ lang ]	= aiassist.info.promts.long_structure[ lang ];
					aiassist.promts.long[ lang ]			= aiassist.info.promts.long[ lang ];
					aiassist.promts.long_title[ lang ]		= aiassist.info.promts.long_title[ lang ];
					aiassist.promts.long_desc[ lang ]		= aiassist.info.promts.long_desc[ lang ];
					aiassist.promts.long_keywords[ lang ]	= aiassist.info.promts.long_keywords[ lang ];
				}
				
				$('#aiassist-theme-prom').val( aiassist.promts.long_header[ lang ] )
				$('#aiassist-structure-prom').val( aiassist.promts.long_structure[ lang ] )
				$('#aiassist-content-prom').val( aiassist.promts.long[ lang ] )
				$('#aiassist-title-prom').val( aiassist.promts.long_title[ lang ] )
				$('#aiassist-desc-prom').val( aiassist.promts.long_desc[ lang ] )
				$('#aiassist-article-prom-long-keywords').val( aiassist.promts.long_keywords[ lang ] )
			}
			
			await aiWriter.request( { val: aiassist.promts, act: 'promts', action: 'saveStep', nonce: aiassist.nonce } );
		},
		
		disabledRewriteUrlArea: function(){
			let e = $(this);
			let area = $('.aiassist-rewrite-item, .aiassist-cats-item, #aiassist-addItemRewrite, .rewrite-block-type');
			area[ ( $('#cat-rewrite input[type="checkbox"]:checked').length > 0 ? 'addClass' : 'removeClass' ) ]('disabled');
		},
		
		postsRestores: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			let posts = $('.aiassist-post-restore');
			
			if( posts.length ){
				for( let i = 0; i < posts.length; i++ )
					await aiWriter.restore( $( posts[ i ] ) );
			}
		},
		
		postRestore: function(){
			let e = $(this);
			
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			aiWriter.restore( $(this) );
		},
		
		restore: ( e ) => {
			return new Promise( async resolve => {
				let status = e.closest('.aiassist-rewrite-queue').find('.aiassist-queue-status');
				e.remove();
				
				status.text( aiassist.locale['Restoring...'] );
				await aiWriter.request( { action: 'postRestore', post_id: e.attr('post_id'), revision_id: e.attr('revision_id'), nonce: aiassist.nonce } );
				status.text( aiassist.locale['Restored'] );
				resolve( true );
			})
		},
		
		rewriteInputsChecked: function(){
			aiWriter.hideRewriteItems( $('input[name*="rewrite_type"]').is(':checked') );
		},
		
		rewriteAllSiteChecked: () => {
			let check = $('#rewrite_all').is(':checked');
			$('input[name*="rewrite_type"]').prop( { 'checked': check, 'disabled': check } );
			aiWriter.hideRewriteItems( check );
		},
		
		tonyMcePopUpHide: () => {
			$('#aiassist-generate-image').hide();
		},
		
		clearContent: async () => {
			if( ! confirm( aiassist.locale['Are you sure you want to clear all fields from the generated text?'] ) )
				return false;
		
			aiWriter.editor.setContent('');
			aiWriter.setCookie('spent', 0);
			aiWriter.setCookie('imgSpent', 0);
			
			$('.aiassist-headers').html('');
			$('#step1, #step2, #step3, #step4, #step6').hide();
			$('#aiassist-article-symbols, #images-article-symbols').text('0');
			$('#aiassist-theme, #aiassist-header, #aiassist-structure, #aiassist-title, #aiassist-desc').val('');
			
			await aiWriter.request( { action: 'clearContent', nonce: aiassist.nonce } );
		},
		
		tinyMceImageGenerate: async function(){
			let proccess = 0;
			let block = $('#aiassist-generate-image');
			let promt = $('#aiassist-tiny-image-promt').val();
			let model = $('#aiassist-tiny-image-model').val();
			
			if( ! promt.trim().length ){
				$('#aiassist-tiny-image-promt').addClass('aiassist-error');
				return false;
			}
			$('#aiassist-tiny-image-promt').removeClass('aiassist-error');
			
			$('#aiassist-tiny-image-save').hide();
			$('.aiassist-image-tiny-item').addClass('aiassist-images aiassist-proces disabled');
			
			if( promt.match(/[А-Яа-я]/g) && ( model == 'midjourney' || model == 'flux' ) ){
				let task = await aiWriter.request( { action: 'translate', token: aiassist.token, content: promt }, aiassist.api );
				
				if( parseInt( task.limit ) < 1 )
					block.find('.aiassist-image-tiny-item').removeClass('aiassist-proces disabled').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span></span>');
					
				if( task.task_id ){
					let translate = await aiWriter.request( { action: 'getTask', token: aiassist.token, id: task.task_id }, aiassist.api );
					
					if( translate.content ){
						promt = translate.content;
						$('#aiassist-tiny-image-promt').val( translate.content );
					}
				} else
					$('#aiassist-tiny-image-promt').val('Error translate promt');
			}
			
			let task = await aiWriter.request( { action: 'image_generator', token: aiassist.token, model: model, header: promt, format: 'jpg' }, aiassist.api );
			
			if( parseInt( task.limit ) < 1 )
				block.find('.aiassist-images').removeClass('aiassist-proces disabled').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span></span>');
				
			if( task.task_id ){
				while( true ){
					let data = await aiWriter.request( { action: 'getTask', id: task.task_id, token: aiassist.token }, aiassist.api );
					
					if( data.process ){
						if( data.process.progress > proccess ){
						
							if( ! block.find('.aiassist-progressImageUrl').length )
								block.find('.aiassist-images').html('<img src="'+ data.process.progressImageUrl +'" class="aiassist-progressImageUrl">');
							
							block.find('.aiassist-progressImageUrl').attr('src', data.process.progressImageUrl);
						}
						proccess = data.process.progress;
					}
					
					if( data.nsfw )
						return block.find('.aiassist-images').removeClass('aiassist-proces disabled').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Prompt was censored'] +'</span>');
					
					if( data.images ){
						block.find('.aiassist-images').html('');
					
						for( let k in data.images )
							block.find('.aiassist-images').removeClass('aiassist-proces disabled').append('<img src="'+ aiassist.api +'?action=getImage&image='+ data.images[ k ] +'" class="ai-image">');
						
						block.find('.ai-image:first').click();
						break;
					}
					await aiWriter.sleep(5);
				}
			}
		},
		
		tinyMceTranslate: async function(){
			let e = $(this);
			let block = e.closest('#aiassist-generate-image');
			let title = block.find('#aiassist-tiny-image-promt').val();
			
			let task = await aiWriter.request( { action: 'translate', token: aiassist.token, content: title }, aiassist.api );
			
			if( parseInt( task.limit ) < 1 )
				block.find('.aiassist-image-tiny-item').removeClass('aiassist-proces disabled').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span></span>');		
			
			if( task.task_id ){
				let translate = await aiWriter.request( { action: 'getTask', token: aiassist.token, id: task.task_id }, aiassist.api );
				
				if( translate.content ){
					block.find('#aiassist-tiny-image-promt').val( translate.content );
					return;
				}
			}
			block.find('#aiassist-tiny-image-promt').val('Error translate promt');
		},
		
		tinyMceImageSave: async function(){
			let e = $(this);
			let block = e.closest('.aiassist-image-tiny');
			let title = block.find('#aiassist-tiny-image-promt').val();
			
			if( ! block.find('.ai-image.active').length )
				return false;
			
			block.find('#aiassist-tiny-image-save').hide();
			block.find('.aiassist-images').addClass('aiassist-proces disabled');
			
			if( block.find('.ai-image.active').length ){
				let images = [];
				
				block.find('.ai-image.active').each(function(){
					images.push( $(this).attr('src') );
				})
				
				let str = '';
				let post_id = null;
				
				if( $('#post_ID').length )
					post_id = $('#post_ID').val();
				
				if( ! post_id )
					post_id = wp.data.select('core/editor').getCurrentPostId();
				
				for( let k in images ){
					let load = await aiWriter.request( { action: 'loadImage', post_id: post_id, 'image[src]': images[ k ], 'image[title]': title, nonce: aiassist.nonce } );
					str += '<img class="alignnone size-full wp-image-'+ load.id +'" src="'+ load.url +'" title="'+ title +'" alt="'+( title + aiassist.locale['photo'] )+'" />';
				}

				tinyMCE.activeEditor.insertContent( str );
				$('#aiassist-generate-image').hide();
				block.find('.aiassist-images').removeClass('aiassist-proces disabled').html('');
			}
		},
		
		selectImageInBlock: function(){
			let e = $(this);
			let block = e.closest('.aiassist-image-block, #aiassist-generate-image');
			
			if( e.hasClass('active') )
				e.removeClass('active');
			else
				e.addClass('active');
				
			if( block.find('.ai-image.active').length )
				$('#aiassist-tiny-image-save, .aiassist-image-save').show();
			else
				$('#aiassist-tiny-image-save, .aiassist-image-save').hide();
		},
		
		cron: async () => {
			aiWriter.checkPing = await aiWriter.ping( aiWriter.checkPing == undefined ? 1500 : 3000 );
			
			let args = await aiWriter.request( { action: 'assistcron', nonce: aiassist.nonce } );
			let limit = await aiWriter.request( { action: 'getLimit', token: aiassist.token }, aiassist.api );
			let total = parseInt( limit.sLimit || 0 ) + parseInt( limit.limit || 0 );

			if( ! isNaN( total ) && total >= 5000 ){
				
				if( $('#ai_writer_limin_notice .notice-dismiss').length )
					$('#ai_writer_limin_notice').hide();
				
				document.cookie = "disabled_notice_3=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
			}
			
			if( ! isNaN( parseInt( limit.sLimit ) ) && $('#wpai-symbols-subscribe').length )
				$('#wpai-symbols-subscribe').text( aiWriter.number_format( limit.sLimit ) );
			
			if( ! isNaN( parseInt( limit.limit ) ) && $('#wpai-symbols').length ){
				$('#wpai-symbols').text( aiWriter.number_format( limit.limit ) );
				
				if( limit.limit < 1 && limit.sLimit < 1 )
					$('#aiassist-generation-status, #aiassist-rewrite-status').html('<span class="aiassist-warning-limits">'+ aiassist.locale['The limits have been reached'] +'</span>');
			}
			
			
			if( $('#aiassist-settings').length && args.articles && ! isNaN( parseInt( args.articles.publish ) ) ){
				
				if( $('#aiassist-count-publish').length )
					$('#aiassist-count-publish').text( args.articles.publish );
				
				if( args.articles.publish >= args.articles.count ){
					$('#stop-articles-generations').click();
					$('#aiassist-generation-status').text( aiassist.locale['The article generation process is complete.']);
				}
				
				if( ! isNaN( parseInt( args.articles.limit ) ) ){
					$('#wpai-symbols').text( aiWriter.number_format( args.articles.limit ) );
					
					if( args.articles.limit < 1 )
						$('#aiassist-generation-status').html('<span class="aiassist-warning-limits">'+ aiassist.locale['The limits have been reached'] +'</span>');
				}
					
				if( args.articles.articles ){
					for( let k in args.articles.articles ){
					
						if( ! args.articles.articles[ k ].post_id )
							continue;
						
						$('.aiassist-article-queue').filter(function(){
							let e = $(this);
							
							if( e.find('.aiassist-queue-keyword').text().trim() == args.articles.articles[ k ].theme.trim() && e.find('.aiassist-queue-keyword').length ){
								
								e.find('.aiassist-queue-status').text( aiassist.locale['Generated'] );
								
								e.find('.aiassist-queue-keyword').wrap('<a href="/wp-admin/post.php?post='+ args.articles.articles[ k ].post_id +'&action=edit" target="_blank" ></a>');
								e.find('.aiassist-queue-keyword').removeClass('aiassist-queue-keyword');
								e.removeClass('aiassist-queue').find('.aiassist-article-item-close').remove();
								
								let status = aiassist.locale['Generation in progress'];
								
								if( args.articles.publishInDay && args.articles.counter && args.articles.publishInDay <= Object.values( args.articles.counter )[0] )
									status = aiassist.locale['Suspended'];
							
								e.next().find('.aiassist-queue-status').text( status );
							}
						})
						
					}
				}
			}
			
			if( $('#aiassist-settings').length && args.rewrites && args.rewrites.posts ){

				if( ! isNaN( parseInt( args.rewrites.limit ) ) ){
					$('#wpai-symbols').text( aiWriter.number_format( args.rewrites.limit ) );
					
					if( args.rewrites.limit < 1 )
						$('#aiassist-generation-status').html('<span class="aiassist-warning-limits">'+ aiassist.locale['The limits have been reached, to continue generation (rewriting) please top up your balance!'] +'</span>');
				}

				if( args.rewrites.posts.length ){
					
					if( $('#aiassist-rewrite-count-publish').length )
						$('#aiassist-rewrite-count-publish').text( args.rewrites.counter );
					
					if( args.rewrites.counter >= args.rewrites.posts.length ){
						$('#stop-rewrite-generations').click();
						$('#aiassist-rewrite-status').text( aiassist.locale['The process of rewriting articles is complete.'] );
					}
				
					for( let k in args.rewrites.posts ){
					
						if( ! args.rewrites.posts[ k ].post_id )
							continue;
						
						$('.aiassist-rewrite-queue').filter(function(){
							let e = $(this);
							let check = false;
							
							if( args.rewrites.posts[ k ].url != undefined )
								check = e.find('.aiassist-queue-rewrite').text().trim() == args.rewrites.posts[ k ].url.trim();
							
							if( args.rewrites.posts[ k ].title != undefined )
								check = e.find('.aiassist-queue-rewrite').text().trim() == args.rewrites.posts[ k ].title.trim();
							
							if( check && e.find('.aiassist-queue-rewrite').length ){
								e.find('.aiassist-queue-status').text( aiassist.locale['Generated'] );
								
								if( args.rewrites.posts[ k ].revision_id && ! args.rewrites.posts[ k ].restore )
									e.find('.aiassist-queue-status').after('<span class="aiassist-post-restore aiassist-orange" post_id="'+ args.rewrites.posts[ k ].post_id +'" revision_id="'+ args.rewrites.posts[ k ].revision_id +'">'+ aiassist.locale['Restore original text'] +'</span>');
								
								e.find('.aiassist-queue-rewrite').wrap('<a href="/wp-admin/post.php?post='+ args.rewrites.posts[ k ].post_id +'&action=edit" target="_blank" ></a>');
								e.find('.aiassist-queue-rewrite').removeClass('aiassist-queue-rewrite');
								
								let next = $('.aiassist-rewrite-queue:eq('+( parseInt( e.index() ) + 1 )+') .aiassist-queue-status');
								if( next.length )
									next.text( aiassist.locale['Generation in progress'] );
							}
						})
						
					}
				}
			
			}
			
			if( $('#aiassist-images-progress').length && args.images && args.images.attachments ){
				let images_all = args.images.attachments.length;
				let images_compleate = args.images.attachments.filter( item => 'replace_id' in item ).length;
				
				if( $('#aiassist-images-all-count').length )
					$('#aiassist-images-all-count').text( images_all );
				
				if( $('#aiassist-images-compleat-count').length )
					$('#aiassist-images-compleat-count').text( images_compleate );
				
				if( images_compleate >= images_all ){
					$('#stop-images').attr('disabled', true);
					$('#start-images').attr('disabled', false);
					$('#aiassist-images-status').text( aiassist.locale['The regeneration process is complete.'] );
				}
			}
			
			setTimeout( aiWriter.cron, 60000 );
		},
		
		number_format: ( number ) => {
			if( isNaN( parseInt( number ) ) )
				return '';
			
			return parseInt( number ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
		},
		
		setTextModel: () => {
			aiWriter.setCookie('text-model', $('#aiassist-change-text-model').val());
		},
		
		setTextModelRewrite: () => {
			aiWriter.setCookie('text-model-rewrite', $('#aiassist-rewrite-text-model').val());
		},
		
		setTextModelEditor: () => {
			aiWriter.setCookie('text-model-editor', $('#aiassist-change-text-model-editor').val());
		},
		
		setImageModel: function(){
			aiWriter.setCookie('image-model', $(this).val() );
		},
		
		setAutoImageModel: function(){
			let model = $(this).val();
			aiWriter.setCookie('image-model-auto', model );
			
			if( $('#aiassist-system-image-prompt-auto').length )
				$('#aiassist-system-image-prompt-auto').val( aiassist.promts.img_auto && aiassist.promts.img_auto[ aiWriter.getImageModelIndex( model ) ] ? aiassist.promts.img_auto[ aiWriter.getImageModelIndex( model ) ] : '' );
		},
		
		setReplaceImageModel: function(){
			let model = $(this).val();
			aiWriter.setCookie('image-model-replace', model );
			
			if( $('#aiassist-system-image-prompt-replace').length )
				$('#aiassist-system-image-prompt-replace').val( aiassist.promts.img_replace && aiassist.promts.img_replace[ aiWriter.getImageModelIndex( model ) ] ? aiassist.promts.img_replace[ aiWriter.getImageModelIndex( model ) ] : '' );
		},
		
		setRewriteImageModel: function(){
			let model = $(this).val();
			aiWriter.setCookie('image-model-rewrite', model );
			
			if( $('#aiassist-system-image-prompt-rewrite').length )
				$('#aiassist-system-image-prompt-rewrite').val( aiassist.promts.img_rewrite && aiassist.promts.img_rewrite[ aiWriter.getImageModelIndex( model ) ] ? aiassist.promts.img_rewrite[ aiWriter.getImageModelIndex( model ) ] : '' );
		},
		
		getImageModelIndex: ( model ) => {
			switch( model ){
				case 'flux':		return 0; break;
				case 'gptMini':		return 1; break;
				case 'dalle':		return 2; break;
				case 'gptImage':	return 3; break;
				case 'banana':		return 4; break;
				case 'midjourney':	return 5; break;
				default:			return null;
			}
		},
		
		autoGenOptions: () => {
			clearTimeout( aiWriter.t );
			
			let args = {
				nonce: aiassist.nonce,
				action: 'autoGenOptions',
				author: $('#aiassist_multi_author').val(),
				pictures: $('#aiassist-auto-multi-images').val(),
				max_pictures: $('#aiassist-max-pictures').val(),
				draft: $('#aiassist-auto-draft').prop('checked') ? 1 : 0,
				thumb: $('#aiassist-auto-thumb').prop('checked') ? 1 : 0,
				textModel: $('#aiassist-change-text-model').val(),
				imageModel: $('#aiassist-image-model').val(),
				publishInDay: $('#publish-article-in-day').val(),
				publishEveryDay: $('#publish-article-every-day').val(),
			};	
			
			aiWriter.t = setTimeout( async () => {
				await aiWriter.request( args ); 
			}, 500);
		},
		
		clearArticlesGeneration: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			$('.aiassist-article-queue').remove();
			$('#stop-articles-generations').attr('disabled', true);
			$('#start-articles-generations').attr('disabled', false);
			$('#aiassist-count-publish').text('0');
			$('#aiassist-generation-status').text('');
			await aiWriter.request( { action: 'clearArticlesGen', nonce: aiassist.nonce } );
		},
		
		stopArticlesGeneration: async () => {
			$('#start-articles-generations').attr('disabled', false);
			$('#stop-articles-generations').attr('disabled', true);
			
			$('#aiassist-generation-status').text( aiassist.locale['The article generation process has been suspended.'] );
			$('.aiassist-article-queue.aiassist-queue:first .aiassist-queue-status').text( aiassist.locale['Suspended'] );
			
			await aiWriter.request( { action: 'stopArticlesGen', nonce: aiassist.nonce } ); 
		},
		
		startArticlesGeneration: async () => {
			$('#start-articles-generations').attr('disabled', true);
			$('#stop-articles-generations').attr('disabled', false);
			
			$('#aiassist-generation-status').text( aiassist.locale['The process of generating'] );
			$('.aiassist-article-queue.aiassist-queue:first .aiassist-queue-status').text( aiassist.locale['Generation in progress'] );
			
			let items = $('.aiassist-article-item');
			
			let check = $('.aiassist-multi-themes .aiassist-multi-item').filter(function() {
				return $(this).val().trim() !== '';
			}).first();
			
			if( ! check.length ){
				await aiWriter.request( { action: 'startArticlesGen', nonce: aiassist.nonce } ); 
				return;
			}
			
			if( items.length ){
				
				let c = 0;
				let index = 0;
				let articles = {}
				
				items.each(function(){
					let e = $(this);
					let id = e.find('.cats-item').val();
					
					e.find('.aiassist-multi-themes .aiassist-multi-item').each(function(){
						let item = $(this);
						let theme = item.val();
						
						if( theme !== '' ){ c++;
						
							if( c % 300 === 0 )
								index++;
							
							if( articles[ index ] == undefined )
								articles[ index ] = {};
							
							if( articles[ index ][ id ] == undefined )
								articles[ index ][ id ] = [];
						
							articles[ index ][ id ].push( { theme: theme, keywords: e.find('.aiassist-multi-keywords .aiassist-multi-item:eq('+( item.index() - 1 )+')').val() } );
							$('.aiassist-articles-queue').append('<div class="aiassist-article-queue aiassist-queue"><div class="aiassist-article-item-close" data-key="'+( c - 1 )+'"></div><span class="aiassist-queue-keyword">'+ theme +'</span> <span class="aiassist-queue-status">'+( c==1 ? aiassist.locale['Generation in progress'] : aiassist.locale['In line'] )+'</span></div>');
						}
						
					})
					
				})
				
				let artPromt = $('#aiassist-generation-prom').val(),
					kwdPromt = $('#aiassist-generation-prom-keywords').val(),
					titlePromt = $('#aiassist-title-prom').val(),
					descPromt = $('#aiassist-desc-prom').val();
					imageModel = $('#aiassist-image-model').val();
					textModel = $('#aiassist-change-text-model').val();
				
				$('#start-articles-generations').html('<div id="aiassist-loader"></div>');
				
				for( let k in articles ){
					if( k > 0 )
						await aiWriter.sleep( 3 );
					
					await aiWriter.request( { articles: articles[ k ], artPromt: artPromt, titlePromt: titlePromt, textModel: textModel, imageModel: imageModel, descPromt: descPromt, action: 'initArticlesGen', nonce: aiassist.nonce } ); 
				}
				
				$('#start-articles-generations').text( aiassist.locale['Start articles generation'] );
				
				$('.aiassist-article-item:not(:first)').remove();
				aiWriter.addItemArticle();
				$('.aiassist-article-item:first, .aiassist-article-item .aiassist-article-item-close').remove();
				
				$('#aiassist-generation-progress').html( aiassist.locale['Generated by'] +' <span id="aiassist-count-publish">0</span> '+ aiassist.locale['articles from'] +' '+ c );
			}
		},
		
		addItemArticle: () => {	
			let item = $('.aiassist-article-item:first').clone();
			$( item ).find('.aiassist-multi-item').val('');
			$( item ).find('.aiassist-multi-item').removeClass('selected');
			$( item ).prepend('<div class="aiassist-article-item-close" />');
			$('.aiassist-article-items').append( item );
		},
		
		articleItemClose: function(){
			$(this).closest('.aiassist-article-item').remove();
		},
		
		queueArticleClose: function(){
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return;

			let e = $(this);
			
			let id = e.attr('data-key');
			e.closest('.aiassist-article-queue').remove();
			aiWriter.request( { nonce: aiassist.nonce, id: id, action: 'removeQueueArticle' } ); 	
		},
		
		rewriteOptions: () => {
			clearTimeout( aiWriter.t );
			
			let args = {
				nonce: aiassist.nonce,
				action: 'rewriteOptions',
				pictures: $('#aiassist-rewrite-multi-images').val(),
				max_pictures: $('#aiassist-rewrite-max-pictures').val(),
				author: $('#aiassist_rewrite_author').val(),
				split: $('#aiassist-rewrite-split').val(),
				excude_h1: $('#aiassist-rewrite-excude-h1').prop('checked') ? 1 : 0,
				excude_title: $('#aiassist-rewrite-excude-title').prop('checked') ? 1 : 0,
				excude_desc: $('#aiassist-rewrite-excude-desc').prop('checked') ? 1 : 0,
				thumb: $('#aiassist-rewrite-thumb').prop('checked') ? 1 : 0,
				draft: $('#aiassist-rewrite-draft').prop('checked') ? 1 : 0,
				textModel: $('#aiassist-rewrite-text-model').val(),
				imageModel: $('#aiassist-rewrite-image-model').val(),
			};	
			
			aiWriter.t = setTimeout( async () => {
				await aiWriter.request( args ); 
			}, 250);
		},
		
		startRewriteGenerations: async () => {
			$('#start-rewrite-generations').attr('disabled', true);
			$('#stop-rewrite-generations').attr('disabled', false);
			$('#aiassist-rewrite-status').text( aiassist.locale['The article rewriting process is in progress'] );
			
			let items = $('.aiassist-rewrite-item-block');
						
			if( ! items.find('.aiassist-rewrite-item').val().trim().length && ! $('.aiassist-rewrite-item-block.disabled, .aiassist-rewrite-item.disabled').length ){
				await aiWriter.request( { action: 'startRewrite', nonce: aiassist.nonce } ); 
				return;
			}
			
			let args = {
				cats: [],
				types: [],
				links: {},
				pictures: $('#aiassist-rewrite-multi-images').val(),
				max_pictures: $('#aiassist-rewrite-max-pictures').val(),
				author: $('#aiassist_rewrite_author').val(),
				split: $('#aiassist-rewrite-split').val(),
				excude_h1: $('#aiassist-rewrite-excude-h1').prop('checked') ? 1 : 0,
				excude_title: $('#aiassist-rewrite-excude-title').prop('checked') ? 1 : 0,
				excude_desc: $('#aiassist-rewrite-excude-desc').prop('checked') ? 1 : 0,
				thumb: $('#aiassist-rewrite-thumb').prop('checked') ? 1 : 0,
				draft: $('#aiassist-rewrite-draft').prop('checked') ? 1 : 0,
				promt: $('#aiassist-rewrite-prom').val(),
				textModel: $('#aiassist-rewrite-text-model').val(),
				imageModel: $('#aiassist-image-model').val(),
				action: 'initRewrite', 
				nonce: aiassist.nonce
			};
			
			if( $('input[name*="rewrite_type"]:checked').length ){
				$('input[name*="rewrite_type"]:checked').each(function(){
					args.types.push( $(this).val() )
				})
			}
			
			if( $('#cat-rewrite input[type="checkbox"]:checked').length ){
				args.cats = $('#cat-rewrite input[type="checkbox"]:checked').map(function(){
								return this.value;
							}).get();
			}
			
			if( items.length ){
				items.each(function(){
					let e = $(this);
					let id = e.find('.cats-item').val();
					let item = e.find('.aiassist-rewrite-item').val().trim();
					
					if( item == '' )	
						return;
					
					if( args.links[ id ] == undefined )
						args.links[ id ] = [];
					
					args.links[ id ] = item.split("\n");
				})
				
				let data = await aiWriter.request( args ); 
				
				let c = 0;
				let p = 0;
				let inProgress = false;
				
				if( data.posts.length ){
					$('.aiassist-rewrites-queue').html('');
					
					for( let i in data.posts ){ c++;
						let status = aiassist.locale['In line'];
						let title = data.posts[ i ].title;
						
						if( data.posts[ i ].url )
							title = data.posts[ i ].url;
					
						if( data.posts[ i ].post_id )
							p++;
					
						if( data.posts[ i ].post_id )
							status = aiassist.locale['Generated'];
							
						if( ! data.posts[ i ].post_id && ! inProgress ){
							inProgress = true;
							status = aiassist.locale['Generation in progress'];
						}
					
						$('.aiassist-rewrites-queue').append('<div class="aiassist-rewrite-queue"><span class="aiassist-queue-rewrite">'+ title +'</span> <span class="aiassist-queue-status">'+ status +'</span></div>');
					}
				}
				
				$('.aiassist-rewrite-item-block:not(:first)').remove();
				aiWriter.addItemRewrite();
				$('.aiassist-rewrite-item-block:first, .aiassist-rewrite-item-close').remove();
				$('#aiassist-rewrite-progress').html( aiassist.locale['Generated by'] +' <span id="aiassist-rewrite-count-publish">'+ p +'</span> '+ aiassist.locale['articles from'] +' '+ c );
			}
		},
		
		stopRewriteGeneration: async () => {
			$('#start-rewrite-generations').attr('disabled', false);
			$('#stop-rewrite-generations').attr('disabled', true);
			$('#aiassist-rewrite-status').text( aiassist.locale['The article generation process has been suspended.'] );
			
			await aiWriter.request( { action: 'stopRewrite', nonce: aiassist.nonce } ); 
		},
		
		clearRewritesGeneration: async () => {
			if( ! confirm( aiassist.locale['Are you sure?'] ) )
				return false;
			
			$('.aiassist-rewrite-queue').remove();
			$('#stop-rewrite-generations').attr('disabled', true);
			$('#start-rewrite-generations').attr('disabled', false);
			$('#aiassist-rewrite-count-publish').text('0');
			$('#aiassist-rewrite-status').text('');
			await aiWriter.request( { action: 'clearRewrite', nonce: aiassist.nonce } );
		},
		
		addItemRewrite: () => {	
			let item = $('.aiassist-rewrite-item-block:first').clone();
			$( item ).find('.aiassist-rewrite-item').val('');
			$( item ).prepend('<div class="aiassist-rewrite-item-close" />');
			$('.aiassist-rewrite-items').append( item );
		},
		
		hideRewriteItems: ( check ) => {
			if( check )
				$('.aiassist-rewrite-item-block, .aiassist-item-repeater').addClass('disabled');
			else
				$('.aiassist-rewrite-item-block, .aiassist-item-repeater').removeClass('disabled');
				
			$('.aiassist-rewrite-item-block:not(:first)').remove();
			aiWriter.addItemRewrite();
			$('.aiassist-rewrite-item-block:first, .aiassist-rewrite-item-close').remove();
		},
		
		rewriteItemClose: function(){
			$(this).closest('.aiassist-rewrite-item-block').remove();
		},
		
		selectImage: function(){
			let e = $(this);
			let block = e.closest('.aiassist-header-item');
			
			if( block.hasClass('aiassist-main-header') )
				block.find('.aiassist-image').removeClass('active');
			
			if( ! e.hasClass('active') ){
				e.addClass('active show').delay(1000).queue( next => {
					e.removeClass('show');
					next();
				});
			} else
				e.removeClass('active');
			
		},
		
		imageGenerator: async function(){
			let e = $(this);
			e.closest('.aiassist-header-item').find('label input[type="checkbox"]').prop('checked', true);
			aiWriter.generateImage( e );
		},
		
		imagesGenerator: async () => {
			if( $('.aiassist-header-item input:checked').length ){
			
				$('#aiassist-images-generator-start').hide();
				$('#aiassist-images-generator-start').attr('disabled', true);
				
				$('.aiassist-header-item input:checked').each(function(){
					aiWriter.generateImage( $(this) );
				})
			
			}
			$('#aiassist-images-generator-start').show();
			$('#aiassist-images-generator-start').attr('disabled', false);
		},
		
		translatePromtsToImages: async () => {
			if( $('.aiassist-headers .aiassist-header-item').length ){
				let h1 = '';
				let model = $('#aiassist-change-image-model').val();
				
				if( [ 'dalle', 'gptImage', 'gptMini', 'banana' ].indexOf( model ) != -1 ){
					if( $('.aiassist-main-header label input').length ){
						h1 = $('.aiassist-main-header label input').val();
						$('.aiassist-main-header .aiassist-translate-promt-image input').val( h1 );
					}
					
					$('.aiassist-header-item:not(.aiassist-main-header)').each(function(){
						let e = $(this);
						
						let header = '';
						if( h1.length )
							header += h1 +'. ';
						header += e.find('label input').val();
						
						e.find('.aiassist-translate-promt-image input').val( header );
					})
					aiWriter.loader();
					return;
				}
				
				if( $('.aiassist-lang-promts:visible:first option:selected').val() != 1 )
					aiWriter.loader( true, aiassist.locale['Translation of prompts for images'] );
				
				const items = $('.aiassist-headers .aiassist-header-item');

				let promts = await Promise.all(items.map(async ( k, e ) => {
					let en = $( e ).find('.aiassist-translate-promt-image input');
						
					if( en.attr('data-en') != undefined && en.attr('data-en').length ){
						en.val( en.attr('data-en') );
						return;
					}
				
					let header = $( e ).find('label input[type="checkbox"]').val();
					let text = header;
					
					if( ! $( e ).find('#aiassist-main').length && $('#aiassist-main').length )
						text = $('#aiassist-main').val() +' '+ header;
					
					if( $('.aiassist-lang-promts:visible:first option:selected').val() == 1 ){
						$( e ).find('.aiassist-translate-promt-image input').val( text ).attr('data-en', text);
						return;
					}
				
					let translate = await aiWriter.addTask( { action: 'translate', content: text } );
					
					$( e ).find('.aiassist-translate-promt-image input').val( translate.content ).attr('data-en', translate.content);
				
					return { act: header, val: translate.content };
				}));

				if( promts[0] )
					await aiWriter.request( { promts: promts, action: 'saveTranslateImagesPromts', nonce: aiassist.nonce } );
				
			}
			aiWriter.loader();
		},
		
		generateImage: async ( e ) => {
			
			let block = e.closest('.aiassist-header-item');
			let model = $('#aiassist-change-image-model').val();
			
			let imgBlock = $('<div class="aiassist-images '+ model +' aiassist-proces" />');
			block.append( imgBlock );
			let promt = block.find('.aiassist-translate-promt-image input').val();
			
			if( ! promt ){
				let header = $('.aiassist-main-header label input[type="checkbox"]').val();
				
				if( ! block.find('#aiassist-main').length )
					header = header +' '+ block.find('label input[type="checkbox"]').val();
				
				let translate = await aiWriter.addTask( { action: 'translate', content: header } );
				promt = translate.content;
				
				block.find('.aiassist-translate-promt-image input').val( promt );
				aiWriter.request( { val: promt, act: header, action: 'saveStep', nonce: aiassist.nonce } );
			}
			
			let task = await aiWriter.request( { token: aiassist.token, model: model, action: 'image_generator', header: promt, format: 'jpg' }, aiassist.api );
			
			if( task.limit < 1 )
				block.find('.aiassist-proces').removeClass('aiassist-proces').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span></span>');

			
			if( task.task_id ){
				let proccess = 0;
				
				while( true ){
					let data = await aiWriter.request( { token: aiassist.token, action: 'getTask', id: task.task_id }, aiassist.api );
					
					if( data.limit && $('#tokens-left').length )
						$('#tokens-left').text( aiWriter.number_format( data.limit ) );
					
					if( data.limit < 1 ){
						block.find('.aiassist-proces').removeClass('aiassist-proces').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span></span>');
						break;
					}
					
					if( data.imgs_limit ){
						let imgSpent = parseInt( $('#images-article-symbols').text() );
						
						if( isNaN( imgSpent ) )
							imgSpent = 0;
						
						imgSpent += data.imgs_limit;
						
						$('#images-article-symbols').text( imgSpent );
						aiWriter.setCookie( 'imgSpent', imgSpent );
					}
					
					if( data.process ){
						if( data.process.progress > proccess ){
							if( ! imgBlock.find('.aiassist-progressImageUrl').length )
								imgBlock.append('<img src="'+ data.process.progressImageUrl +'" class="aiassist-progressImageUrl" />');
							
							imgBlock.find('.aiassist-progressImageUrl').attr('src', data.process.progressImageUrl);
						}
						proccess = data.process.progress;
					}
					
					if( data.nsfw )
						return block.find('.aiassist-images').removeClass('aiassist-proces disabled').html('<span class="aiassist-warning-limits">'+ aiassist.locale['Prompt was censored'] +'</span>');
					
					if( data.images ){
						imgBlock.find('.aiassist-progressImageUrl').remove();
						block.find('.aiassist-image.active').removeClass('active');
						
						let active = true;
						for( let k in data.images ){
							if( active )		
								block.find('input[type="checkbox"]').attr('data-src', aiassist.api +'?action=getImage&image='+ data.images[ k ]);
						
							imgBlock.append('<img src="'+ aiassist.api +'?action=getImage&image='+ data.images[ k ] +'" class="aiassist-image '+( active ? 'active' : '' )+'" />');
							active = false;
						}
							
						imgBlock.removeClass('aiassist-proces');
						break;
					}
					await aiWriter.sleep( 10 );
				}
				
			}
			
		},
		
		checkAllHeaders: function(){
			let e = $(this);
			
			if( e.is(':checked') )
				$('.aiassist-header-item input').prop('checked', true);
			else
				$('.aiassist-header-item input').prop('checked', false);
		},
		
		statStep: async function( event ){
			let e = $(this);
			date = e.val().split('|');
			$('input[name="dateStart"]').val( date[0] );
			$('input[name="dateEnd"]').val( date[1] );
		},
		
		outSummFocus: async function( e ){
			$(this).removeAttr('placeholder');
		},
		
		outSummFocusOut: async function( e ){
			$(this).attr('placeholder', aiassist.locale['5 $'] );
		},
		
		buyForm: async function( e ){
			e.preventDefault();
		},
		
		recurringActivate: () => {
			$('.aiassist-rates-custom .aiassist-buy').click();
		},
		
		recurringPause: async function (){
			await aiWriter.request( { token: aiassist.token, action: 'recurringPause' }, aiassist.api );
			$('#aiassist-recurring-status').addClass('inactive').text( aiassist.locale['inactive'] );
			$('.aiassist-recurring-pause').toggleClass('aiassist-recurring-pause aiassist-recurring-activate').text( aiassist.locale['Activate'] );
		},
		
		buy: async function (){
			$(this).closest('div, form').addClass('disabled');
			
			let summ = $('#out_summ').val().trim();
			let buy = await aiWriter.request( { 'out_summ': summ, action: 'aiassist_buy', recurring: $(this).closest('.aiassist-buy-button').find('.aiassist-recurring-agree input[name="recurring"]:checked').length,  promocode: $('.aiassist-promocode input[name="promocode"]').val(), type: $(this).data('type'), billing: $('.pay-method.active').data('billing'), nonce: aiassist.nonce } );
			
			if( buy.error )
				alert( buy.error );
			
			if( buy.pay_url ){
				$('body').append('<a id="aiassistbuy" href="'+ buy.pay_url +'" target="_blank"></a>');

				setTimeout(() => {
					aiassistbuy.click();
					aiassistbuy.remove();
				}, 1)
			}
			$(this).closest('div, form').removeClass('disabled');
		},
		
		getStat: async function( event ){
			event.preventDefault();
		
			let e = $(this);
			let args = aiWriter.getFormData( e );
			let stats = await aiWriter.request( Object.assign( args, { action: 'aiassist_getStat', nonce: aiassist.nonce } ) );
			
			if( $('#tokens-stats').length )
				$('#area-chat').html('');
				$('#tokens-stats').remove();
			
			if( ! Object.keys( stats ).length ){
				e.after('<div id="tokens-stats"><h3>'+ aiassist.locale['No data found!'] +'</h3></div>');
				return;
			}
			
			e.after('<div id="tokens-stats"><h3>'+ aiassist.locale['Credits'] +': '+ aiWriter.number_format( stats.total ) +'</h3></div>');
			
			google.charts.load('current', {'packages':['corechart']});			
			google.charts.setOnLoadCallback( () => {
				args = [ [ 'Date', 'Symbols'] ];
				
				$('#tokens-stats').append('<div class="stat-item"><div><b>'+ aiassist.locale['Date'] +'</b></div><div><b>'+ aiassist.locale['Generations'] +'</b></div><div><b>'+ aiassist.locale['Regenerate images'] +'</b></div></div>');
				
				for( k in stats ){
					if( k == 'total' )
						continue;
					
					args.push( [ k, parseInt( stats[ k ].total ) ] );
					$('#tokens-stats').append('<div class="stat-item"><div>'+ k +'</div><div>'+ aiWriter.number_format( stats[ k ].generations ) +'</div><div>'+ aiWriter.number_format( stats[ k ].replace_images ) +'</div></div>');
				}
				
				data = google.visualization.arrayToDataTable( args );
				
				new google.visualization.LineChart( document.getElementById('area-chat') ).draw(
					data, 
					{
					  title: '',
					  hAxis: {title: ' ',  titleTextStyle: {color: '#333'}},
					  vAxis: {minValue: 0}
					});
			});
		
			return false;
		},
		
		sign: async function( event ){
			event.preventDefault();
			
			let e = $(this);
			let args = aiWriter.getFormData( e );
			
			let auth = await aiWriter.request( Object.assign( args, { act: 'signUp', action: 'aiassist_sign', nonce: aiassist.nonce } ) );
			
			if( auth.message )
				$('#wpai-errors-messages').html( auth.message );
			
			if( auth.auth ){
				e.find('button').addClass('disabled');
				$('input[name="email"]').attr('disabled', true).addClass('disabled');
				$('#wpai-errors-messages').addClass('success').text( aiassist.locale['Registration was successful, you have been sent an email with a key.'] );
				document.cookie = 'auth=true';
			}
			return false;
		},
		
		wsTabsInactive: function(){
			alert( aiassist.locale['To get started'] );
		},
		
		wsTabs: function(){
			let e = $(this);
			
			$('.aiassist-tab').removeClass('active');
			$('.aiassist-tab-data').removeClass('active');
			$('.aiassist-tab-data[data-tab="'+ e.data('tab') +'"]').addClass('active');
			aiWriter.setCookie('activeTab', e.data('tab'));
			
			e.addClass('active');
		},
		
		rateTabs: function(){
			let e = $(this);
			$('.aiassist-rates-tab, .aiassist-rates-view').removeClass('active');
			$('.aiassist-rates-view[data-view="'+ e.data('view') +'"]').addClass('active');
			$('.aiassist-rates-custom')[ ( $('.pay-method.active').data('custom-disabled') ? 'hide' : 'show' ) ]();
			e.addClass('active');
		},
		
		tabs: function(){
			let e = $(this);
			
			$('#wpai-errors-messages').text('');
			$('#aiassist-sign').attr('data-action', e.data('action'))
			$('input[name="license"]').attr('required', e.data('action') == 'signUp');
			$('.wpai-tab').removeClass('active');
			e.addClass('active');
		},

		stepStop: async () => {
			aiWriter.loader();
		},
		
		saveKey: async () => {
			await aiWriter.request( { key: $('#aiassist-gpt-key').val(), action: 'saveKey', nonce: aiassist.nonce } );
		},
		
		saveContent: async ( event ) => {
			if( event.originalEvent && event.originalEvent.detail === 0 ){
				event.preventDefault();
				return;
			}
			
			aiWriter.loader( true, aiassist.locale['Saving content'] );
			
			let post_id = null;
			
			if( $('#post_ID').length )
				post_id = $('#post_ID').val();
			
			if( ! post_id )
				post_id = wp.data.select('core/editor').getCurrentPostId();

			aiWriter.editor = tinymce.get('AIASSIST');
			let header = $('#aiassist-header').val();
			let content = aiWriter.editor.getContent();
			let title = $('#aiassist-title').val();
			let desc = $('#aiassist-desc').val();
			
			let imgs = [];
			let thumbnail = '';
			
			if( $('.aiassist-main-header .aiassist-image.active').length )
				thumbnail = $('.aiassist-main-header .aiassist-image.active').attr('src');
			
			if( $('.aiassist-images-generator input[type="checkbox"]:not(#aiassist-main, #aiassist-images-generator-all-headers):checked').length ){
				$('.aiassist-images-generator input[type="checkbox"]:not(#aiassist-main, #aiassist-images-generator-all-headers):checked').each(function(){
					let e = $(this);
					let block = e.closest('.aiassist-header-item');
					
					if( block.find('.aiassist-image.active').length ){
						block.find('.aiassist-image.active').each(function(){
							imgs.push( { title: e.val().trim(), src: $(this).attr('src') } )
						})
					}
				})
				
				for( let k in imgs ){
					aiWriter.loader( true, aiassist.locale['Loading image'] +' '+ imgs[ k ].title );
					
					let load = await aiWriter.request( { post_id: post_id, image: imgs[ k ], action: 'loadImage', nonce: aiassist.nonce } );
					
					if( load.image )
						content = content.replace(new RegExp(imgs[ k ].title +'[^<]*(<\/h[1-6]>)', 'gi'), imgs[ k ].title +'$1'+ load.image);	
				}
			}
			
			aiWriter.loader( true, aiassist.locale['Completion...']);
			
			let data = await aiWriter.request( { post_id: post_id, header: header, content: content, title: title, desc: desc, thumbnail: thumbnail, action: 'saveContent', nonce: aiassist.nonce } );
			
			if( data.id ){
				aiWriter.setCookie('spent', 0 );
				aiWriter.setCookie('imgSpent', 0 );
				window.location.href = '/wp-admin/post.php?post='+ parseInt( data.id ) +'&action=edit';
			}
				
			aiWriter.loader();
		},
		
		generateHeader: async ( event ) => {
			if( event.originalEvent && event.originalEvent.detail === 0 ){
				event.preventDefault();
				return;
			}
			
			aiWriter.loader( true, aiassist.locale['Header generation'] );
			
			let theme = $('#aiassist-theme').val();
			let prom = $('#aiassist-theme-prom').val();
			
			let data = await aiWriter.addTask( { action: 'generateHeader', theme: theme, prom: prom, lang_id: parseInt( $('.aiassist-lang-promts:visible:first').val() ) } );

			$('#step1, #step5').show();
			
			if( data.content ){
				$('#aiassist-header').val( data.content );
				aiWriter.request( { val: data.content, act: 'header', action: 'saveStep', nonce: aiassist.nonce } );
			} else
				aiWriter.errorLog('End limits!');
		
			aiWriter.loader();
		},
		
		generateStructure: async ( event ) => {
			if( event.originalEvent && event.originalEvent.detail === 0 ){
				event.preventDefault();
				return;
			}
			
			aiWriter.loader( true, aiassist.locale['Structure generation'] );
			
			let header = $('#aiassist-header').val();
			let prom = $('#aiassist-structure-prom').val();
			let keywords = $('#aiassist-long-keywords').val();
			
			if( keywords.length )
				prom += "\n"+ $('#aiassist-article-prom-long-keywords').val().replace('{keywords}', keywords);
			
			let data = await aiWriter.addTask( { action: 'generateStructure', header: header, prom: prom, lang_id: parseInt( $('.aiassist-lang-promts:visible:first').val() ) } );
		
			$('#step2').show();
			
			if( data.content ){
				$('#aiassist-structure').val( data.content ).removeClass('disabled');
				aiWriter.request( { val: data.content, act: 'structure', action: 'saveStep', nonce: aiassist.nonce } );
			} else
				aiWriter.errorLog('End limits!');
		
			aiWriter.loader();
		},
		
		standartGenerateContent: async ( event ) => {
			if( event.originalEvent && event.originalEvent.detail === 0 ){
				event.preventDefault();
				return;
			}
			
			let header = $('#aiassist-theme-standart').val();
			
			if( ! header ){
				$('#aiassist-theme-standart').addClass('aiassist-error');
				return false;
			}
			$('#aiassist-theme-standart').removeClass('aiassist-error');
		
			aiWriter.loader( true, aiassist.locale['Text generation'] );
			
			let promt = $('#aiassist-article-prom').val();
			let keywords = $('#aiassist-standart-keywords').val();
			let keywordsPromt = $('#aiassist-article-prom-keywords').val();
			
			let data = await aiWriter.addTask( { action: 'generateStandartContent', header: header, keywords: keywords, keywordsPromt: keywordsPromt, prom: promt, sPrompt: aiassist.sPrompt, lang_id: parseInt( $('.aiassist-lang-promts:visible:first').val() ) } );
			
			if( data.content ){
				$('#step3').show();
				$('.aiassist-headers .aiassist-header-item').remove();
				
				$('.aiassist-headers').append('<div class="aiassist-header-item aiassist-main-header"><div class="left">'+ aiassist.locale['Featured image'] +'</div><label><input type="checkbox" id="aiassist-main" value="'+( header )+'" /><span>'+( header )+'</span></label><div class="aiassist-translate-promt-image">'+ aiassist.locale['Promt:'] +' <input /> <div class="image-generate-item">'+ aiassist.locale['Generate'] +'</div></div></div>');	
				
				if( headers = data.content.match(/<h[2-6][^>]*>([^<]+)<\/h[2-6]>/gi) ){
					for(let i in headers ){
						headers[ i ] = headers[ i ].replace(/<\/?h[2-6][^>]*>/gi, '');
						$('.aiassist-headers').append('<div class="aiassist-header-item"><label><input type="checkbox" value="'+( headers[ i ] )+'" /><span>'+( headers[ i ] )+'</span></label><div class="aiassist-translate-promt-image">'+ aiassist.locale['Promt:'] +' <input /> <div class="image-generate-item">'+ aiassist.locale['Generate'] +'</div></div></div>');
					}
				}
				$('#step6').show();
				
				aiWriter.editor.setContent( data.content );
				aiWriter.request( { val: data.content, act: 'content', action: 'saveStep', nonce: aiassist.nonce } );
			} else {
				aiWriter.loader();
				aiWriter.errorLog('End limits!');
			}
			
			$('#step5').show();
			$('#aiassist-content').removeClass('disabled');
			aiWriter.translatePromtsToImages();
		},
		
		generateContent: async ( event ) => {
			if( event.originalEvent && event.originalEvent.detail === 0 ){
				event.preventDefault();
				return;
			}
			
			aiWriter.loader( true, aiassist.locale['Introduction generation'] );
			
			let header = $('#aiassist-header').val();
			let structure = $('#aiassist-structure').val();
			
			if( $('.aiassist-headers .aiassist-header-item').length )
				$('.aiassist-headers .aiassist-header-item').remove();
			
			aiWriter.request( { val: structure, act: 'structure', action: 'saveStep', nonce: aiassist.nonce } );
			
			structure = structure.split("\n");
			structure = structure.filter( e => e );

			if( structure.length ){
				$('#step3').show();
				
				let content = '';
				let prom = $('#aiassist-content-prom').val();
				$('.aiassist-headers').append('<div class="aiassist-header-item aiassist-main-header"><div class="left">'+ aiassist.locale['Featured image'] +'</div><label><input type="checkbox" id="aiassist-main" value="'+( header )+'" /><span>'+( header )+'</span></label><div class="aiassist-translate-promt-image">'+ aiassist.locale['Promt:'] +' <input value="" /> <div class="image-generate-item">'+ aiassist.locale['Generate'] +'</div></div></div>');
				
				let data = await aiWriter.addTask( { action: 'generatePreContent', header: header, lang_id: parseInt( $('.aiassist-lang-promts:visible:first').val() ) } );
				
				if( data.content )
					aiWriter.editor.setContent( data.content );
				
				for( let k in structure ){
					subHeader = structure[ k ].replace(/<[\/]?[^>]*>/g, '');
					
					if( $('.aiassist-headers').length )
						$('.aiassist-headers').append('<div class="aiassist-header-item"><label><input type="checkbox" value="'+( subHeader )+'" /><span>'+( subHeader )+'</span></label><div class="aiassist-translate-promt-image">'+ aiassist.locale['Promt:'] +' <input /> <div class="image-generate-item">'+ aiassist.locale['Generate'] +'</div></div></div>');
					
					$('#step6, #aiassist-loader').show();
					$('#aiassist-loader-info').text( aiassist.locale['Item generation:'] +' '+ subHeader);
					
					if( ! $('#aiassist-progress-generator').length )
						$('#aiassist-loader').after('<div id="aiassist-progress-generator"></div>');
					$('#aiassist-progress-generator').text( Math.round( ( parseInt( k ) / structure.length ) * 100 ) +'%');
					
					let data = await aiWriter.addTask( { action: 'generateContentItem', lang_id: parseInt( $('.aiassist-lang-promts:visible:first').val() ), header: header, item: subHeader, prom: prom, structure: structure, context: ( k > 0 ? aiWriter.editor.getContent() : null ) } );
					
					if( data.content ){
						let headItem = '<h2>'+ subHeader +'</h2>';
						
						if(  structure[ k ].match(/^<h/g) )
							headItem = structure[ k ];
						
						aiWriter.editor.setContent( aiWriter.editor.getContent() + headItem + data.content );
					} else
						aiWriter.errorLog('End limits!');
				}
				
				aiWriter.request( { val: aiWriter.editor.getContent(), act: 'content', action: 'saveStep', nonce: aiassist.nonce } );
				$('#aiassist-content').removeClass('disabled');
			}
			aiWriter.translatePromtsToImages();
		},
		
		generateMeta: async ( event ) => {
			if( event.originalEvent && event.originalEvent.detail === 0 ){
				event.preventDefault();
				return;
			}
			
			aiWriter.loader( true, aiassist.locale['Meta title generation'] );
			
			$('#step4').show();
			
			let header;
			if( $('.aiassist-tab[data-tab="standart"]').hasClass('active') )
				header = $('#aiassist-theme-standart').val();
			else
				header = $('#aiassist-header').val();
			
			let lang_id = parseInt( $('.aiassist-lang-promts:visible:first').val() );
			
			let data = await aiWriter.addTask( { action: 'generateTitle', prom: $('#aiassist-title-prom').val(), header: header, lang_id: lang_id } );
			
			if( data.content ){
				$('#aiassist-title').val( data.content );
				aiWriter.request( { val: data.content, act: 'title', action: 'saveStep', nonce: aiassist.nonce } );
			}
			
			$('#aiassist-loader-info').text( aiassist.locale['Meta description generation'] );
			
			data = await aiWriter.addTask( { action: 'generateDesc', prom: $('#aiassist-desc-prom').val(), header: header, lang_id: lang_id } );
			
			if( data.content ){
				$('#aiassist-desc').val( data.content );
				aiWriter.request( { val: data.content, act: 'desc', action: 'saveStep', nonce: aiassist.nonce } );
			}
			
			aiWriter.loader();
		},
		
		errorLog: ( error ) => {
			if( $('#aiasist #error').length )
				$('#aiasist #error').remove();
			
			$('#aiasist').prepend('<div id="error">'+ error +'</div>').delay(500).queue( next => { 
				$('#aiasist #error').addClass('active');
				next();
			})
		},
		
		loader: ( e = false, info = '' ) => {
			if( $('#aiassist-loader-wrap').length ){
				$('#aiasist').removeClass('disabled');
				$('#aiassist-loader-wrap').remove();
			}
			
			if( e ){
				$('#aiasist').addClass('disabled');
				$('#aiasist').after('<div id="aiassist-loader-wrap"><div id="aiassist-loader-info">'+ info +'</div><div id="aiassist-loader"></div><div id="aiassist-step-stop">'+ aiassist.locale['Cancel'] +'</div></div>');
			}
		},
		
		addTask: ( args ) => {
			aiWriter.limitMsg = false;
			
			if( ! aiassist.token ){
				aiWriter.loader();
				$('#aiasist').after('<div id="aiassist-loader-wrap"><div id="aiassist-loader-info"><span class="aiassist-warning-limits">'+ aiassist.locale['You have not added the API key'] +'</span></div><div id="aiassist-step-stop">'+ aiassist.locale['Cancel'] +'</div></div>');
				return;
			}
			
			return new Promise( async resolve => {
				try{
					while( true ){
						let task = await aiWriter.request( Object.assign( { token: aiassist.token, model: $('#aiassist-change-text-model-editor').val() }, args ), aiassist.api );
						
						if( task.limit !== undefined && $('#tokens-left').length ){
							$('#tokens-left').text( aiWriter.number_format( task.limit ) );
							
							if( task.limit < 1 && ! aiWriter.limitMsg ){
								aiWriter.limitMsg = true;
								aiWriter.loader( true, '<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span>' );
								$('#aiassist-loader').hide();
								await aiWriter.sleep( 30 );
								continue;
							}
							
						}
						
						if( task.task_id ){
							let data = await aiWriter.getTask( task.task_id );
							resolve( data );
							break;
						} else
							await aiWriter.sleep( 5 );
					}
				} catch {}
			})
		},
		
		getTask: ( task_id ) => {
			aiWriter.limitMsg = false;
			
			return new Promise( async resolve => {
				while( true ){
					try{
						data = await aiWriter.request( { token: aiassist.token, action: 'getTask', id: task_id }, aiassist.api );
						
						if( data.limit !== undefined && $('#tokens-left').length ){
							$('#tokens-left').text( aiWriter.number_format( data.limit ) );
							
							if( data.limit < 1 && ! aiWriter.limitMsg ){
								aiWriter.limitMsg = true;
								aiWriter.loader( true, '<span class="aiassist-warning-limits">'+ aiassist.locale['Limits are over'] +'</span></span>' );
								$('#aiassist-loader').hide();
								await aiWriter.sleep( 30 );
								continue;
							}
						}
						
						if( data.content ){
							if( data.symbols && $('#aiassist-article-symbols').length ){
								let spent = $('#aiassist-article-symbols').text();
								spent = spent.replace(/[^0-9]/, '');
								spent = parseInt( spent );
								
								if( isNaN( spent ) )
									spent = 0;
								
								spent = spent + parseInt( data.symbols );
								
								$('#aiassist-article-symbols').text( spent );
								aiWriter.setCookie( 'spent', spent );
							}
						
							resolve( data )
							break;
						}
					} catch {}
					
					await aiWriter.sleep(5);
				}
			})
		},
		
		buffer: ( data ) => {
			let temp = $('<textarea>');
			$('body').append( temp );
			temp.val( data ).select();
			document.execCommand('copy');
			temp.remove();
		},
		
		setCookie: ( key, value ) => {
			const expires = new Date();
			expires.setTime( expires.getTime() + (999 * 24 * 60 * 60 * 1000) );
			document.cookie = `${key}=${value};expires=${expires.toUTCString()};path=/`;
		},
		
		getCookie: ( key ) => {
			const cookies = document.cookie.split(';');
			
			for( const cookie of cookies ){
				const [ cookieName, cookieValue ] = cookie.split('=');
				
				if( cookieName.trim() === key )
					return cookieValue;
			}
			return null;
		},

		getFormData: ( e ) => {
			data = {};

			e.serializeArray().map(( e ) => {
				if( ( val = e.value.trim() ) )
					data[ e.name ] = val;
			});
			return data;
		},
		
		sleep: ( s ) => {
			return new Promise( resolve => setTimeout( () => resolve(true), s * 1000) );
		},
		
		ping: ( timeout = 1500 ) => {
			return new Promise( async resolve => {
				let ping = await aiWriter.request( { action: 'ping' }, aiassist.api, timeout );
				
				if( ping === true )
					aiassist.api = ( aiassist.api == aiassist.apiurl ) ? aiassist.apiurl2 : aiassist.apiurl;
				
				resolve( true );
			})
		},
		
		request: ( args = {}, url = false, timeout = 120000 ) => {
			return new Promise( async resolve => {
				let xhr = await aiWriter.xhr( args, url, timeout );
				
				if( xhr === true ){
					aiassist.api = ( aiassist.api == aiassist.apiurl ) ? aiassist.apiurl2 : aiassist.apiurl;
					xhr = await aiWriter.xhr( args, url, timeout );
				}
				
				resolve( xhr );
			} )
		},
		
		xhr: ( args = {}, url = false, timeout = 120000 ) => {
			return new Promise( resolve =>  $.ajax({ url: ( url || aiassist.ajaxurl ) +'?_='+ Date.now(), type: 'POST', data: args, timeout: timeout, dataType: 'json', cache: false, success: data => resolve( data ), error: error => resolve( true ) }) )
		}

	}

	aiWriter.init();
	
});