<div class="row">
    <div class="col-sm-3">
        <div class="tile-stats tile-green">          
            <div class="icon"><i class="entypo entypo-users"></i></div>     
            <div class="num" data-start="0" data-end="<?php echo $this->db->where(array('status'=> 1, 'year'=>$running_year))->from("new_enroll")->count_all_results();?>"      
                 data-postfix="" data-duration="1500" data-delay="0">0</div>                       
            <h3><?php echo 'تمام طلباء'; ?></h3>               
            <p>Total students</p>           
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-stats tile-aqua">          
            <div class="icon"><i class="entypo entypo-users"></i></div>     
            <div class="num" data-start="0" data-end="<?php echo $this->db->where(array('status'=> 1, 'year'=>$running_year,'branch_id'=> 2))->from("new_enroll")->count_all_results();?>"      
                 data-postfix="" data-duration="1500" data-delay="0">0</div>                       
            <h3><?php echo 'طلباء جامعہ عثمانیہ پشاور '.' (الف)'; ?></h3>               
            <p>Total students</p>           
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-stats tile-red">          
            <div class="icon"><i class="entypo entypo-users"></i></div>     
            <div class="num" data-start="0" data-end="<?php echo $this->db->where(array('status'=> 1, 'year'=>$running_year,'branch_id'=> 1))->from("new_enroll")->count_all_results();?>"      
                 data-postfix="" data-duration="1500" data-delay="0">0</div>                       
            <h3><?php echo 'طلباء جامعہ عثمانیہ پشاور '.' (ب)'; ?></h3>               
            <p>Total students</p>           
        </div>
    </div>
</div>