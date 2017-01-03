<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang = JFactory::getLanguage(); ?>
<nav aria-label="Page navigation">
<ul class="pagination">
<?php if ($row->prev) :
	$direction = $lang->isRtl() ? 'right' : 'left'; ?>
	<li class="page-item">
		<a class="page-link" href="<?php echo $row->prev; ?>" rel="prev">
			<?php echo '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i> ' . $row->prev_label; ?>
		</a>
	</li>
<?php endif; ?>
<?php if ($row->next) :
	$direction = $lang->isRtl() ? 'left' : 'right'; ?>
	<li class="page-item">
		<a class="page-link" href="<?php echo $row->next; ?>" rel="next">
			<?php echo $row->next_label . ' <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>'; ?>
		</a>
	</li>
<?php endif; ?>
</ul>
</nav>
