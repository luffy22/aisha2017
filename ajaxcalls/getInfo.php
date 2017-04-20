<?php

//if(isset($_POST['expert']))
//{
    //$country        = $_POST['locate'];
    $country        = "IN";
    $host   = "localhost";$user = "root";
    $pwd    = "desai1985";$db   = "astroisha2017";
    $conn   = new mysqli($host, $user, $pwd, $db);
    /* check connection */
    if (mysqli_connect_errno()) 
    {
        echo "error";
        exit();
    }
    else
    {
        $expert         =       substr($_POST['expert'],9);
        $query          = "SELECT jv_users.name as astro_name,jv_user.username as astro_uname, jv_user_astrologer.max_no_ques as max_ques, 
                            jv_user_astrologer.phone_or_report as phone_or_report, jv_expert_charges.amount AS expert_amount, jv_expert_charges.currency_ref as currency_ref FROM jv_users 
                            INNER JOIN  jv_expert_charges ON jv_expert_charges.user_id = jv_users.id 
                            INNER JOIN jv_user_astrologer.UserId = jv_users.id 
                            WHERE 
                            jv_expert_charges.country = '".$country."' AND jv_users.id = '".$expert."' AND 
                            AND jv_expert_charges='expert_fees' ";
        $result         = mysqli_query($mysqli, $query);
        print_r($result);exit;
    }
//}
//else
//{
    //echo "error";
    //exit;
//}
?>
