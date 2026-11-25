jQuery( document ).ready(function($){
	
	const aiWriterBlock = {
		
		init: () => {
			
			aiWriterBlock.events();
			
		},
		
		events: () => {
			
			$(document).on('click', '.wp-block .aiassist-lock', aiWriterBlock.lockEvent);
			$(document).on('mouseenter', '.wp-block .aiassist-lock', aiWriterBlock.showInfo);
			$(document).on('mouseleave', '.wp-block .aiassist-lock', aiWriterBlock.hideInfo);	
			$(document).on('click', '.wp-block .ai-image', aiWriterBlock.selectImageInBlock);
			$(document).on('click', '.wp-block .aiassist-select-lable', aiWriterBlock.openSelect);
			$(document).on('click', '.wp-block .aiassist-option:not(.aiassist-lock)', aiWriterBlock.changeSelect);
			
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
		
	}
	
	aiWriterBlock.init();
	
})