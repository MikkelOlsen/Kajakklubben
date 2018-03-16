ClassicEditor
                .create( document.querySelector( '.editor' ) )
                .catch( error => {
                } );

$( function() {
    $( '.datePicker' ).datepicker();
});


var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
			fileName = e.target.value.split( '\\' ).pop();

        if( fileName.length >= 40) {
            fileName = fileName.substring(0, 37) + "...";
        }

		if( fileName )
            
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});


$('.delLink').click(function(event){
	console.log('test');
	event.preventDefault();
	$.ajax({
		url: $(this).attr('href'),
		success: {
			alert: 'Success!'
		}
	});
});