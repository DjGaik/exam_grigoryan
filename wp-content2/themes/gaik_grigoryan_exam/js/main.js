// Masonry ready

docReady( function() {
	var container = document.querySelector('#container');
	var msnry = new Masonry( container, {
		columnWidth: 550,
		isInitLayout: false
	});
	msnry._isLayoutInited = true;
	msnry.layout();
	
	});