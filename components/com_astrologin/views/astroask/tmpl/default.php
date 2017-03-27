<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
echo $this->msg;
?>
<h3>Ask An Expert</h3>
<form name="ask_expert" method="post" enctype="application/x-www-form-urlencoded" action="<?php echo JRoute::_('?option=com_astrologin&task=astroask.chooseExpert'); ?>">
<div class="form-group">
    <label>Choose Expert: </label>
    <input type="phone" class="form-control" name="astro_phone" placeholder="Enter Phone Number(Optional)" />
</div>
<div class="form-group">
    <button type="submit" name="ask_submit" class="btn btn-primary" onclick="checkValues();return false;">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
    <button type="reset" name="ask_reset" id="ask_reset" class="btn btn-danger">Reset</button>
</div>
</form>

