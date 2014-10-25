<?php
	/**
	 * Controller.php 
	 * Contains the Thinker\Controller class
	 *
	 * @author Cory Gehr
	 */
	 
namespace Thinker;

abstract class Controller
{
	protected $reflectionClass; // Contains information about the class (ReflectionClass)
	protected $data;            // Contains the data being passed back from the Section
	public $session;         // Contains session object
	public $view;      // Contains the view being loaded for the section
	private $defaultSubsection;
	
	/**
	 * __construct()
	 * Constructor for the Thinker\Controller Class
	 *
	 * @author Cory Gehr
	 * @access public
	 */
	public function __construct()
	{
		// Initialize classInfo with information about the target class
		$this->reflectionClass = new ReflectionClass($this);
		$this->data = array();

		// Override view if necessary
		if(isset($_GET['view']))
		{
			$this->view = getPageVar('view', 'str', 'GET', true);
		}
		else
		{
			$this->view = DEFAULT_VIEW;
		}

		// Get the session information, if available
		if(SESSION_CLASS)
		{
			$sessionClass = SESSION_CLASS;
			
			$this->session = \Session\$sessionClass::singleton();

			if(!$this->session->auth('section', array('section' => SECTION, 'subsection' => SUBSECTION)))
			{
				// Redirect to error
				errorRedirect(403);
			}
		}
		else
		{
			// No Session
			$this->session = \Session\Open::singleton();
		}
	}

	/**
	 * __get()
	 * Gets a value from this object
	 *
	 * @access public
	 * @param string $name Name of the Variable
	 * @return mixed Variable Value, or NULL on non-existence
	 */
	public function __get($name)
	{
		if(isset($this->$name))
		{
			return $this->$name;
		}
		else
		{
			return null;
		}
	}

	/**
	 * __set()
	 * Sets a value on this object
	 *
	 * @access public
	 * @param string $name Name of the Variable
	 * @param mixed $value Variable Value
	 * @return mixed Passed Value
	 */
	public function __set($name, $value)
	{
		$this->$name = $value;

		return $value;
	}

	/**
	 * defaultSubsection()
	 * Returns the name of the default subsection for this controller
	 *
	 * @access public
	 * @static
	 * @return string Subsection Name
	 */
	public static function defaultSubsection()
	{
		return $this->defaultSubsection;
	}

	/**
	 * getAllVals()
	 * Passes back the data array from this section
	 *
	 * @access public
	 * @return array Data from Section
	 */
	public function getAllVals()
	{
		return $this->data;
	}

	/**
	 * getVal()
	 * Gets a value in the local data array
	 *
	 * @access public
	 * @param string $key Array Key
	 * @return mixed Key Value, or NULL if it doesn't exist
	 */
	public function setVal($key, $value)
	{
		if(isset($this->data[$key]))
		{
			return $this->data[$key];
		}
		else
		{
			return null;
		}
	}

	/**
	 * setVal()
	 * Sets a value in the local data array
	 *
	 * @access public
	 * @param string $key Array Key
	 * @param mixed $value Value
	 * @return mixed Passed Value
	 */
	public function setVal($key, $value)
	{
		$this->data[$key] = $value;
		return $value;
	}

	/**
	 * toArray()
	 * Returns an object's variables as an associative array
	 * 
	 * @author Joe Stump <joe@joestump.net>
	 * @access public
	 * @return array Variables Array (VarName => Value)
	 */
	public function toArray()
	{
		$defaults = $this->reflectionClass->getDefaultProperties();
		$return = array();
		
		foreach($defaults as $var => $val)
		{
			if($this->$var instanceof Object)
			{
				$return[$var] = $this->$var->toArray();
			}
			else
			{
				$return[$var] = $this->$var;
			}
		}
		
		return $return;
	}
}