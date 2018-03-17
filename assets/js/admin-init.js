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

document.querySelectorAll('.delLink').forEach( (elm) => {
	elm.addEventListener('click', (e) => {
		e.preventDefault();
		const baseURL = document.getElementById('baseURL').getAttribute('href');

		fetch(baseURL + 'Api/Gallery/Delete/' + elm.getAttribute('href'), {method: 'GET', body: undefined})
			.then( (res) => {
				return res.json()
			})
			.then( (data) => {
				if(!data.err)
				{
					elm.parentElement.remove()
				}
			})
			.catch( (err) => {
				console.warn('Fejl i fetch! -> ', err)
			})
	});
});
