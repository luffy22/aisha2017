<?php
if(isset($_POST['expert']))
{
    $country        = $_POST['locate'];
    //$country        = "IN";
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
        $query          =       "SELECT jv_users.name as name,jv_users.username as uname, jv_user_img.img_new_name as img_new_name,
                                    jv_user_img.img_name as img_name, jv_user_astrologer.city as city, jv_user_astrologer.country as country,
                                    jv_user_astrologer.info as info, jv_user_astrologer.max_no_ques as max_no_ques
                                    ,jv_user_astrologer.phone_or_report as phone_or_report FROM jv_users RIGHT JOIN jv_user_astrologer ON jv_user_astrologer.UserId = jv_users.id 
                                    RIGHT JOIN jv_user_img ON jv_user_img.user_id = jv_users.id WHERE jv_users.id = '".$expert."'";
        $query         = mysqli_query($conn, $query);
        $result         = mysqli_fetch_object($query);
        echo json_encode($result);
    }
}
else
{
    echo "error";
    exit;
}
 /* 
 * $query          = "SELECT jv_users.id as user_id, jv_users.name as name,jv_users.username as uname, jv_user_img.img_new_name as img_new_name,
                            jv_user_img.img_name as img_name, jv_user_astrologer.city as city, jv_user_astrologer.country as country,
                            jv_user_astrologer.info as info, jv_user_astrologer.max_no_ques as max_no_ques
                            ,jv_user_astrologer.phone_or_report as phone_or_report FROM jv_users RIGHT JOIN jv_user_astrologer ON jv_user_astrologer.UserId = jv_users.id 
                            RIGHT JOIN jv_user_img ON jv_user_img.user_id = jv_users.id WHERE jv_users.id = '".$expert."'";
 */
    
?>
