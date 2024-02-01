<?php
/**
 *  @file      doxygen_test.php
 *  @brief     Brief description
 *  
 *  @details   Testing functions in doxygen.php
 *             Each function is called in this file
 *  @example   php doxygen_test.php -empty=1
 *  
 *  @copyright http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 *  @author    Erik Bachmann <ErikBachmann@ClicketyClick.dk>
 *  @since     2024-01-31T16:12:07 / erba
 *  @version   2024-02-01 11:58:08
 *  
 */
include('doxygen.php');

$options		= getopt( "e::", ["empty::"] );
$empty 			= $options['empty'] ?? $options['e'] ?? FALSE;	// If either --empty or -e are TRUE

$filename		= __FILE__;
$filename		= 'doxygen.php';	// Default is testing on this file
$file			= pathinfo( $filename, PATHINFO_FILENAME );
$function		= "getDoxygen";
$taglist_file	= ["file", "brief", "details", "todo", "bug", "warning", "see", "copyright", "author", "since", "version"];
$taglist_func	= ["fn", "brief", "details", "example", "todo", "bug", "warning", "see", "copyright", "author", "since"];

// Parse Doxygen in file
$doxygen	= getDoxygen( $filename, "\n\t" );

print "----\n";

// Print file header
printDoxygenHeader( $doxygen, $file, implode( '|', $taglist_file ), $empty );

if ( isset( $doxygen[$file]['function'] ) )
{
	// print functions
	foreach ( $doxygen[$file]['function'] as $function => $details)
	{
		print "----$function\n";
		printDoxygenFunction( $doxygen, $file, $function, implode( '|', $taglist_func ), $empty );
	}

	print "\nFunction list\n";
	foreach ( $doxygen[$file]['function'] as $function => $details)
	{
		print " * - ";
		printDoxygenFunctionOneliner( $doxygen, $file, $function, "Fn|Brief|since" );
	}
}

?>