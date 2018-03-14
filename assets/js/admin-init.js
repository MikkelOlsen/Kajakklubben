ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );

$( function() {
    $( '.datePicker' ).datepicker();
});