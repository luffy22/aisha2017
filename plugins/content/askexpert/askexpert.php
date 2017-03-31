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
                                                               'c.city','c.country','c.membership','c.info','c.profile_status','c.max_no_ques','c.phone_or_report')));
                $query          ->from($db->quoteName('#__users','a'));
                $query          ->join('RIGHT', $db->quoteName('#__user_img','b'). ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('b.user_id') . ')');
                $query          ->join('RIGHT', $db->quoteName('#__user_astrologer','c'). ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('c.UserId') . ')');
                $query          ->where($db->quoteName('a.id').' = '.$db->quote($user));
                $db             ->setQuery($query);
                $db->execute();
                $result         = $db->loadObject();
                $content        = "<div class='card card-outline-info mb-3 text-center'>";
                $content        .= "<div class='card-block'>";
                $content        .= "<h3><a title='Click to get more info' href='#' data-toggle='modal' data-target='#astroinfo'><img src='".JURi::base()."images/profiles/".$result->img_new_name."' height='50px' width='50px' title='".$result->img_name."' />".$result->name."</a></h3>";
                $content        .= "<div class='modal fade' id='astroinfo' tabindex='-1' role='dialog' aria-hidden='true' aria-labelledby='astrolabel'>";
                $content        .= "<div class='modal-dialog' role='document'>";
                $content        .= "<div class='modal-content'>";
                $content        .= "<div class='modal-header'><h5 class='modal-title' id='astrolabel'>Expert Info</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span></button></div>";
                $content        .= "<div class='modal-body'>";
                $content        .= "<img src='".JURi::base().'images/profiles/'.$result->img_new_name."' height='50px' width='50px' title='".$result->img_name."' />".$result->name;
                $content        .= "<p>Location: ".$result->city.", ".$result->country."</p>";
                $content        .= "<p>".$result->info."</p>";
                $content        .= "</div>";
                $content        .= "<div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary btn-danger' data-dismiss='modal'>Close</button></div></div></div></div>";
                if($result->profile_status=="visible"&&$result->membership=="Paid")
                {
                    $content        .= "<p class='lead'>Get Online Consultation</p>";
                    $content        .= "<form name='askexpert' method='post' enctype='application/x-www-form-urlencoded' action='".JRoute::_('?option=com_astrologin&task=astroask.askExpert')."'>";
                    $content        .= "<input type='hidden' value='".$result->username."' name='expert_uname' />";
                    $content        .=  "<div class='form-group'>";
                    $content        .= "<label for='max_ques'>Number Of Questions</label>";
                    $content        .= "<select class='form-control' name='expert_max_ques' id='max_ques'>";
                    for($i=1;$i<=$result->max_no_ques;$i++)
                    {
                        $content    .= "<option value='".$i."'>".$i."</option>";
                    }
                    $content        .= "</select>";
                    $content        .= "</div>";
                    if($result->phone_or_report=='phone')
                    {
                        $content        .= "<div class='form-group'><label for='phone_or_report'>Order Type: </label> <i class='fa fa-phone'></i> ".ucfirst($result->phone_or_report)."</div>";
                        $content        .= "<input type='hidden' name='expert_order_type' id='expert_order_type' value='phone' />";
                    }
                    else if($result->phone_or_report=='report')
                    {
                        $content        .= "<div class='form-group'><label for='phone_or_report'>Order Type: </label> <i class='fa fa-file-pdf-o'></i> ".ucfirst($result->phone_or_report)."</div>";
                        $content        .= "<input type='hidden' name='expert_order_type' id='expert_order_type' value='report' />";
                    }
                    else if($result->phone_or_report=='both')
                    {
                        $content        .= "<fieldset class='form-group'><legend>Order Type:</legend>";
                        $content        .= "<div class='form-check'><label class='form-check-label'><input type='radio' class='form-check-input' name='expert_order_type' id='expert_order_type' value='phone' /><i class='fa fa-phone'></i> Phone</label></div>";
                        $content        .= "<div class='form-check'><label class='form-check-label'><input type='radio' class='form-check-input' name='expert_order_type' id='expert_order_type' value='report' /><i class='fa fa-file-pdf-o'></i> Report</label></div>";
                        $content        .= "</fieldset>";
                    }
                    else {
                        $content        .= "<div class='form-group'><label for='phone_or_report'>Order Type: </label> <i class='fa fa-file-pdf-o'></i> Report</div>";
                        $content        .= "<input type='hidden' name='expert_order_type' id='expert_order_type' value='report' />";
   
                    }
                    
                    $content            .= "<button type='submit' class='btn btn-primary' name='expert_submit'><i class='fa fa-globe'></i> Ask</button>";
                    $content            .= "</form>";
                }
                    $content            .= "</div></div>";
                return $content;
            }
	}
}
