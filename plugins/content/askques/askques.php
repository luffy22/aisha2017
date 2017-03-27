<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.plugin.plugin');
class PlgContentAskques extends JPlugin
{
	function onContentAfterDisplay($context, &$article, &$params, $limitstart=0)
	{
            //print_r($params);exit;
            $ask    =  $this->getExpertInfo();
            return $ask;
	}
        function getExpertInfo()
        {
       ?>
            <div class='card card-outline-primary mb-3 text-center'>
          <div class='card-block'><h3>Ask Question</h3></div></div>"
<?php
        }
}
?>
