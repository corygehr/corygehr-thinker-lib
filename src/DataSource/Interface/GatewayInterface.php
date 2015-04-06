<?php
	/**
	 * Gateway.php
	 * Contains the Thinker\DataSource\Interface\GatewayInterface interface
	 *
	 * @author Cory Gehr
	 */

namespace Thinker\DataSource\Interface;

interface GatewayInterface {

	/**
	 * persist()
	 * Commits data to the appropriate data source
	 *
	 * @access public
	 * @param Object $objToPersist Object that should be persisted
	 */
	public function persist(Object $objToPersist);
}
?>