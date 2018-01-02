<style type="text/css">
#article_slider {
    clear: both;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
}
</style>
<?php
JHtml::_('behavior.keepalive');
//print_r($allarticles);exit;
 $counter = 0;
?>
<div class="alert alert-info" role="alert" id="article_slider">
<?php
foreach($latest as $data)
{  
    $data->slug             = $data->article_id.':'.$data->article_alias;
    $data->link             = JRoute::_(ContentHelperRoute::getArticleRoute($data->slug, $data->catslug));
?>
    <i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="<?php echo $data->link; ?>"><?php echo $data->title." : ".$counter; ?></a>
<?php
	$counter++;
}
?>
</div>

