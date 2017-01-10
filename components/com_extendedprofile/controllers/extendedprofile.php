<?php
defined('_JEXEC') or die;
require_once JPATH_COMPONENT.'/controller.php';
class ExtendedProfileControllerExtendedProfile extends ExtendedProfileController
{
    public function registerAstro()
    {
        if(isset($_POST['submit_profile']))
        {
            $membership     = $_POST['astro_type'];
            $city           = $_POST['astro_city'];
            if(!empty($state)){$state          = $_POST['astro_state'];}
            exit;
            $country        = $_POST['astro_country'];
            
            if(!isset($_POST['condition_profile']))
            {
                $link       = JURI::base().'dashboard';
                $msg        = "You must <strong>Accept The Terms And Agreement</strong> in order to register.";
                $type       = 'error';
                $this->redictUrl($link, $msg,$type);
            }
            else
            {
                if($membership == "free")
                {
                    $user_details   = array(
                                            'membership'=>$membership
                                    );
                    $model          = $this->getModel('extendedprofile');  // Add the array to model
                    $data           = $model->saveUser($user_details);
                }
                else if($membership == "paid")
                {
                    $pay_type       = $_POST['astro_pay'];
                    $amount         = $_POST['astro_amount'];
                    $currency       = $_POST['astro_currency'];
                    $country        = $_POST['astro_country'];
                    $user_details = array('membership'=>$membership,'pay_type'=>$pay_type,
                                            'amount'=>$amount,'currency'=>$currency,'country'=>$country);
                    $model          = $this->getModel('extendedprofile');  // Add the array to model
                    $data           = $model->saveUser($user_details);
                }
            }
        }
    }
    
    public function saveAstro()
    {
        $id         = $_POST['profile_id'];
        $img        = $_FILES['astro_img']['name'];$img_type    = $_FILES['astro_img']['type'];
        $tmp        = $_FILES['astro_img']['tmp_name'];
        $img_size   = round((filesize($_FILES['astro_img']['tmp_name'])/1024),2);
        $addr1        = $_POST['astro_addr1'];
        $addr2      = $_POST['astro_addr2'];$city       = $_POST['astro_city'];
        $state      = $_POST['astro_state'];$country    = $_POST['astro_country'];
        $pcode      = $_POST['astro_pcode'];
        if(empty($_POST['astro_code'])&& empty($_POST['astro_phone']))
        {
            $phone  = "";
        }
        else
        {
            $phone      = $_POST['astro_code'].'-'.$_POST['astro_phone'];
        }
        $mobile     = $_POST['astro_mobile'];
        if(!empty($_POST['astro_whatsapp'])){$whatsapp="yes";}else{$whatsapp="no";};
        $website   = $_POST['astro_web'];$info          = $_POST['astro_info'];
        
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detectedType = exif_imagetype($_FILES['astro_img']['tmp_name']);
        $error = !in_array($detectedType, $allowedTypes);
         
        if($error)
        {
            $url = JURi::base().'details?image=false';
            $this->directUrl($url);
        }
        else if($img_size >= 2048)
        {
            $url = JRi::base().'details?image=size';
            $this->directUrl($url);
        }
        else
        {
               //echo $tmp;exit;
            $user_details   = array(
                                        'id'=>$id,'img_name'=>$img,'tmp_name'=>$tmp,
                                    'addr1'=>$addr1,'addr2'=>$addr2, 'city'=>$city,
                                    'state'=>$state,'country'=>$country,'pcode'=>$pcode,
                                    'phone'=>$phone,'mobile'=>$mobile,'whatsapp'=>$whatsapp,
                                    'website'=>$website,'info'=>$info
                                    );
            $model          = $this->getModel('extendedprofile');  // Add the array to model
            $data           = $model->saveAstro($user_details);
        }
    }
    public function updateAstro()
    {
        $id         = $_POST['profile_id'];
        $addr1        = $_POST['astro_addr1'];
        $addr2      = $_POST['astro_addr2'];$city       = $_POST['astro_city'];
        $state      = $_POST['astro_state'];$country    = $_POST['astro_country'];
        $pcode      = $_POST['astro_pcode'];
        if(empty($_POST['astro_code'])&& empty($_POST['astro_phone']))
        {
            $phone  = "";
        }
        else
        {
            $phone      = $_POST['astro_code'].'-'.$_POST['astro_phone'];
        }
        $mobile     = $_POST['astro_mobile'];
        if(!empty($_POST['astro_whatsapp'])){$whatsapp="yes";}else{$whatsapp="no";};
        $website   = $_POST['astro_web'];$info          = $_POST['astro_info'];
        
        $user_details   = array(
                                    'id'=>$id,
                                'addr1'=>$addr1,'addr2'=>$addr2, 'city'=>$city,
                                'state'=>$state,'country'=>$country,'pcode'=>$pcode,
                                'phone'=>$phone,'mobile'=>$mobile,'whatsapp'=>$whatsapp,
                                'website'=>$website,'info'=>$info
                                );
        $model          = $this->getModel('extendedprofile');  // Add the array to model
        $data           = $model->updateAstro($user_details);
    }
    protected function redictUrl($link, $msg, $type)
    {
        $mainframes = JFactory::getApplication();
        $mainframes->redirect($link, $msg,$type);
    }
}
