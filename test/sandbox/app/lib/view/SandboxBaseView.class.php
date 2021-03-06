<?php

/**
 * The base view from which all project views inherit.
 */
class SandboxBaseView extends YoudsFrameworkView
{
	/**
	 * Handles output types that are not handled elsewhere in the view. The
	 * default behavior is to simply throw an exception.
	 *
	 * @param      YoudsFrameworkRequestDataHolder The request data associated with
	 *                                    this execution.
	 *
	 * @throws     YoudsFrameworkViewException if the output type is not handled.
	 */
	public final function execute(YoudsFrameworkRequestDataHolder $rd)
	{
		throw new YoudsFrameworkViewException(sprintf(
			'The view "%1$s" does not implement an "execute%3$s()" method to serve '.
			'the output type "%2$s", and the base view "%4$s" does not implement an '.
			'"execute%3$s()" method to handle this situation.',
			get_class($this),
			$this->container->getOutputType()->getName(),
			ucfirst(strtolower($this->container->getOutputType()->getName())),
			get_class()
		));
	}

	/**
	 * Prepares the HTML output type.
	 *
	 * @param      YoudsFrameworkRequestDataHolder The request data associated with
	 *                                    this execution.
	 * @param      string The layout to load.
	 */
	public function setupHtml(YoudsFrameworkRequestDataHolder $rd, $layoutName = null)
	{
		$this->loadLayout($layoutName);
	}
}

?>
