<?php

defined('_JEXEC') or die;
//print_r($this->msg);exit;
?>
<body onload="hideFields()">
<?php
//print_r($this->msg);exit;
defined('_JEXEC') or die('Restricted access');
$items          = $this->msg;
//print_r($items);exit;
unset($items['country']);
unset($items['amount']);
unset($items['currency']);
unset($items['curr_code']);
unset($items['curr_full']);
$user       = JFactory::getUser();
//print_r($user);exit;
$i          = 1;
?>
<h3>Enter Your Details</h3>
<div class="alert alert-warning alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> Fields marked with asterix(*) are compulsory.</div>
<div class="form-group"><label>Name: </label> <?php echo $user->name; ?></div>
<div class="form-group"><label>Email: </label> <?php echo $user->email; ?> <?php if($user->sendEmail == '0'){ ?><span style="color:green"><i class="fa fa-check-circle" aria-hidden="true"></i></span><?php } ?></div>
<form enctype="application/x-www-form-urlencoded" method="post" action="<?php echo JRoute::_('index.php?option=com_extendedprofile&task=extendedprofile.registerAstro'); ?>">
<div class="form-group">
    <label>Phone: </label>
    <input type="phone" class="form-control" name="astro_phone" placeholder="Enter Phone Number(Optional)" />
</div>
<div class="form-group">
    <label>Mobile: </label>
    <input type="text" class="form-control" name="astro_mobile" placeholder="Enter Mobile Number(Optional)" />
</div>
<div class="form-group">
    <label>City*: </label>
    <input type="text" class="form-control" name="astro_city" required placeholder="Enter City Name(Compulsory)" />
</div>
<div class="form-group">
    <label>State/Province: </label>
    <input type="text" class="form-control" name="astro_state" placeholder="Enter State/Province/County Name(Optional)" />
</div>  
<div class="form-group">
     <label>Country*: </label>
    <input type="text" class="form-control" name="astro_country" required placeholder="Enter Country Name(Compulsory)" />
</div>    
<div class="form-check">
    <label><strong>Select Expertise*: </strong>(One Main Category and related Sub Category Compulsory): </label>
<?php
foreach($items as $item)
{ 
    $id     = $item['role_id'];
    $name   = $item['role_name'];
    $role   = $item['role_primary'];
    $role_super     = $item['role_super'];
    if($role  == "1")
    {
?>
    <br/>
    <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="expert" value="<?php echo $id; ?>" /> <strong><?php echo $name; ?></strong>
    </label><br/>
<?php
        foreach($items as $subitems)
        {
            $subid  = $subitems['role_id'];
            $subname    = $subitems['role_name'];
            $sub_role_super = $subitems['role_super'];
            if($id       == $sub_role_super)
            {
?>      
                <label class="form-check-label">
                    <input class="form-check-input" name="subexpert" type="checkbox" value="<?php echo $id.":".$subid; ?>" /> <?php echo $subname; ?>
                </label>
<?php   
            }
        }
    }
}
?>
</div>
 <div class="form-group">
    <label for="astro_paid" class="control-label">Membership*:</label>
         <input type="radio" name="astro_type" value="paid" id="astro_paid" onclick="javascript:showFields();" /> Paid
        <input type="radio" name="astro_type" value="free" id="astro_free" checked="checked" onclick="javscript:hideFields();"/> Free
</div>

<div id="profile_hidden1" class="form-group">
    <label for="astro_online" class="control-label">Payment Type:</label>
<?php
    if(isset($this->msg['amount']) && isset($this->msg['currency']) && $this->msg['currency']=='INR')
    {
?>
    <input type="radio" name="astro_pay" value="online" id="astro_paytm" checked="checked"  /> <img src="<?php echo JURI::base() ?>images/paytm-logo.png" alt="Paytm" width="40px" height="25px" />
    <input type="radio" name="astro_pay" value="netbanking" id="astro_netbank" /> <img src="<?php echo JURI::base() ?>images/ccavenue.png" alt="CCAvenues" width="55px" height="35px" /> Netbanking/Debit Card/Credit Card/UPI
    <input type="radio" name="astro_pay" value="cheque" id="astro_bhim" /> <img src="<?php echo JURI::base() ?>images/bhim.png" alt="BHIM UPI" width="15px" height="25px" /> BHIM Scan Code/Virtual Address
    <input type="radio" name="astro_pay" value="cheque" id="astro_phonepe" /> <img src="<?php echo JURI::base() ?>images/phonepe.png" alt="Phonepe UPI" /> PhonePe Scan Code/Virtual Address
    <input type="radio" name="astro_pay" value="cheque" id="astro_paytm_code" /> <img src="<?php echo JURI::base() ?>images/paytm-logo.png" alt="Paytm" width="40px" height="25px" /> Scan Code
    <input type="radio" name="astro_pay" value="cheque" id="astro_cheque" /> Cheque
    <input type="radio" name="astro_pay" value="transfer" id="astro_transfter" /><span style="color:#C68642"><i class="fa fa-university" aria-hidden="true"></i></span> Direct Transfer Via NEFT/ATM/BANK
<?php
    }
    else
    {
?>
     <input type="radio" name="astro_pay" value="online" id="astro_online" checked="checked"  /> <span style="color:#139AD6"><i class="fa fa-paypal" aria-hidden="true"></i></span> Paypal
    <input type="radio" name="astro_pay" value="transfer" id="astro_transfter" /><span style="color:#C68642"><i class="fa fa-university" aria-hidden="true"></i></span> Direct Transfer Via Bank
<?php
    }
?>
</div>
<div id="profile_hidden2" class="form-group">
    <label for="astro_amount" class="control-label">Amount:</label>
<?php 
    if(isset($this->msg['amount']) && isset($this->msg['currency']))
    echo $this->msg['amount'].' '.$this->msg['curr_code'].'('.$this->msg['currency'].' - '.$this->msg['curr_full'].')';
    else
    echo "300 Rs";
 ?>
<input type="hidden" name="astro_amount" id="astro_amount" value="<?php if(isset($this->msg['amount']))echo $this->msg['amount'];else "300"; ?>" />
<input type="hidden" name="astro_currency" id="astro_currency" value="<?php if(isset($this->msg['currency']))echo $this->msg['currency'];else "INR"; ?>" />
<input type="hidden" name="astro_country" id="astro_country" value="<?php if(isset($this->msg['country']))echo $this->msg['country'];else "India"; ?>" />
</div>
<div class="form-group">
    <input type="checkbox" name="condition_profile" value="yes" required />
    <label for="condition_profile">Kindly Read and Accept the <a href="<?php echo JURI::base() ?>/terms" target="_blank" title="Read the Terms And Conditions before Registering as Astrologer">Terms and Conditions</a> for Registration *</label>
</div>
<div class="form-group">
        <button type="submit" name="submit_profile" class="btn btn-primary" onclick="checkValues();return false;">Submit</button>
        <a class="btn btn-danger" href="<?php echo JURI::base() ?>dashboard">Cancel</a>
    </div>
</form>
<?php
flush($this->msg);
flush($items);
?>
<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
    selector: '#astro_detail',
    plugins: "wordcount autolink",
    menubar: false
  });

function showFields()
{
    $('#profile_hidden1').show();
    document.getElementById("profile_hidden1").style.visibility = 'visible';
    $('#profile_hidden2').show();
    document.getElementById("profile_hidden2").style.visibility = 'visible';
}
function hideFields()
{
    if(document.getElementById("astro_free").checked)
    {
        $('#profile_hidden1').hide();
        document.getElementById("profile_hidden1").style.visibility = 'hidden';
        $('#profile_hidden2').hide();
        document.getElementById("profile_hidden2").style.visibility = 'hidden';
    }
    else
    {
        showFields();
    }
}
</script>
</body>