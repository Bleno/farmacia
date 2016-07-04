$(document).ready(function($) {
	initSample();
	var editor = CKEDITOR.instances.editor;//CKEDITOR.replace('editor');

	// The "change" event is fired whenever a change is made in the editor.
	editor.on( 'change', function( evt ) {
	    // getData() returns CKEditor's HTML content.
	    //console.log( 'Total bytes: ' + evt.editor.getData().length );
	    $("#descricao").val(evt.editor.getData());
	});	
});