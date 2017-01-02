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


<?php if ($row->prev) :
	$direction = $lang->isRtl() ? 'right' : 'left'; ?>
	<button class="btn btn-primary float-xs-left">
            <a class="top-menu-link" href="<?php echo $row->prev; ?>" rel="prev">
                <i class="fa fa-arrow-left" aria-hidden="true"></i><?php echo " ".$row->prev_label; ?>
            </a>
	</button>
<?php endif; ?>
<?php if ($row->next) :
	$direction = $lang->isRtl() ? 'left' : 'right'; ?>
	<button class="btn btn-primary float-xs-right">
            <a class="top-menu-link" class="top-menu-link" href="<?php echo $row->next; ?>" rel="next">
                <?php echo $row->next_label." " ?><i class="fa fa-arrow-right" aria-hidden="true"></i>
            </a>
	</button>
<?php endif; ?>
<div class="mb-1"></div>
