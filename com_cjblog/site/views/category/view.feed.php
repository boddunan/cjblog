<?php
/**
 * @package     CjBlog
 * @subpackage  com_cjblog
 *
 * @copyright   Copyright (C) 2009 - 2023 BulaSikku Technologies Pvt. Ltd. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die();

class CjBlogViewCategory extends JViewCategoryfeed
{

	protected $viewName = 'article';

	protected function reconcileNames ($item)
	{
		// Get description, author and date
		$app = JFactory::getApplication();
		$params = $app->getParams();
		$item->description = $params->get('feed_summary', 0) ? $item->introtext . $item->fulltext : $item->introtext;
		
		// Add readmore link to description if introtext is shown, show_readmore
		// is true and fulltext exists
		if (! $item->params->get('feed_summary', 0) && $item->params->get('feed_show_readmore', 0) && $item->fulltext)
		{
			$item->description .= '<p class="feed-readmore"><a target="_blank" href ="' . $item->link . '">' . JText::_('COM_CJBLOG_FEED_READMORE') .
					 '</a></p>';
		}
		
		$item->author = $item->created_by_alias ? $item->created_by_alias : $item->author;
	}
}
