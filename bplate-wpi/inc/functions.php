<?php

if ( !function_exists( '_' ) ) {

    function _( $str ) {
        echo $str;
    }
}

function sanit( $str ) {
    return addcslashes( str_replace( array( ';', "\n" ), '', $str ), '\\' );
}

/**
 * gettext
 *
 * GetText 
 * Needed to fix a gettext bug(?) where CLI echos to to stdout when it encounters _() instead of returning the text, and doesn't define gettext
 * @param string $content The shortcode content
 * @return string The parsed output of the form body tag
 */
if ( !function_exists( 'gettext' ) ) {

    function gettext( $text ){

        ob_start();
        _( $text );
  
        $text = ob_get_contents();
        ob_end_clean();
        

        return ($text);
    }

;
}

