<?php
/**
 *  @file      doxygen.php
 *  @brief     Handle Doxygen headers
 *  
 *  @details   Function list
 * - printDoxygenHeader             - Print one or more tags from Doxygen header
 * - printDoxygenFunction           - Print Doxygen function headers
 * - getDoxygenFunction             - Get value from Doxygen function tag
 * - getDoxygenFile                 - Get value from Doxygen header tag
 * - getDoxygen                     - Parsing a file to extract Doxygen headers
 * - trimtok                        - Trim string to first word
 *
 *	@examples	See `doxygen_test.php` for examples  
 *  @copyright http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 *  @author    Erik Bachmann <ErikBachmann@ClicketyClick.dk>
 *  @since     2024-02-01T10:08:29 / erba
 *  @version   2024-02-01 12:34:54
 */

/**
 *  @fn         printDoxygenHeader
 *  @brief      Print one or more tags from Doxygen header
 *  
 *  @param [in] $doxygen   Doxygen structure
 *  @param [in] $file      File to extract from
 *  @param [in] $tags      Tag list (separated by '|')
 *  @param [in] $doxywidth Default width for tag
 *  @param [in] $doxyprec  Default presicion for tag
 *  @return     Return description
 *  
 *  @details    More details
 *  
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://
 *  @since      2024-02-01T10:20:33 / erba
 */
function printDoxygenHeader( &$doxygen, $file, $tags, $empty = FALSE, $doxywidth = 10 , $doxyprec = 10 )
{
	foreach( explode( '|', $tags) as $tag )
	{
		$value	= getDoxygenFile( $doxygen, $file, strtolower( $tag ));
		if ( ! empty( $value ) || $empty )
		printf( "%-*.*s: [%s]\n"
		,	$doxywidth
		,	$doxyprec
		,	$tag
		,	getDoxygenFile( $doxygen, $file, strtolower( $tag ))
		);
	}
}	// printDoxygenHeader()

/**
 *  @fn         printDoxygenFunction
 *  @brief      Print Doxygen function headers
 *  
 *  @param [in] $doxygen   Doxygen structure
 *  @param [in] $file      File to extract from
 *  @param [in] $function  Function name
 *  @param [in] $tags      Tag list (separated by '|')
 *  @param [in] $doxywidth Default width for tag
 *  @param [in] $doxyprec  Default presicion for tag

 *  @return     Return description
 *  
 *  @details    More details
 *  
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://
 *  @since      2024-02-01T10:22:38 / erba
 */
function printDoxygenFunction( &$doxygen, $file, $function, $tags, $empty = FALSE, $doxywidth = 10 , $doxyprec = 10 )
{
	foreach( explode( '|', $tags) as $tag )
	{
		$value	= getDoxygenFunction( $doxygen, $file, $function, strtolower( $tag ) );
		
		if ( ! empty( $value ) || $empty )
			printf( "%-*.*s: [%s]\n"
			,	$doxywidth
			,	$doxyprec
			,	$tag
			,	$value
			);
	}
}	// printDoxygenFunction

/**
 *  @fn         printDoxygenFunction
 *  @brief      Print Doxygen function headers
 *  
 *  @param [in] $doxygen   Doxygen structure
 *  @param [in] $file      File to extract from
 *  @param [in] $function  Function name
 *  @param [in] $tags      Tag list for function + brief (separated by '|')
 *  @param [in] $doxywidth Default width for tag
 *  @param [in] $doxyprec  Default presicion for tag

 *  @return     Return description
 *  
 *  @details    More details
 *  
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://
 *  @since      2024-02-01T10:22:38 / erba
 */
function printDoxygenFunctionOneliner( &$doxygen, $file, $function, $tags, $wrap = " ; ", $doxywidth = 20 , $doxyprec = 20 )
{
	$tags	= explode( '|', $tags);
	$func	= array_shift( $tags );	// First is function name
	$desc	= [];
	foreach( $tags as $tag )
	{
		array_push( $desc, getDoxygenFunction( $doxygen, $file, $function, strtolower( $tag ) ) );
	}

	printf( "%-*.*s - %s\n"
	,	$doxywidth
	,	$doxyprec
	,	$function
	,	implode( $wrap, $desc )
	);
}	// printDoxygenFunction

/**
 *  @fn         getDoxygenFunction
 *  @brief      Get value from Doxygen function tag
 *  
 *  @param [in] $doxygen   Doxygen structure
 *  @param [in] $file      File to extract from
 *  @param [in] $function  Function name
 *  @param [in] $tag       Tag to get
 *  @return     Return description
 *  
 *  @details    More details
 *  
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://
 *  @since      2024-02-01T10:24:12 / erba
 */
function getDoxygenFunction( &$doxygen, $file, $function, $tag )
{
	return( $doxygen[$file]['function'][$function][$tag][0][0] ?? "" );
}	// getDoxygenFunction()


/**
 *  @fn         getDoxygenFile
 *  @brief      Get value from Doxygen header tag
 *  
 *  @param [in] $doxygen   Doxygen structure
 *  @param [in] $file      File to extract from
 *  @param [in] $tag       Tag to get
 *  @return     Return description
 *  
 *  @details    More details
 *  
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://
 *  @since      2024-02-01T10:25:41 / erba
 */
function getDoxygenFile( &$doxygen, $file, $tag )
{
	return( $doxygen[$file]['header'][$tag][0][0] ?? "" );
}	// getDoxygenFile()


/**
 *  @fn         getDoxygen
 *  @brief      Parsing a file to extract Doxygen headers
 *  
 *  @param [in] $filename File to process
 *  @return     Doxygen structure
 *  
 *  @details    More details
 *              Even more details
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://
 *  @since      2024-01-31T16:12:17 / erba
 */
function getDoxygen( $filename, $wrap = "\n\t\t" )
{
	$doxygen= [];
	//$tags	= ['file','fn','brief', 'details', 'example', 'todo', 'bug', 'warning', 'see', 'since', 'version'];
	$tags	= ["file", "fn", "brief", "details", "example", "todo", "bug", "warning", "see", "copyright", "author", "since", "version"];
	$file	= pathinfo( $filename, PATHINFO_FILENAME );
	
	// Read the file content
	$fileContent = file_get_contents($filename);

	// Regular expression for Doxygen comments
	$commentPattern = '/\/\*\*.*?\*\//s';

	// Find all comment blocks
	preg_match_all($commentPattern, $fileContent, $comments);

	foreach ($comments[0] as $comment) {
		// Check for file header (look for \file tag)
		if (strpos($comment, '@file') !== false) {
			if (preg_match_all('/@('.implode('|', $tags).')\s+(.*?)(?=@[a-z]|$)/s', $comment, $matches, PREG_SET_ORDER)) {
				foreach ($matches as $match) {
					if ( ! isset( $doxygen[$file]['header'][ $match[1] ]) )
						$doxygen[$file]['header'][ $match[1] ]	= [];
					
					$match[2]	= preg_replace( "/[\n\r]+\s*\*\s+/", $wrap, $match[2]);	// Trim prefix
					$match[2]	= trim( $match[2], "* \/\n");	// Trim suffix
					// Push to array
					array_push( $doxygen[$file]['header'][ $match[1] ], [ trim($match[2])] );
				}
			}
			
		}
		// Check for function header (look for \brief tag and proximity to a function)
		elseif (strpos($comment, '@brief') !== false) 
		{
			// Regular expression to find specific Doxygen tags and their contents
			if (preg_match_all('/@('.implode('|', $tags).')\s+(.*?)(?=@[a-z]|$)/s', $comment, $matches, PREG_SET_ORDER)) {
				preg_match_all('/@(fn)\s+(.*?)(?=@[a-z]|$)/s', $comment, $fn_matches, PREG_SET_ORDER);
				if ( isset( $fn_matches[0][2] ) )
					$func	= trimtok( $fn_matches[0][2] );
				
				foreach ($matches as $match) {
					if ( ! isset( $doxygen[$file]['function'][$func][$match[1]] ) )
						$doxygen[$file]['function'][$func][ $match[1]]	= [];
					
					$match[2]	= preg_replace( "/[\n\r]+\s*\*\s+/", $wrap, $match[2]);	// Trim prefix
					$match[2]	= trim( $match[2], "* \/\n");	// Trim suffix
					// Push to array
					array_push( $doxygen[$file]['function'][$func][ $match[1]], [ trim( $match[2] )] );
				}
			}
		}
	}
	return( $doxygen );
}	// getDoxygen()

//---------------------------------------------------------------------

/**
 *  @fn         trimtok
 *  @brief      Trim string to first word
 *  
 *  @param [in] $str Description for $str
 *  @return     First word
 *  
 *  @details    More details
 *  
 *  @example   
 *  
 *  @todo      
 *  @bug       
 *  @warning   
 *  
 *  @see        https://stackoverflow.com/a/2477411 - How to get the first word of a sentence in PHP?
 *  @since      2024-02-01T08:55:45 / erba
 */
function trimtok( $str )
{
	return( trim(strtok( trim( $str) , "\n") ));
}	// trimtok()

//---------------------------------------------------------------------

?>