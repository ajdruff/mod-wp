<?php

/**
 * Bluedog PHP Lib
 *
 * Common PHP Utilities
 *
 * @author Andrew Druffner <andrew@nomstock.com>
 * @copyright  Nomstock, LLC                                   
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, 
 * @package PHPLib
 * @filesource
 */
class bluedog_phplib {

    /**
     * Remove Directory Maybe (or if given a file , deletes it)
     *
     * Removes Directory and all its contents with exceptions
     * ref: http://stackoverflow.com/a/24563703/3306354
     * 
     * @param string $dir The full path to the directory to delete
     * @param array $exceptions The name of the directory or file to be skipped for deletion. Exceptions are non-recursive, meaning they must reside in the root directory (dir/exception_name not dir/dir/exception_name)
     * @param boolean $delete_if_empty True to delete the directory itself if empty (default).
     * 
     * 
     * @return void
     */
    public function rmDirMaybe( $dir, $exceptions = array(), $delete_if_empty = true ) {
        if ( !file_exists( $dir ) ) {
            return false;
        }
        $result = false;

        //if given a file instead of a directory, deletes it if not an exception and returns the result
        if ( !is_dir( $dir ) ) {
            if ( in_array( basename( $dir ), $exceptions ) ) {
                return true; //given a file, but the file was in the exceptions array, so no action needed
            } else {
                return( unlink( $dir ));
            }
        }

        //scandir returns all the folder and file names in the directory (non-recursive), 
        $fileNames = scandir( $dir );

        if ( !is_array( $fileNames ) ) { $fileNames = array(); } //ensure its an array if nothing is returned
        // We remove the "." and ".." corresponding to the current and parent folder
        $fileNames = array_diff( $fileNames, array( '.', '..' ) );



        foreach ( $fileNames as $file ) {
            if ( in_array( $file, $exceptions ) ) {
                continue;
            }
            if ( is_dir( $dir . "/$file" ) ) {
                $this->rmDir( $dir . "/$file" );
            } else {
                unlink( $dir . "/$file" );
            }
        }



        if ( $delete_if_empty ) { @rmdir( $dir ); }

        return $result;
    }

    /**
     * Removes a Directory and All Its Contents or if given a file, deletes it.
     *
     * Removes Directory and all its contents
     * ref: http://stackoverflow.com/a/24563703/3306354
     * 
     * @param string $dir The full path to the directory or file to delete
     * 
     * @return void
     */
    public function rmDir( $dir ) {
        if ( !file_exists( $dir ) ) {
            return true;
        }
        $result = false;

        //if given a file instead of a directory, deletes it and returns true
        if ( !is_dir( $dir ) ) {
            return( unlink( $dir ));
        }
        $di = new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS );
        $ri = new RecursiveIteratorIterator( $di, RecursiveIteratorIterator::CHILD_FIRST );
        foreach ( $ri as $fileSystemObject ) {






            if ( $fileSystemObject->isDir() ) {

                $result = rmdir( $fileSystemObject );
            } else {
                $result = unlink( $fileSystemObject );
            }
        }

        $result = rmdir( $dir ); //now that the directory contents are deleted, remove the directory itself.

        return $result;
    }

    /**
     * Delete a file
     *
     * Removes a file without throwing an error if it doesn't exist.
     * 
     * 
     * @param string $path The full path to the file
     * 
     * @return boolean True if file is deleted or doesnt exist. False if an exception is raised.
     */
    public function rmFile( $path ) {
        $path = realpath( $path );
        $result = false;
        try {
            if ( file_exists( $path ) ) {
                unlink( $path );
                $result = true;
            }
        } catch ( Exception $exc ) {
            $result = false;
        }

        return $result;
    }

    /**
     * Check if Ajax Request
     *
     * Checks to see if the http request was made via ajax.
     *
     * @param none
     * @return boolean True if ajax, false if not.
     */
    public function isAjax() {
        return(isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && !empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest');
    }

    /**
     * Short Description
     *
     * Long Description
     *
     * @param none
     * @return void
     */
    public function convertToBool( $mixed ) {

        $boolean_strings = array( '1', '0', 'on', 'off', 'true', 'false', 'yes', 'no' );
        if ( !is_array( $mixed ) ) {

            return filter_var( $mixed, FILTER_VALIDATE_BOOLEAN );
        } else {

            foreach ( $mixed as $key => $value ) {
                if ( is_array( $value ) ) {
                    $mixed[ $key ] = $this->convertToBool( $value );
                } else {
                    if ( in_array( trim( ( string ) $mixed[ $key ] ), $boolean_strings ) ) {
                        $mixed[ $key ] = filter_var( $mixed[ $key ], FILTER_VALIDATE_BOOLEAN );
                    }
                }
            }
        }
        return $mixed;
    }

    /**
     * Recursive Array Merge
     *
     * Merges a multidimensional array
     * see http://stackoverflow.com/a/25712428/3306354
     * @param array $array1 The first array to be merged
     * @param array $array2 The second array to be merged
     * 
     * @return void
     */
    function arrayMerge( array & $array1, array & $array2 ) {
        $merged = $array1;

        foreach ( $array2 as $key => & $value ) {
            if ( is_array( $value ) && isset( $merged[ $key ] ) && is_array( $merged[ $key ] ) ) {
                $merged[ $key ] = $this->arrayMerge( $merged[ $key ], $value );
            } else if ( is_numeric( $key ) ) {
                if ( !in_array( $value, $merged ) )
                    $merged[] = $value;
            } else
                $merged[ $key ] = $value;
        }

        return $merged;
    }

    /**
     * Change File and Directory Permissions
     *
     * Change the permissions of all files and directories recursively
     *
     * @param $file_perm - File permissions, e.g.: 0600
     * @param $file_perm - Directory permissions, e.g: 0755
     * @return void
     */
    public function chmod_old( $path, $file_perm, $dir_perm ) {


        try {
            $dir = new DirectoryIterator( $path );
            foreach ( $dir as $item ) {
                if ( $item->isDir() && !$item->isDot() ) {
                    chmod( $item->getPathname(), $dir_perm ); //set the directory permission
                 //   $this->chmod( $item->getPathname(), $file_perm, $dir_perm ); //iterate into the directory
                } else if ( !$item->isDir() && !$item->isDot() ) {
                    chmod( $item->getPathname(), $file_perm );
                }
            }
        } catch ( Exception $exc ) {
            echo $exc->getTraceAsString();
        }
    }
    /**
     * Change File and Directory Permissions
     *
     * Change the permissions of all files and directories recursively
     *
     * @param $file_perm - File permissions, e.g.: 0600
     * @param $file_perm - Directory permissions, e.g: 0755
     * @return void
     */
    
    public function chmodR($path, $filemode, $dirmode) {
    if (is_dir($path) ) {
        if (!chmod($path, $dirmode)) {
            $dirmode_str=decoct($dirmode);
            print "Failed applying filemode '$dirmode_str' on directory '$path'\n";
            print "  `-> the directory '$path' will be skipped from recursive chmod\n";
            return;
        }
        $dh = opendir($path);
        while (($file = readdir($dh)) !== false) {
            if($file != '.' && $file != '..') {  // skip self and parent pointing directories
                $fullpath = $path.'/'.$file;
                $this->chmodR($fullpath, $filemode,$dirmode);
            }
        }
        closedir($dh);
    } else {
        if (is_link($path)) {
            print "link '$path' is skipped\n";
            return;
        }
        if (!chmod($path, $filemode)) {
            $filemode_str=decoct($filemode);
            print "Failed applying filemode '$filemode_str' on file '$path'\n";
            return;
        }
    }
} 

}

?>