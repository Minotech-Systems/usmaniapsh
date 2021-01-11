<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
$text_align = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$account_type = $this->session->userdata('login_type');
$skin_colour = $this->db->get_where('settings', array('type' => 'skin_colour'))->row()->description;
$active_sms_service = $this->db->get_where('settings', array('type' => 'active_sms_service'))->row()->description;
$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
$talimi_saal = $this->db->get_where('settings', array('type' => 'talimi_saal'))->row()->description;
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">    
    <head>        <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>        
        <meta charset="utf-8">     

        <meta http-equiv="X-UA-Compatible" content="IE=edge">  

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />     


        <meta name="description" content="iTkoor School System" />  

        <meta name="author" content="iTkoor" />     

        <?php include 'includes_top.php'; ?>  
        <style>
            body{
                font-family:'Noto Nastaliq Urdu Draft', serif;
                height: 1000px; 
                font-size:12px; 
                font-weight:bold
            }
            @media (max-width: 768px) {
                body{
                    font-size:10px; 
                }
                h3,.h3 {
                    font-size: 16px;
                }
                h2,.h2{
                    font-size: 20px;
                }	
            }
            h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{font-family: 'Noto Nastaliq Urdu Draft', serif;}



        </style>

    </head>  


    <body class="page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour; ?>" style=""> 


        <div class="page-container  horizontal-menu   <?php echo 'right-sidebar'; ?>     


             <?php if ($page_name == 'student_bulk_add') echo 'sidebar-collapsed'; ?>" >       

            <?php include  'website/navigation.php'; ?>	      

            <div class="main-content" dir="rtl">                

                <?php include 'header.php'; ?>  

                <div class="row">   

                    <div class="col-md-12">      

                        <div class="row">         

                            <div class="col-sm-12">   

                                <?php include   'video/' . $page_name . '.php'; ?>           

                            </div>                      

                        </div>               

                    </div>              

                </div>              

                <?php include 'footer.php'; ?>         


            </div>       

            <?php //include 'chat.php';     ?>     

        </div>     

        <?php include 'modal.php'; ?>  

        <?php include 'includes_bottom.php'; ?>    

    </body>

</html>