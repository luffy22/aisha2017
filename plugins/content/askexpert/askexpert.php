<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Pagenavigation plugin class.
 *
 * @since  1.5
 */
class PlgContentAskExpert extends JPlugin
{
	function onContentAfterDisplay($context, &$article, &$params, $limitstart)
	{
            $info       = $this->getExpertInfo();
            return $info;
	}
	public function getExpertInfo()
	{
            return "<h3>Ask An Expert</h3>";
	}
}
