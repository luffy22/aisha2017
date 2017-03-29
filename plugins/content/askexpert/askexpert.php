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
            $info       = $this->getExpertInfo($context, $article, $params);
            return $info;
	}
	public function getExpertInfo($context, $article, $params)
	{
            $app                = JFactory::getApplication();
            $view               = $app->input->get('view');
            $path               = JPluginHelper::getLayoutPath('content', 'askexpert');
            if(($context === 'com_content.article')&&($view=='article'))
            {
                $text           = $article->introtext;
                $user           = $article->created_by;
                
                $db             = JFactory::getDbo();
                $query          = $db->getQuery(true);
                
                $query          ->select($db->quoteName(array('a.id','a.name','a.username','b.img_name','b.img_new_name',
                                                               'c.membership','c.info','c.profile_status')));
                $query          ->from($db->quoteName('#__users','a'));
                $query          ->join('RIGHT', $db->quoteName('#__user_img','b'). ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('b.user_id') . ')');
                $query          ->join('RIGHT', $db->quoteName('#__user_astrologer','c'). ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('c.UserId') . ')');
                $query          ->where($db->quoteName('a.id').' = '.$db->quote($user));
                $db             ->setQuery($query);
                $db->execute();
                $result         = $db->loadObject();
                $content        = "<div class='card card-outline-info mb-3 text-center'>";
                $content        .= "<div class='card-block'>";
                $content        .= "<h3><a href='".JUri::base()."astro/".$result->username."'><img src='".JURi::base()."images/profiles/".$result->img_new_name."' height='50px' width='50px' title='".$result->img_name."' />".$result->name."</a></h3>";
                if(strlen($result->info)>500)
                {
                    $shortinfo      = substr($result->info,0,500);
                    $content        .= "<p>About Author: ".$shortinfo."...<a href='".JUri::base()."astro/".$result->username."'>Read More</a></p>";
                }
                else
                {
                    $content        .= "<p>About Author: ".$result->info."</p>";
                }
                
                if($result->profile_status=="visible"&&$result->membership=="Paid")
                {
                    $content        .= "<form name='askexpert' method='post' enctype='application/x-www-form-urlencoded' action='".JRoute::_('?option=com_astrologin&task=astroask.askExpert')."'>";
                    $content        .= "<input type='hidden' value='".$result->id."' name='expert_id' />";
                    $content        .= "<button type='submit' class='btn btn-primary'><i class='fa fa-globe'></i> Ask Online</button>";
                    $content        .= "</form>";
                }
                    $content        .= "</div></div>";
                return $content;
            }
	}
}
