<?php
defined('_JEXEC') or die;
require_once JPATH_COMPONENT.'/controller.php';
class AstrologinControllerAstroask extends AstroLoginController
{
    public function askQuestions()
    { 
            $expert         = $_POST['ques_expert'];
            $no_of_ques     = $_POST['ques_no'];
            $order_type     = $_POST['ques_order_type'];
            $name           = $_POST['ques_name'];
            $email          = $_POST['ques_email'];
            $gender         = $_POST['ques_gender'];
            $dob            = $_POST['ques_dob'];
            $pob            = $_POST['ques_pob'];
            $tob            = $_POST['lagna_hr'].":".$_POST['lagna_min'].":".$_POST['lagna_sec']." ".$_POST['lagna_time'];
            
            $details    = array(
                                "expert"=>$expert,"no_of_ques"=>$no_of_ques,"order_type"=>$order_type,
                                "name"=>$name,"email"=>$email,"gender"=>$gender,"explain"=>$explain,
                                "dob"=>$dob,"pob"=>$pob, "tob"=>$tob
                                );
            //print_r($details);exit;
            $model          = $this->getModel('astroask');  // Add the array to model
            $model->insertDetails($details);
        
    }
    public function confirmPayment()
    {
        $id             = $_GET['id'];
        $auth_id       = $_GET['auth_id'];
        $token          = $_GET['token'];
        $details        = array("paypal_id"=>$id,"auth_id"=>$auth_id,"token"=>$token);
        $model          = $this->getModel('astroask');  // Add the array to model
        $model          ->authorizePayment($details);
    }
    public function failPayment()
    {
        $token              = $_GET['token'];
        $failid             = $_GET['failid'];
        $details        = array("token"=>$token, "fail_id"=>$failid);
        $model          = $this->getModel('astroask');  // Add the array to model
        $model          ->failPayment($details);
    }
    public function confirmCCPayment()
    {
        $token             = $_GET['token'];
        $track_id          = $_GET['track_id'];
        $bank_ref          = $_GET['bank_ref'];
        $status            = $_GET['status'];
        
        $details        = array("token"=>$token,"trackid"=>$track_id,"bankref"=>$bank_ref,"status"=>$status);
        $model          = $this->getModel('astroask');  // Add the array to model
        $model          ->confirmCCPayment($details);
    }
    public function askExpert()
    {
        if(isset($_POST['expert_submit']))
        {
            $uname              = $_POST['expert_uname'];
            $ques               = $_POST['expert_max_ques'];
            $order_type         = $_POST['expert_order_type'];
            
        }
        $app                    = JFactory::getApplication();
        
        $app        ->redirect(JUri::base().'ask-question?uname='.$uname.'&ques='.$ques.'&type='.$order_type);        
    }
}
?>
