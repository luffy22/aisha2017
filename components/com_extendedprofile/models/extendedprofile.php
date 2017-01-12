<?php
defined('_JEXEC') or die;  // No direct Access
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');
class ExtendedProfileModelExtendedProfile extends JModelItem
{
    public function redirectLink($link, $msg, $type)
    {
        $app            = JFactory::getApplication();
        $app            ->redirect($link, $msg,$type);
    }
    public function getData()
    {
        $user = JFactory::getUser();
        $id   = $user->id;$name = $user->name;       
        // get the data
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $query          ->select($db->quoteName(array('UserId','membership','img_1','img_1_id',
                                     'addr_1','addr_2', 'city','state','country',
                                    'postcode','phone','mobile','whatsapp','website', 'info','profile_status')));
        $query          ->from($db->quoteName('#__user_astrologer'));
        $query          ->where($db->quoteName('UserId').' = '.$db->quote($id));
        $db             ->setQuery($query);
        $astro          = $db->loadAssoc();
        return $astro;
    }
    public function saveUser($data)
    {
        //print_r($data);exit;
        $city           = $data['city'];
        $state          = $data['state'];
        $country        = $data['country'];
        $phone          = $data['phone'];
        $mobile         = (int)$data['mobile'];
        $info           = $data['detail'];
        $sub_exp        = $data['sub_exp'];
        $terms          = $data['terms'];
        $date           = new DateTime("now",new DateTimeZone('Asia/Kolkata'));
        $date           = $date->format('Y-m-d H:i:s');
        $user           = JFactory::getUser();
        $id             = $user->id;
        $membership     = "Free";
        
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $columns        = array('UserId','membership','city','state','country','phone','mobile','info','terms','reg_date');
        $values         = array($db->quote($id),$db->quote($membership),$db->quote($city),$db->quote($state),
                                $db->quote($country),$db->quote($phone),$db->quote($mobile),$db->quote($info),
                                $db->quote($terms),$db->quote($date));
        $query
                        ->insert($db->quoteName('#__user_astrologer'))
                        ->columns($db->quoteName($columns))
                        ->values(implode(',', $values));
            // Set the query using our newly populated query object and execute it
        $db->setQuery($query);
        $result         = $db->execute();
        foreach($sub_exp as $exp)
        {
            //$query      ->clear();
            $query      = "INSERT INTO jv_role_astro (astro_id, sub_expert) VALUES ('".$id."','".$exp."')";
            $db         ->setQuery($query);
            $db         ->query();
        }
        if($result)
        {
            $msg        = "Added Successfully. Kindly Check Your Email For Details.";
            $type       = "success";
            $link       =  JURI::base().'dashboard';
            $this       ->redirectLink($link, $msg, $type);
        }
        else
        {
            $msg        = "Failed To Add Data. Something went wrong";
            $type       = "success";
            $link       =  JURI::base().'dashboard';
            $this       ->redirectLink($link, $msg, $type);
        }
    }
    public function updateUser($data)
    {
        //print_r($data);exit;
        $userid         = $data['userid'];
        //echo $userid;exit;
        $gender         = $data['gender'];$dob      = $data['dob'];
        $tob            = $data['tob'];$pob         = $data['pob'];$astro       = $data['astro'];
        // Get db connection
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
 
        $fields         = array($db->quoteName('gender').' = '.$db->quote($gender),
                                $db->quoteName('dob').' = '.$db->quote($dob),
                                $db->quoteName('tob').' = '.$db->quote($tob),
                                $db->quoteName('pob').' = '.$db->quote($pob),
                                $db->quoteName('astrologer').' = '.$db->quote($astro));
        $conditions     = array($db->quoteName('UserId').' = '.$db->quote($userid));
        
        $query->update($db->quoteName('#__user_extended'))->set($fields)->where($conditions);
        $db->setQuery($query);
 
        $result = $db->execute();
        return $result;
    }
    public function saveAstro($details)
    {
        //print_r($details);exit;
        $ext            = JFile::getExt($details['img_name']);
        $uniq_name      = 'img_'.date('Y-m-d-H-i-s').'_'.uniqid().".".$ext;
        
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $src            = $details['tmp_name']; //echo $src."<br/>";
        $dest           = JPATH_BASE.DS."images". DS ."profiles".DS.$uniq_name;
        //echo $dest;exit;
        $id             = $details['id'];$img_name      = $details['img_name'];
        $img_id         = $uniq_name;    $addr1         = $details['addr1'];
        $addr2          = $details['addr2'];$city       = $details['city'];
        $state          = $details['state'];$country    = $details['country'];
        $pcode          = $details['pcode'];$phone      = $details['phone'];
        $mobile         = $details['mobile'];$whatsapp  = $details['whatsapp'];
        $website        = $details['website'];$info     = $details['info'];$status  = 'visible';
        $upload         = JFile::upload($src, $dest);
        if($upload)
        {
            $fields         = array(
                                $db->quoteName('img_1').'='.$db->quote($img_name),
                                $db->quoteName('img_1_id').'='.$db->quote($img_id),
                                $db->quoteName('addr_1').'='.$db->quote($addr1),
                                $db->quoteName('addr_2').'='.$db->quote($addr2),
                                $db->quoteName('city').'='.$db->quote($city),
                                $db->quoteName('state').'='.$db->quote($state),
                                $db->quoteName('country').'='.$db->quote($country),
                                $db->quoteName('postcode').'='.$db->quote($pcode),
                                $db->quoteName('phone').'='.$db->quote($phone),
                                $db->quoteName('mobile').'='.$db->quote($mobile),
                                $db->quoteName('whatsapp').'='.$db->quote($whatsapp),
                                $db->quoteName('website').'='.$db->quote($website),
                                $db->quoteName('info').'='.$db->quote($info),
                                );
            $conditions = array(
                                    $db->quoteName('UserId') . ' = '.$db->quote($id)
                                );
            $query->update($db->quoteName('#__user_astrologer'))->set($fields)->where($conditions);

            $db->setQuery($query);
            $result          = $db->query();
            $app = JFactory::getApplication();
            $link=  JURI::base().'dashboard';
            if($result)
            {
                $msg = "Data Added Successfully..";
                
            }
            else
            {
               $msg  = "Failed to add data...";
            }
        }
        else
        {
            $msg  = "Failed to add data...";
        }
        $app->redirect($link,$msg);
    }
    public function updateAstro($details)
    {
       //print_r($data);exit;
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $id             = $details['id'];$img_name      = $details['img_name'];
        $img_id         = $uniq_name;    $addr1         = $details['addr1'];
        $addr2          = $details['addr2'];$city       = $details['city'];
        $state          = $details['state'];$country    = $details['country'];
        $pcode          = $details['pcode'];$phone      = $details['phone'];
        $mobile         = $details['mobile'];$whatsapp  = $details['whatsapp'];
        $website        = $details['website'];$info     = $details['info'];$status  = 'visible';
        $fields         = array(
                                $db->quoteName('addr_1').'='.$db->quote($addr1),
                                $db->quoteName('addr_2').'='.$db->quote($addr2),
                                $db->quoteName('city').'='.$db->quote($city),
                                $db->quoteName('state').'='.$db->quote($state),
                                $db->quoteName('country').'='.$db->quote($country),
                                $db->quoteName('postcode').'='.$db->quote($pcode),
                                $db->quoteName('phone').'='.$db->quote($phone),
                                $db->quoteName('mobile').'='.$db->quote($mobile),
                                $db->quoteName('whatsapp').'='.$db->quote($whatsapp),
                                $db->quoteName('website').'='.$db->quote($website),
                                $db->quoteName('info').'='.$db->quote($info),
                                );
        $conditions = array(
                                $db->quoteName('UserId') . ' = '.$db->quote($id)
                            );
        $query->update($db->quoteName('#__user_astrologer'))->set($fields)->where($conditions);
        $db->setQuery($query);
        $result = $db->execute();
        $app            = JFactory::getApplication();
        $link           = JURI::base().'dashboard?profile_update=success';
        $msg            = "Profile Updated Successfully... ";
        $app            ->redirect($link, $msg);
       
    }
}
?>
