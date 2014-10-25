<?php
	/**
	 * View.php
	 * Contains the Thinker\View Class that all Views will inherit
	 * Uses the Factory Design Pattern to generate the view
	 * 
	 * @author Cory Gehr
	 */

namespace Thinker;

class View
{
	/**
	 * factory()
	 * Draws the presentation layer for a section
	 *
	 * @author Cory Gehr
	 * @access public
	 * @static
	 * @param string $view Name of view we want to use
	 * @param Controller $section Section being displayed
	 * @return View of Section, or Error on Failure
	 */
	public static function factory($view, Controller $section)
	{
		// Ensure specified view exists
		if(class_exists(\View\$view))
		{
			// Create the view with the section as its parameter
			try
			{
				return new \View\$view($section);
			}
			catch(Exception $ex)
			{
				trigger_error("Could not load View '$view'.");
			}
		}
		else
		{
			// Throw an exception
			throw new Exception("Specified View does not exist.");
		}
		
	}
}
	 
?>