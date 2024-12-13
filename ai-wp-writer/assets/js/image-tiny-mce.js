( ($) => {
	tinymce.create('tinymce.plugins.key2', {

		init: ( ed, url ) => {
			
			ed.addButton('ai_image', {
				title : aiassist.locale['The image is generated at the location of the cursor.'],
				text: 'AI image creator',
				icon: false,
				onclick: () => {
					
					$('#aiassist-generate-image').show();
					
				}
			});
			
		},
		
		createControl: (n, cm) => {
			return null;
		},
		
	});
	tinymce.PluginManager.add('button2', tinymce.plugins.key2);
} )( jQuery )