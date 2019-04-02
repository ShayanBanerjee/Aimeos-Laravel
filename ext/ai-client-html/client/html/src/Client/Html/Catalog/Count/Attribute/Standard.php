<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2014
 * @copyright Aimeos (aimeos.org), 2015-2018
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Catalog\Count\Attribute;


/**
 * Default implementation of catalog count attribute HTML client.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Catalog\Base
	implements \Aimeos\Client\Html\Common\Client\Factory\Iface
{
	/** client/html/catalog/count/attribute/standard/subparts
	 * List of HTML sub-clients rendered within the catalog count attribute section
	 *
	 * The output of the frontend is composed of the code generated by the HTML
	 * clients. Each HTML client can consist of serveral (or none) sub-clients
	 * that are responsible for rendering certain sub-parts of the output. The
	 * sub-clients can contain HTML clients themselves and therefore a
	 * hierarchical tree of HTML clients is composed. Each HTML client creates
	 * the output that is placed inside the container of its parent.
	 *
	 * At first, always the HTML code generated by the parent is printed, then
	 * the HTML code of its sub-clients. The order of the HTML sub-clients
	 * determines the order of the output of these sub-clients inside the parent
	 * container. If the configured list of clients is
	 *
	 *  array( "subclient1", "subclient2" )
	 *
	 * you can easily change the order of the output by reordering the subparts:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1", "subclient2" )
	 *
	 * You can also remove one or more parts if they shouldn't be rendered:
	 *
	 *  client/html/<clients>/subparts = array( "subclient1" )
	 *
	 * As the clients only generates structural HTML, the layout defined via CSS
	 * should support adding, removing or reordering content by a fluid like
	 * design.
	 *
	 * @param array List of sub-client names
	 * @since 2014.03
	 * @category Developer
	 */
	private $subPartPath = 'client/html/catalog/count/attribute/standard/subparts';
	private $subPartNames = [];


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( $uid = '', array &$tags = [], &$expire = null )
	{
		$view = $this->getView();

		$html = '';
		foreach( $this->getSubClients() as $subclient ) {
			$html .= $subclient->setView( $view )->getBody( $uid );
		}
		$view->attributeBody = $html;

		/** client/html/catalog/count/attribute/standard/template-body
		 * Relative path to the HTML body template of the catalog count attribute client.
		 *
		 * The template file contains the HTML code and processing instructions
		 * to generate the result shown in the body of the frontend. The
		 * configuration string is the path to the template file relative
		 * to the templates directory (usually in client/html/templates).
		 *
		 * You can overwrite the template file configuration in extensions and
		 * provide alternative templates. These alternative templates should be
		 * named like the default one but with the string "standard" replaced by
		 * an unique name. You may use the name of your project for this. If
		 * you've implemented an alternative client class as well, "standard"
		 * should be replaced by the name of the new class.
		 *
		 * @param string Relative path to the template creating code for the HTML page body
		 * @since 2014.03
		 * @category Developer
		 * @see client/html/catalog/count/attribute/standard/template-header
		 */
		$tplconf = 'client/html/catalog/count/attribute/standard/template-body';
		$default = 'catalog/count/attribute-body-standard.php';

		return $view->render( $view->config( $tplconf, $default ) );
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( $type, $name = null )
	{
		/** client/html/catalog/count/attribute/decorators/excludes
		 * Excludes decorators added by the "common" option from the catalog count attribute html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "client/html/common/decorators/default" before they are wrapped
		 * around the html client.
		 *
		 *  client/html/catalog/count/attribute/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/count/attribute/decorators/global
		 * @see client/html/catalog/count/attribute/decorators/local
		 */

		/** client/html/catalog/count/attribute/decorators/global
		 * Adds a list of globally available decorators only to the catalog count attribute html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/catalog/count/attribute/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/count/attribute/decorators/excludes
		 * @see client/html/catalog/count/attribute/decorators/local
		 */

		/** client/html/catalog/count/attribute/decorators/local
		 * Adds a list of local decorators only to the catalog count attribute html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Catalog\Decorator\*") around the html client.
		 *
		 *  client/html/catalog/count/attribute/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Catalog\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2015.08
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/catalog/count/attribute/decorators/excludes
		 * @see client/html/catalog/count/attribute/decorators/global
		 */

		return $this->createSubClient( 'catalog/count/attribute/' . $type, $name );
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames()
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}


	/**
	 * Sets the necessary parameter values in the view.
	 *
	 * @param \Aimeos\MW\View\Iface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return \Aimeos\MW\View\Iface Modified view object
	 */
	public function addData( \Aimeos\MW\View\Iface $view, array &$tags = [], &$expire = null )
	{
		$context = $this->getContext();
		$config = $context->getConfig();

		/** client/html/catalog/count/attribute/aggregate
		 * Enables or disables generating product counts for the attribute catalog filter
		 *
		 * This configuration option allows shop owners to enable or disable product counts
		 * for the attribute section of the catalog filter HTML client.
		 *
		 * @param boolean Disabled if "0", enabled if "1"
		 * @since 2014.03
		 * @see client/html/catalog/count/limit
		 * @category Developer
		 * @category User
		 */
		if( $config->get( 'client/html/catalog/count/attribute/aggregate', true ) == true )
		{
			$filter = $this->getProductListFilter( $view, true, true, false, true );
			$filter = $this->addAttributeFilter( $view, $filter, false );

			/** client/html/catalog/count/limit
			 * Limits the number of records that are used for product counts in the catalog filter
			 *
			 * The product counts in the catalog filter are generated by searching for all
			 * products that match the criteria and then counting the number of products
			 * that are available for each attribute or category.
			 *
			 * As counting huge amount of records (several 10 000 records) takes a long time,
			 * the limit can cut down response times so the counts are available more quickly
			 * in the front-end and the server load is reduced.
			 *
			 * Using a low limit can lead to incorrect numbers if the amount of found products
			 * is very high. Approximate product counts are normally not a problem but it can
			 * lead to the situation that visitors see that no products are available for
			 * an attribute or in a category despite the fact that there would be at least
			 * one.
			 *
			 * @param integer Number of records
			 * @since 2014.03
			 * @see client/html/catalog/count/attribute/aggregate
			 * @category Developer
			 * @category User
			 */
			$filter->setSlice( 0, $config->get( 'client/html/catalog/count/limit', 10000 ) );
			$filter->setSortations( [] ); // it's not necessary and slows down the query

			$controller = \Aimeos\Controller\Frontend\Factory::createController( $context, 'product' );
			$view->attributeCountList = $controller->aggregate( $filter, 'index.attribute.id' );
		}

		return parent::addData( $view, $tags, $expire );
	}
}