<?php
	/**
	 * APIAccessible.php
	 * Contains the 'APIAccessible' interface
	 *
	 * @author Cory Gehr <gehrc621@gmail.com>
	 */
	
namespace Thinker\Api;

interface APIAccessible {

	/** 
	 * delete()
	 * Used to remove an object of the type
	 * 
	 * @return mixed[] Returned Data
	 */
	public function delete();

	/** 
	 * get()
	 * Used to retrieve an object of the type
	 * 
	 * @return mixed[] Returned Data
	 */
	public function get();

	/** 
	 * post()
	 * Used to create an object of the type
	 * 
	 * @return mixed[] Returned Data
	 */
	public function post();

	/** 
	 * put()
	 * Used to update an object of the type
	 * 
	 * @return mixed[] Returned Data
	 */
	public function put();
}
?>