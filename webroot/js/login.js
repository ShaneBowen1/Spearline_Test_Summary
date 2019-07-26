$( document ).ready(function() {
    $( '#login-forgotpassword' ).click( function() {
        console.log("Click");
        $( '#login-footer' ).toggleClass( 'hiddenelem' );
        $( "#text-forgotpassword" ).toggleClass( 'hiddenelem' ); //because is not enaugh space in the box;
        $( "#text-forgotpassword_login" ).toggleClass( 'hiddenelem' ); //because is not enaugh space in the box;
        $( '.message' ).addClass( 'hiddenelem' ); //because is not enaugh space in the box;
        $( '#login-credentials' ).toggleClass( 'hiddenelem' ); //because is not enaugh space in the box;
    })
});
