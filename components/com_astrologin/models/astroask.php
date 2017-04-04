<?php
defined('_JEXEC') or die;  // No direct Access
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
class AstrologinModelAstroask extends JModelItem
{
    function getData()
    {
        $db             = JFactory::getDbo();  // Get db connection
        $query          = $db->getQuery(true);
        $query          ->select($db->quoteName(array('a.id','a.name','b.img_name','b.img_new_name','c.info')));
        $query          ->from($db->quoteName('#__users','a'));
        $query          ->join('RIGHT', $db->quoteName('#__user_img','b'). ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('b.user_id') . ')');
        $query          ->join('RIGHT', $db->quoteName('#__user_astrologer','c'). ' ON (' . $db->quoteName('a.id').' = '.$db->quoteName('c.UserId') . ')');
        $query          ->where($db->quoteName('c.membership').' = '.$db->quote('Paid').' AND '.
                                $db->quoteName('c.profile_status').' = '.$db->quote('visible'));
        $db             ->setQuery($query);
        $db->execute();
        $result         = $db->loadObjectList();
        return $result;
    }
public function insertDetails($details)
{
    $app                = JFactory::getApplication();
    $token              = uniqid('token_');
    $name               = ucfirst($details['name']);
    $email              = $details['email'];
    $gender             = ucfirst($details['gender']);
    $dob                = $details['dob'];
    $tob                = explode(":",$details['tob']);
    $fees               = $details['fees'];
    $currency           = $details['currency'];
    $pob                = $details['pob'];
    $expert             = $details['expert'];
    $no_of_ques         = $details['no_of_ques'];
    $order_type         = $details['order_type'];
    $pay_mode           = $details['pay_mode'];
    
    $date               = new DateTime($dob);
    $date               ->setTime($tob[0],$tob[1],$tob[2]);
    $dob_tob            = strtotime($date->format('Y-m-d H:i:s'));
    $date1              = new DateTime('now');
    $date1              ->setTimezone('Asia/Kolkata');
    $ques_ask_date      = $date1->format('Y-m-d H:i:s');
    $db                 = JFactory::getDbo();  // Get db connection
    $query              = $db->getQuery(true);
    $query              ->select($db->quoteName(array('id')))
                        ->from($db->quoteName('#__users'))
                        ->where($db->quoteName('username').' = '.$db->quote($expert));
    $db                 ->setQuery($query);
    $row                = $db->loadAssoc();
    $expert_id          = $row['id'];   
       //print_r($details);exit;
    //$query1         = $db->getQuery(true);
    $columns        = array('UniqueID','expert_id','no_of_ques','fees','currency','pay_mode','name','email','gender', 'dob_tob', 
                            'pob','order_type','ques_ask_date'
                            );
    $values         = array(
                            $db->quote($token),$db->quote($expert_id),$db->quote($no_of_ques),
                            $db->quote($fees),$db->quote($currency),$db->quote($pay_mode),
                            $db->quote($name), $db->quote($email),$db->quote($gender), 
                            $db->quote($dob_tob),$db->quote($pob),$db->quote($order_type),$db->quote($ques_ask_date)
                            );
    // Prepare the insert query
    $query          ->insert($db->quoteName('#__question_details'))
                    ->columns($db->quoteName($columns))
                    ->values(implode(',', $values));
    // Set the query using our newly populated query object and execute it
    $db             ->setQuery($query);
    $result          = $db->query();
    if($result)
    {
        
        $query          ->clear();
        $query          ->select($db->quoteName(array('UniqueID','no_of_ques')))
                        ->from('#__question_details')
                        ->where($db->quoteName('email').' = '.$db->quote($email).' AND '.
                                $db->quoteName('UniqueID').' = '.$db->quote($token));
        $db                  ->setQuery($query);
        $details        = $db->loadAssoc();
        $uniqID         = $details['UniqueID'];
        $no_of_ques     = $details['no_of_ques'];       
        $app            ->redirect(JUri::base().'ask-question?uniq_id='.$uniqID.'&no_of_ques='.$no_of_ques.'&expert='.$expert);
    }
    else
    {
        $msg            = "Something went wrong. Please try again.";
        $type           = "error";
        $app            ->redirect(Juri::base().'ask-expert',$msg,$type);
    }
    
}
public function insertQuestions($details)
{
    $app                = JFactory::getApplication();
    $db                 = JFactory::getDbo();  // Get db connection
    $query              = $db->getQuery(true);
    $token              = $details['uniq_id'];
    $no_of_ques         = $details['ques_no'];
    for($i=1;$i<=$no_of_ques;$i++)
    {
        ${"select_".$i}                     = $details['select_'.$i];
        ${"ask_".$i}                        = $details['ask_'.$i];
        ${"ques_details_".$i}               = $details['details_'.$i];
        $query                              = "INSERT INTO jv_question (order_id,ques_topic,ques_ask,ques_details) 
                                                VALUES ('".$token."','".${"select_".$i}."','".${"ask_".$i}."','".${"ques_details_".$i}."')";
        // Set the query using our newly populated query object and execute it
        $db             ->setQuery($query);
        $result          = $db->query();
    }
    if($result)
    {
        $app            ->redirect(Juri::base().'ask-expert?payment=pay');
    }
    else
    {
        $msg            = "Something went wrong. Please try again.";
        $type           = "error";
        $app            ->redirect(Juri::base().'ask-expert',$msg,$type);
    }
}
public function getExpert()
{
    
    $jinput             = JFactory::getApplication()->input;
    $expert             = $jinput->get('expert',  'default_value', 'string');
    $db                 = JFactory::getDbo();  // Get db connection
    $query              = $db->getQuery(true);
    $query2              = $db->getQuery(true);
    $query              ->select($db->quoteName(array('id')))
                        ->from($db->quoteName('#__users'))
                        ->where($db->quoteName('username').' = '.$db->quote($expert));
    $db                     ->setQuery($query);
    $id                     = $db->loadResult();
    $query                  ->clear();
    $query              ->clear();
    $query                  =   "SELECT DISTINCT(main_expert) from jv_role_astro where astro_id ='".$id."'";
    $db                     ->setQuery($query);
    $main                    = $db->loadColumn();     
    $main_exp               = array();
    foreach($main as $mainexp)
    {
        $query2                 ->select($db->quoteName(array('role_id','role_name','role_super')))
                                ->from($db->quoteName('#__role'))
                                ->where($db->quoteName('role_id') . ' = '. $db->quote($mainexp));
        $db                     ->setQuery($query2);
        $row                    = $db->loadObjectList();
        $main_exp               = array_merge($main_exp,$row);
        $query2                 ->clear();

    }
    $query2                     ->select($db->quoteName('sub_expert'))
                                ->from($db->quoteName('#__role_astro'))
                                ->where($db->quoteName('astro_id').' = '.$db->quote($id));
    $db                         ->setQuery($query2);
    $sub                        = $db->loadColumn();
    $sub_exp                    = array();
    foreach($sub as $subexp)
    {
        $query2                 ->clear();
        $query2                  ->select($db->quoteName(array('role_id','role_name','role_super')))
                                ->from($db->quoteName('#__role'))
                                ->where($db->quoteName('role_id') . ' = '. $db->quote($subexp));
        $db                     ->setQuery($query2);
        $row                    = $db->loadObjectList();
        $sub_exp               = array_merge($sub_exp,$row);

    }
    $exp                      = array_merge($main_exp, $sub_exp);
    return $exp;
    
}
// paypal authorize Order
public function authorizePayment($details)
{
    $paypal_id      = $details['paypal_id'];
    $auth_id       = $details['auth_id'];
    $token          = $details['token'];
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    // Fields to update.
    $fields = array(
        $db->quoteName('paypal_id').'='.$db->quote($paypal_id),
        $db->quoteName('authorize_id').'='.$db->quote($auth_id),
        $db->quoteName('status').'='.$db->quote('Authorized'));
    // Conditions for which records should be updated.
    $conditions = array(
        $db->quoteName('UniqueID').'='.$db->quote($token)
    );
    $query->update($db->quoteName('#__paypal_info'))->set($fields)->where($conditions);
 
    $db->setQuery($query);
 
    $result = $db->execute();
        $query      ->clear();
        $query              ->select($db->quoteName(array('a.UniqueID','a.name','a.email',
                                    'a.gender','a.dob','a.pob','a.tob','a.fees','a.choice','a.explain_choice',
                                    'a.user_currency','a.user_curr_full',
                                    'a.ques_topic1','a.ques_1','a.ques_1_explain',
                                    'a.ques_topic2','a.ques_2','a.ques_2_explain',
                                    'a.ques_topic3','a.ques_3','a.ques_3_explain','b.paypal_id','b.status')))
                            ->from($db->quoteName('#__questions','a'))
                              ->join('INNER', $db->quoteName('#__paypal_info', 'b') . ' ON (' . $db->quoteName('a.UniqueID').' = '.$db->quoteName('b.UniqueID') . ')')
                            ->where($db->quoteName('b.paypal_id').'='.$db->quote($paypal_id));
       $db                  ->setQuery($query);
       $details                 = $db->loadAssoc();
       $fees                = $details['fees'];
       $choice              = $details['choice'];

        $bcc                = 'kopnite@gmail.com';
        $subject            = "Ask AstroIsha Quesion Token No: ".$details['UniqueID'];
        $ques_topic1        = $details['ques_topic1'];
        $ques_1             = $details['ques_1'];
        $ques_explain1      = $details['ques_1_explain'];
        $ques_topic2        = $details['ques_topic2'];
        $ques_2             = $details['ques_2'];
        $ques_explain2      = $details['ques_2_explain'];
        $ques_topic3        = $details['ques_topic3'];
        $ques_3             = $details['ques_3'];
        $ques_explain3      = $details['ques_3_explain'];
        
        $body               = "Dear ".$details['name'].",<br/>"."<html>&nbsp;&nbsp;&nbsp;</html>This is to confirm that your question form has been received. Also your payment of ".$fees." ".$details['user_currency']."(".$details['user_curr_full'].")".
                                " has been authorized. We would process your query and give a detailed answer with logical solution to your questions in 7 Working Days. Your money would only be deducted once we have finished the report and mailed it to you.<br/><br/>";
        $body               .= "Your Details are as below.<br/><br/>";
        $body               .= "Name: ".$details['name']."<br/>";
        $body               .= "Email: ".$details['email']."<br/>";
        $body               .= "Gender: ".$details['gender']."<br/>";
        $body               .= "Date Of Birth: ".$details['dob']."<br/>";
        $body               .= "Time Of Birth: ".$details['tob']."<br/>";
        $body               .= "Place Of Birth: ".$details['pob']."<br/>";
        $body               .= "Token Number: ".$details['UniqueID']."<br/>";
        $body               .= "Payment ID: ".$details['paypal_id']."<br/>";
        $body               .= "Status: ".$details['status']."<br/>";
        $body               .= "Number Of Questions: ".$details['choice']."<br/>";
        $body               .= "Explanation (Detail/Short): ".ucfirst($details['explain_choice'])."<br/><br/>";
        if($details['explain_choice'] == 'short')
        {
            for($i=0;$i<$choice;$i++)
            {
                $j              = $i+1;
                $body               .= "<strong>Question ".$j.":</strong><br/>";
                $body               .= "Topic: ".${"ques_topic".$j}."<br/>";
                $body               .= "Question: ".${"ques_".$j}."<br/><br/>";
            }
        }
        else if($details['explain_choice']== 'detail')
        {
            for($i=0;$i<$choice;$i++)
            {
                $j=$i+1;
                $body               .= "<strong>Question ".$j.":</strong><br/>";
                $body               .= "Topic: ".${"ques_topic".$j}."<br/>";
                $body               .= "Question: ".${"ques_".$j}."<br/>";
                $body               .= "Background: ".${"ques_explain".$j}."<br/><br/>";
            }
        }
    $body               .= "<br/><div style='align:right'>Admin At Astro Isha,<br/>Rohan Desai</div>";        
    $mailer             = JFactory::getMailer();
    $config             = JFactory::getConfig();
    $sender             = array( 
                                    $config->get( 'mailfrom' ),
                                    $config->get( 'fromname' ) 
                                );

    $mailer             ->setSender($sender);
    $mailer             ->addRecipient($details['email']);
    $mailer             ->addBCC($bcc, 'Rohan Desai');
    $mailer             ->setSubject($subject);
    $mailer             ->isHTML(true);
    $mailer             ->Encoding = 'base64';
    $mailer             ->setBody($body);

    $send = $mailer->Send();
    if ( $send !== true ) {
        echo 'Error sending email: ' . $send->__toString();
    } else {
        $app                =&JFactory::getApplication();
        $app                ->redirect('index.php?option=com_astrologin&view=quesconfirm&payment=paypal'); 
    }

}
public function failPayment($details)
{
    $token          = $details['token'];
    $fail_id        = $details['fail_id'];
    $db         = JFactory::getDbo();
    $query      = $db->getQuery(true);
     $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    // Fields to update.
    $fields = array(
        $db->quoteName('authorize_id') . ' = ' . $db->quote('no'),
        $db->quoteName('paypal_id').'='.$db->quote($fail_id),
        $db->quoteName('status').'='.$db->quote('Cancelled'));
    // Conditions for which records should be updated.
    $conditions = array(
        $db->quoteName('UniqueID').'='.$db->quote($token)
    );
    $query->update($db->quoteName('#__paypal_info'))->set($fields)->where($conditions);
 
    $db->setQuery($query);
 
    $result = $db->execute();
    if($result)
    {
        $query      ->clear();
        $query              ->select($db->quoteName(array('UniqueID','name','email')))
                            ->from($db->quoteName('#__questions'))
                            ->where($db->quoteName('UniqueID').'='.$db->quote($token));
        $db                  ->setQuery($query);
        $details                 = $db->loadAssoc();

        $bcc                = 'kopnite@gmail.com';
        $subject            = "Astro Isha Failed Transaction ID: ".$details['UniqueID'];
            
        $body               = "Dear ".$details['name'].",<br/>"."<html>&nbsp;&nbsp;&nbsp;</html>Your order with Astro Isha was cancelled. Please try again if you wish your query to be resolved by Astro Isha. If you 
                               do not wish paid consultation please ignore this email.<br/><br/>";
        
        $body               .= "<br/><div style='align:right'>Your Sincerely,<br/>Admin(Rohan Desai)</div>";        
        $mailer             = JFactory::getMailer();
        $config             = JFactory::getConfig();
        $sender             = array( 
                                    $config->get( 'mailfrom' ),
                                    $config->get( 'fromname' ) 
                                );

        $mailer             ->setSender($sender);
        $mailer             ->addRecipient($details['email']);
        $mailer             ->addBCC($bcc, 'Rohan Desai');
        $mailer             ->setSubject($subject);
        $mailer             ->isHTML(true);
        $mailer             ->Encoding = 'base64';
        $mailer             ->setBody($body);

        $send = $mailer->Send();
        if ( $send !== true ) {
            echo 'Error sending email: ' . $send->__toString();
        } else {
            $app                =&JFactory::getApplication();
            $app                ->redirect('index.php?option=com_astrologin&view=quesconfirm&payment=false');
            
            }
    }
}
public function confirmCCPayment($details)
{
    $token              = $details['token'];
    $trackid            = $details['trackid'];
    $bankref            = $details['bankref'];
    $status             = $details['status'];
    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    // Fields to update.
    $fields = array(
        $db->quoteName('ccavenue_track_id') . ' = ' . $db->quote($trackid),
        $db->quoteName('ccavenue_bank_ref_no') . ' = ' . $db->quote($bankref),
        $db->quoteName('ccavenue_confirm') . ' = ' . $db->quote('yes'),
        $db->quoteName('ccavenue_status') . ' = ' . $db->quote($status)
        );
    // Conditions for which records should be updated.
    $conditions = array(
        $db->quoteName('UniqueID').'='.$db->quote($token)
    );
    $query->update($db->quoteName('#__questions'))->set($fields)->where($conditions);
 
    $db->setQuery($query);
 
    $result = $db->execute();
    if($result)
    {
        $query      ->clear();
        $query              ->select($db->quoteName(array('UniqueID','name','email',
                                    'gender','dob','pob','tob','fees','choice','explain_choice',
                                    'user_currency','user_curr_full','ccavenue_track_id', 'ccavenue_bank_ref_no',
                                    "ccavenue_confirm","ccavenue_status",
                                    'ques_topic1','ques_1','ques_1_explain',
                                    'ques_topic2','ques_2','ques_2_explain',
                                    'ques_topic3','ques_3','ques_3_explain')))
                            ->from($db->quoteName('#__questions'))
                            ->where($db->quoteName('UniqueID').'='.$db->quote($token));
       $db                  ->setQuery($query);
       $details                 = $db->loadAssoc();
    }
    $name               = $details['name'];
    $gender             = $details['gender'];
    $dob                = $details['dob'];
    $fees               = $details['fees'];
    $pob                = $details['pob'];
    $tob                = $details['tob'];
    $choice             = $details['choice'];
    $explain            = $details['explain_choice'];
    $to                 = $details['email'];
    $bcc                = 'kopnite@gmail.com';
    $subject            = "Ask AstroIsha Quesion Token No: ".$details['UniqueID'];
    $ques_topic1        = $details['ques_topic1'];
    $ques_1             = $details['ques_1'];
    $ques_explain1      = $details['ques_1_explain'];
    $ques_topic2        = $details['ques_topic2'];
    $ques_2             = $details['ques_2'];
    $ques_explain2      = $details['ques_2_explain'];
    $ques_topic3        = $details['ques_topic3'];
    $ques_3             = $details['ques_3'];
    $ques_explain3      = $details['ques_3_explain'];
    if($details['ccavenue_status']=='Success')
    {
    if($explain=="detail")
    {
        $body               = "Dear ".$details['name'].",<br/>"."<html>&nbsp;&nbsp;&nbsp;</html>This is to confirm that your question form has been received. Also your payment of ".$fees." ".$details['user_currency']."(".$details['user_curr_full'].")".
                                " has been authorized. We would process your query and give a detailed answer with logical solution to your questions in 7 Working Days. Your money would only be debited from your Account once we have finished the report and mailed it to you.<br/><br/>";
        $body               .= "Your Details are as below.<br/><br/>";
        $body               .= "Name: ".$name."<br/>";
        $body               .= "Email: ".$to."<br/>";
        $body               .= "Gender: ".$gender."<br/>";
        $body               .= "Date Of Birth: ".$dob."<br/>";
        $body               .= "Time Of Birth: ".$tob."<br/>";
        $body               .= "Place Of Birth: ".$pob."<br/>";
        $body               .= "Token Number: ".$details['UniqueID']."<br/>";
        $body               .= "Track ID: ".$details['ccavenue_track_id']."<br/>";
        $body               .= "Bank Reference Number: ".$details['ccavenue_bank_ref_no']."<br/>";
        $body               .= "Number Of Questions: ".$choice."<br/>";
        $body               .= "Explanation (Detail/Short): ".$explain."<br/><br/>";
        for($i=0;$i<$choice;$i++)
        {
            $j=$i+1;

            $body               .= "<strong>Question ".$j.":</strong><br/>";
            $body               .= "Topic: ".${"ques_topic".$j}."<br/>";
            $body               .= "Question: ".${"ques_".$j}."<br/>";
            $body               .= "Background: ".${"ques_explain".$j}."<br/><br/>";
        }
            $body               .= "<br/><div style='align:right'>Your Sincerely,<br/>Admin(Rohan Desai)</div>";
    }
    else if($explain=="short")
    {

        $body               = "Dear ".$details['name'].",<br/>"."<html>&nbsp;&nbsp;&nbsp;</html>This is to confirm that your question form has been received. Also your payment of ".$fees." ".$details['user_currency']."(".$details['user_curr_full'].")".
                                " has been authorized. We would process your query and give a detailed answer with logical solution to your questions in 7 Working Days. Your money would only be debited from your Account once we have finished the report and mailed it to you.<br/><br/>";
        $body               .= "Your Details are as below.<br/><br/>";
        $body               .= "Name: ".$name."<br/>";
        $body               .= "Email: ".$to."<br/>";
        $body               .= "Gender: ".$gender."<br/>";
        $body               .= "Date Of Birth: ".$dob."<br/>";
        $body               .= "Time Of Birth: ".$tob."<br/>";
        $body               .= "Place Of Birth: ".$pob."<br/>";
        $body               .= "Token Number: ".$details['UniqueID']."<br/>";
        $body               .= "Track ID: ".$details['ccavenue_track_id']."<br/>";
        $body               .= "Bank Reference Number: ".$details['ccavenue_bank_ref_no']."<br/>";
        $body               .= "Number Of Questions: ".$choice."<br/>";
        $body               .= "Explanation (Detail/Short): ".$explain."<br/><br/>";
        for($i=0;$i<$choice;$i++)
        {
            $j              = $i+1;
            $body               .= "<strong>Question ".$j.":</strong><br/>";
            $body               .= "Topic: ".${"ques_topic".$j}."<br/>";
            $body               .= "Question: ".${"ques_".$j}."<br/><br/>";
        }
            $body               .= "<br/><div style='align:right'>Your Sincerely,<br/>Admin(Rohan Desai)</div>";
    }
}
else if($details['ccavenue_status']=='Invalid'||
        $details['ccavenue_status']=='Aborted'||
        $details['ccavenue_status']=='Failure')
{
    $body               = "Dear ".$details['name'].",<br/>"."<html>&nbsp;&nbsp;&nbsp;</html>We were unable to process your request due to Cancellation Of Order. Please try again to make payment.";
    $body               .= "<br/><div style='align:right'>Your Sincerely,<br/>Admin(Rohan Desai)</div>";
}
else
{
    $body               = "Dear ".$details['name'].",<br/>"."<html>&nbsp;&nbsp;&nbsp;</html>Something went wrong and we are unable to process your Order. Please try again later.";
    $body               .= "<br/><div style='align:right'>Your Sincerely,<br/>Admin(Rohan Desai)</div>";
}
    $mailer             = JFactory::getMailer();
    $config             = JFactory::getConfig();
    $sender             = array( 
                                    $config->get( 'mailfrom' ),
                                    $config->get( 'fromname' ) 
                                );
    $mailer             ->setSender($sender);
    $mailer             ->addRecipient($details['email']);
    $mailer             ->addBCC($bcc, 'Rohan Desai');
    $mailer             ->setSubject($subject);
    $mailer             ->isHTML(true);
    $mailer             ->Encoding = 'base64';
    $mailer             ->setBody($body);

    $send = $mailer->Send();
    if ( $send !== true ) {
        echo 'Error sending email: ' . $send->__toString();
    }
    else if($details['ccavenue_status']=='Invalid'||
        $details['ccavenue_status']=='Aborted')
    {
        $app                =&JFactory::getApplication();
        $app                ->redirect('index.php?option=com_astrologin&view=quesconfirm&payment_success=false');
    }
    else {
        $app                =&JFactory::getApplication();
        $app                ->redirect('index.php?option=com_astrologin&view=quesconfirm&payment=ccavenue'); 
    }
}
    
}
?>
