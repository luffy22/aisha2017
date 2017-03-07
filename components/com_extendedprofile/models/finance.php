<?php
defined('_JEXEC') or die;  // No direct Access
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');
class ExtendedProfileModelFinance extends JModelItem
{
    public function getData()
    {

        $user = JFactory::getUser();
        $id   = $user->id;$name = $user->name;       
        // get the data
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $query          ->select($db->quoteName(array('membership')))
                        ->from($db->quoteName('#__user_astrologer'))
                        ->where($db->quoteName('UserId').' = '.$db->quote($id));
        $db             ->setQuery($query);
        $data           = $db->loadAssoc();
        if($data['membership'] == 'Free'|| $data['membership']=='Unpaid')
        {
           $result     = $this->getLocationDetails();
        }
       
        return $result;
    }
    function getLocationDetails()
    {
        $u_id           = 750;
        $service        = 'expert_fees';
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        try
        {
            $ip                     = '117.196.1.11';
            //$ip                     = '157.55.39.123';  // ip address
            //$ip = $_SERVER['REMOTE_ADDR'];        // uncomment this ip on server
            $info                   = geoip_country_code_by_name($ip);
            $country                = geoip_country_name_by_name($ip);
           // $location 		= $geoip->lookupLocation($ip);
            //$info                   = $location->countryCode;
            //$country                = $location->countryName;
            if($info == "US")
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('US'));
                
            }
            else if($info == "IN"||$info== 'LK'||$info=='NP'||$info=='TH'||$info=='MY'||$info=='MV')
            {
                 $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('IN'));
            }
            else if($info=='UK')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('UK'));
            }
            else if($info=='NZ')
            {
                 $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('NZ'));
            }
            else if($info=='CA')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('CA'));
            }
            else if($info=='SG')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('SG'));
            }
            else if($info=='AU')
            {
                 $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('AU'));
            }
            else if($info=='FR'||$info=='DE'||$info=='IE'||$info=='NL'||$info=='CR'||$info=='BE'
                    ||$info=='GR'||$info=='IT'||$info=='PT'||$info=='ES'||$info=='MT'||$info=='LV'||$info=='TR')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('EU'));
            }
            else if($info =='RU')
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('RU'));
            }
             else
            {
                $query          ->select($db->quoteName(array('a.country','a.amount','b.currency','b.curr_code','b.curr_full')))
                                ->from($db->quoteName('#__expert_charges','a'))
                                ->join('INNER', $db->quoteName('#__user_currency', 'b') . ' ON (' . $db->quoteName('a.currency_ref') . ' = ' . $db->quoteName('b.Curr_ID') . ')')
                                ->where($db->quoteName('user_id').' = '.$db->quote($u_id).' AND '.
                                        $db->quoteName('service_for_charge').' = '.$db->quote($service).' AND '.
                                        $db->quoteName('country').' = '.$db->quote('ROW'));
            }
             $db             ->setQuery($query);
             $country           = array("country_full"=>$country);
             $result           = $db->loadAssoc();
             $details           = array_merge($result,$country);
        }
        catch(Exception $e)
        {
            $details                =  array('error'=> 'Data not showing');
        }
        
        return $details;
    }
    function saveDetails($details)
    {
        //print_r($details);exit;
        $acc_name           = $details['acc_name'];$acc_number              = $details['acc_number'];
        $acc_bank_name      = $details['acc_bank_name'];$acc_bank_addr      = $details['acc_bank_addr'];
        $acc_iban           = $details['acc_iban'];$acc_swift               = $details['acc_swift'];
        $acc_ifsc           = $details['acc_ifsc'];$acc_paypal              = $details['acc_paypal'];
        $user           = JFactory::getUser();
        $id             = $user->id;

        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        
        $fields         = array($db->quoteName('acc_holder_name').' = '.$db->quote($acc_name),
                                $db->quoteName('acc_number').' = '.$db->quote($acc_number),
                                $db->quoteName('acc_bank_name').' = '.$db->quote($acc_bank_name),
                                $db->quoteName('acc_bank_addr').' = '.$db->quote($acc_bank_addr),
                                $db->quoteName('acc_iban').' = '.$db->quote($acc_iban),
                                $db->quoteName('acc_swift_code').' = '.$db->quote($acc_swift),
                                $db->quoteName('acc_iban').' = '.$db->quote($acc_iban),
                                $db->quoteName('acc_ifsc').' = '.$db->quote($acc_ifsc),
                                $db->quoteName('acc_paypalid').' = '.$db->quote($acc_paypal));
        $conditions     = array($db->quoteName('UserId').' = '.$db->quote($id));
        
        
        // Set the query using our newly populated query object and execute it
        $query->update($db->quoteName('#__user_finance'))->set($fields)->where($conditions);
        $db->setQuery($query);
 
        $result = $db->execute();

        if($result)
        {
            $app = JFactory::getApplication(); 
            $link = JURI::base().'dashboard?data=success';
            $msg = 'Successfully added Financial Details'; 
            $app->redirect($link, $msg, $msgType='message');
        }
        else
        {
            $app = JFactory::getApplication(); 
            $link = JURI::base().'dashboard?data=fail';
            $msg = 'Unable to add financial details'; 
            $app->redirect($link, $msg, $msgType='message');
        }
    }
    function getPaidMembership($details)
    {
        $amount     = $details['pay_amount'];
        $choice     = $details['pay_choice'];
        $currency   = $details['pay_currency'];
        $country    = $details['pay_country'];
        
        if($choice=="bhim"||$choice="phonepe"||$choice=="cheque"||$choice=="direct")
        {
            
        }
            
            
    }
}
