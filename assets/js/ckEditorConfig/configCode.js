// ckEditor Toobar Configurator
// https://ckeditor.com/latest/samples/toolbarconfigurator/index.html#basic
CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] },
		{ name: 'Featured Snippet', type: 'widget', widget: 'codeSnippet', attributes: { 'class': 'code-featured' } },

	];

	config.uiColor = '#403547';
	config.removeButtons = 'Source,Save,NewPage,Preview,ExportPdf,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Redo,Undo,Find,Replace,SelectAll,Scayt,Checkbox,Radio,Form,TextField,Textarea,Select,Button,ImageButton,HiddenField,Bold,Italic,Strike,Underline,Subscript,Superscript,CopyFormatting,RemoveFormat,BulletedList,NumberedList,Outdent,Indent,CreateDiv,JustifyLeft,Blockquote,JustifyCenter,JustifyRight,JustifyBlock,Anchor,Language,BidiRtl,BidiLtr,Link,Image,Flash,Unlink,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,FontSize,TextColor,BGColor,ShowBlocks,Maximize,About';
	config.extraPlugins = 'codesnippet';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
};