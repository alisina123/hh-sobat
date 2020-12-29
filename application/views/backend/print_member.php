<style type="text/css">
.table-my{
border: solid green 1px;     
   
}
.table-my td{
border: solid green 1px; 
   
}
.table-my tr{
border: solid green 1px; 
   
}
.same_div{                   
    display: inline-block;
}

</style>
<?php
        if($record)
        {
            
            $current='';
            $permanent='';
            $rec=$record[0];
            $rec2=$record[1];
            if($rec->type==2)
            {
                $current=$rec;
                $permanent=$rec2;
            }
            else
            {
                 $current=$rec2;
                 $permanent=$rec;
            }
            $photo=base_url('uploads/img/member/'.$rec->photo);
    ?>      
<div class="row" style="color: green;">
    <div class="col-sm-12">
        <div class="company-item table-full-width" style="overflow: auto;">
           
            <table class="table table-my table-bordered" border="1" cellpadding="2px"  style="font-size: 14px; ">
              
           <caption> 
           <div style="float: left; width: 20%;" class="same_div"><img src="<?=base_url()?>assets/img/logo.jpg" width="110px" height="110px" style="float: left;">
           </div>                                                
           <div class="same_div" style="width: 60%;"> <center><h1 style="font-size: 25px; color: green;"><?=lang('system_title')?></h1></center>
            <center><span style="font-size: 25px; color: green;"><?=lang('presidency_of_organizations')?></span></center>
          </div>    
           <div style="float: right; width: 20%;" class="same_div">
           <br>
           <?=lang('number_dot')?>
           <br> 
           <?=lang('date_dot')?>
            
           </div>
          
            </caption> 
                <tr>
                    <td width="12%" colspan="2">1</td>
                    <td width="12%"><?=lang('name').' '.lang('and').lang('lastname')?></td>
                    <td width="31%"><?=$rec->name.' , '.$rec->lastname?></td>
                    <td rowspan="7" colspan="2" width="45%">
                    <img src="<?=$photo?>" style="width: 120px; float: left; margin: 5px;" alt="">
                    <?=lang('term_of_policy')?>
                       <br><br>
                    <?=lang('in_respect')?>
                    <br>
                    <?=lang('signature_and_fingerprint')?>
                    </td>  
                 
                </tr>
                <tr>
                    <td colspan="2">2</td>
                    <td><?=lang('fname')?></td> 
                    <td><?=$rec->fname?></td> 
                </tr>
                <tr>
                    <td colspan="2">3</td>
                    <td><?=lang('gender')?></td> 
                    <td><?=lang($rec->gender)?></td> 
                </tr>
                <tr>    
                    <td colspan="2">4</td>
                    <td><?=lang('date_of_birth')?></td> 
                    <td><?=datecheck($rec->date_of_birth,false)?></td> 
                </tr>
                <tr>
                    <td colspan="2">5</td>
                    <td><?=lang('tribe')?></td> 
                    <td><?=$rec->tribe?></td> 
                </tr>
                <tr>
                    <td colspan="2">6</td>
                    <td><?=lang('level_of_education')?></td> 
                    <td><?=$rec->level_of_education?></td> 
                </tr>
                <tr>
                    <td colspan="2">7</td>
                    <td><?=lang('field_of_education')?></td> 
                    <td><?=$rec->field_of_education?></td> 
                </tr>
                <tr>
                    <td colspan="2">8</td>
                    <td><?=lang('job')?></td> 
                    <td><?=$rec->job?></td> 
                    <td colspan="2"><center><?=lang('precess_of_organization')?></center></td> 
                </tr>
                 <tr>
                    <td colspan="2">9</td>
                    <td><?=lang('marital_status')?></td> 
                    <td><?=$rec->marital_status?></td> 
                    <td>مراجع</td>       
               </tr>
               <tr>
                    <td rowspan="3">10</td>
                    <td rowspan="3"><?=lang('permanent_address')?></td> 
                    <td><?=lang('province')?></td> 
                    <td><?=$permanent->province?></td>   
                    <td><?=lang('stamp_and_signature')?></td>  
                </tr>
                <tr>                                    
                    <td><?=lang('district')?></td> 
                    <td><?=$permanent->district?></td> 
                    <td colspan="2"><?=lang('district_responsible')?></td> 
                </tr>
                <tr>                                    
                    <td><?=lang('village')?></td> 
                    <td><?=$permanent->village?></td> 
                    <td colspan="2">شورای ولایتی</td> 
                </tr>
                 <tr>
                    <td rowspan="3">11</td>
                    <td rowspan="3"><?=lang('current_address')?></td> 
                    <td><?=lang('province')?></td> 
                    <td><?=$current->province?></td>
                    <td colspan="2"><?=lang('presidency_of_organizations')?></td> 
                </tr>
                <tr>                                    
                    <td><?=lang('district')?></td> 
                    <td><?=$current->district?></td> 
                    <td colspan="2" rowspan="2">یاداشت : 
                    در صورت نیاز به توضیحات بیشتر در مورد درجات تحصیلی و یا رشته های تخصصی درعقب ورق و ضاحت داده شود.
                    </td> 
                </tr>
                <tr>                                    
                    <td><?=lang('village')?></td> 
                    <td><?=$current->village?></td>   
                </tr>
                  <tr>                                    
                    <td colspan="4"><center>شهرت و تعهد معرف</center></td>
                    <td><?=lang('phone_number')?></td>     
                </tr>
                <tr>
                    <td colspan="2">12</td>
                    <td><?=lang('name')?></td> 
                    <td><?=$rec->r_name?></td>
                    <td><?=lang('email')?></td> 
                  
                </tr>
                 <tr>
                    <td colspan="2">13</td>
                    <td><?=lang('fname')?></td> 
                    <td><?=$rec->r_fname?></td> 
                    <td colspan="4" rowspan="3">
                    <?=lang('term_of_policy_recommender')?>
                    <br>
                    <br>
                    والسلام
                     <br>
                    <?=lang('signature_and_fingerprint')?>
                    </td> 
                                              
                </tr>
                 <tr>
                    <td colspan="2">14</td>
                    <td><?=lang('job')?></td> 
                    <td><?=$rec->r_job?></td>                              
                </tr>
                 <tr>
                    <td colspan="2">15</td>
                    <td><?=lang('address')?></td> 
                    <td><?=$rec->r_address?></td>                           
                </tr>
            </table>
        </div>
    </div>
</div>   
<div class="col-sm-12 hidden-print">
            <a href="#" style="float: right; margin-left: 5px;"  class="btn btn-fill btn-info" id="member_detail"><?=lang('print')?></a>
</div><!-- /.col-sm-6 -->
    <?php
        }
     ?>

<script type="text/javascript">  
function loadAjax() {
    //document.getElementById('result').innerHTML = '';
    openModal();       
    var xhr = false;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xhr) {;
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                closeModal();
                document.getElementById("result").innerHTML = xhr.responseText;
            }
        }
        //xhr.open("POST", "<?=base_url()?>", true); 
        xhr.send(null);
    }
}
/*$("#btn_next1").click(function() {   
         $('#tab1').removeClass('active'); 
         $('#address_tab').addClass('active'); 
    }); */
     
  $("#member_detail").click(function() {
        
        window.print();
    });
                                      
     $("#btn_prv1").click(function() {
        $("#a_personal").click();
        
    }); 
   $("#btn_prv2").click(function() {
        $("#a_personal").click();
        
    }); 
    $(document).ready(function () {
            
         $('#date_of_birth').val($('#dob_h').val());     
    });
</script>