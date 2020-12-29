 <?=$this->session->flashdata('msg');?>
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
            
    ?>

     <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="personal" class="active" id="tab1">
                    <a href="#personal" aria-controls="personal" id="a_personal" role="tab" data-toggle="tab">
                        <strong><?=lang('personal')?></strong>  
                    </a>
                </li>

                <li role="company" id="address_tab" id="tab2">
                    <a href="#company" aria-controls="company" id="a_company"   role="tab" data-toggle="tab">
                        <strong><?=lang('address')?></strong>     
                    </a>
                </li>
                <li role="introduced_by">
                    <a href="#introduced_by" aria-controls="introduced_by" id="a_introduced_by" role="tab" data-toggle="tab">
                        <strong><?=lang('introduced_by')?></strong>     
                    </a>
                </li>
            </ul>       
           <form method="POST" action="<?=site_url('backend/updateMember/'.$rec->m_id.'/'.$rec->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
     
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="personal">
                     <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="name"><?=lang('name')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->name?>"  name="name" id="name" placeholder="<?=lang('name')?>" required>
                                        <?=form_error('name');?>
                                   </div><!-- /.form-group -->  
                                </div>
                                 <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="lastname"><?=lang('lastname')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->lastname?>"  name="lastname" id="lastname" placeholder="<?=lang('lastname')?>">
                                        <?=form_error('lastname');?>
                                   </div><!-- /.form-group -->  
                                </div>
                             </div>
                             <div class="col-sm-12">
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="fname"><?=lang('fname')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->fname?>"  name="fname" id="fname" placeholder="<?=lang('fname')?>" required>
                                        <?=form_error('fname');?>
                                   </div><!-- /.form-group -->  
                                </div>
                                 <div class="col-sm-6">
                                   <div class="form-group">
                                         <label for="photo"><?=lang('gender')?></label>
                                        <select class="form-control" name="gender" required>
                                          <option value="male" <?php if($rec->gender =='male'){echo 'selected="selected"';} ?>><?=lang('male')?></option>
                                          <option value="female"  <?php if($rec->gender =='female'){echo 'selected="selected"';} ?>><?=lang('female')?></option> 
                                        </select>
                                      <?=form_error('gender');?>
                                   </div><!-- /.form-group -->  
                                </div>
                             </div>
                            
                             <div class="col-sm-12">
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="tribe"><?=lang('tribe')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->tribe?>"  name="tribe" id="tribe" placeholder="<?=lang('tribe')?>" required>
                                        <?=form_error('tribe');?>
                                   </div><!-- /.form-group --> 
                                 </div>
                                   <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="date_of_birth"><?=lang('date_of_birth')?></label>
                                            <?php
                                                 $date=datecheck($rec->date_of_birth,false)
                                             ?>
                                            <input type="hidden" class="form-control" value="<?=$date?>"   name="" id="dob_h">
                                            <input type="text" class="form-control rq dates" value="<?=$date?>"   name="date_of_birth" id="date_of_birth" required placeholder="<?=lang('date_of_birth')?>">
                                          <?=form_error('date_of_birth');?>
                                        </div>
                                 </div>
                             </div>
                              <div class="col-sm-12">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                            <label for="level_of_education"><?=lang('level_of_education')?></label>
                                            <input type="text" class="form-control rq" value="<?=$rec->level_of_education?>"  name="level_of_education" id="level_of_education" placeholder="<?=lang('level_of_education')?>">
                                            <?=form_error('level_of_education');?>
                                       </div><!-- /.form-group -->  
                                    </div>
                                     <div class="col-sm-6">
                                       <div class="form-group">
                                            <label for="field_of_education"><?=lang('field_of_education')?></label>
                                            <input type="text" class="form-control rq" value="<?=$rec->field_of_education?>"  name="field_of_education" id="field_of_education" placeholder="<?=lang('field_of_education')?>">
                                            <?=form_error('field_of_education');?>
                                       </div><!-- /.form-group -->  
                                    </div>
                                 </div>
                                 <div class="col-sm-12">
                                    <div class="col-sm-6">
                                       <div class="form-group">
                                            <label for="job"><?=lang('job')?></label>
                                            <input type="text" class="form-control rq" value="<?=$rec->job?>"  name="job" id="job" placeholder="<?=lang('job')?>">
                                            <?=form_error('job');?>
                                       </div><!-- /.form-group -->  
                                    </div>
                                     <div class="col-sm-6">
                                      <div class="form-group">
                                            <label for="marital_status"><?=lang('marital_status')?></label>
                                            <input type="text" class="form-control rq" value="<?=$rec->marital_status?>"  name="marital_status" id="marital_status" placeholder="<?=lang('marital_status')?>" required>
                                            <?=form_error('marital_status');?>
                                       </div><!-- /.form-group -->   
                                    </div>
                                 </div>
                                 <div class="col-sm-12">
                                   
                                     <div class="col-sm-6">
                                      <div class="form-group">
                                            <label for="tazkira_number"><?=lang('tazkira_number')?></label>
                                            <input type="text" class="form-control rq" value="<?=$rec->tazkira_number?>"  name="tazkira_number" id="tazkira_number" placeholder="<?=lang('tazkira_number')?>" required>
                                            <?=form_error('tazkira_number');?>
                                       </div><!-- /.form-group -->   
                                    </div>
                                   <div class="col-sm-6">
                                   <div class="form-group">
                                         <label for="status"><?=lang('status')?></label>
                                        <select class="form-control" name="status" required>
                                          <option value="1" <?php if($rec->status ==1){echo 'selected="selected"';} ?>><?=lang('requested')?></option>
                                          <option value="2"  <?php if($rec->status ==2){echo 'selected="selected"';} ?>><?=lang('member')?></option> 
                                        </select>
                                      <?=form_error('gender');?>
                                   </div><!-- /.form-group -->  
                                </div>
                                 </div>
                                      <div class="col-sm-12">
                                      <div class="col-sm-6">      
                                            <div class="form-group">
                                                <label for="phone_number"><?=lang('phone_number')?></label>
                                                <input type="text" class="form-control rq" value="<?=$rec->phone_number?>" required  name="phone_number" id="phone_number" placeholder="<?=lang('phone_number')?>">
                                              <?=form_error('phone_number');?>
                                            </div>  
                                     </div>
                                     <div class="col-sm-6">
                                      <div class="form-group">
                                            <label for="email"><?=lang('email')?></label>
                                            <input type="email" class="form-control rq" value="<?=$rec->email?>"  name="email" id="email" placeholder="<?=lang('email')?>" required>
                                            <?=form_error('email');?>
                                       </div><!-- /.form-group -->   
                                    </div>
                                 </div>
                                 <div class="col-sm-12">  
                                       <div class="form-group"> 
                                            <div class="checkbox">
                                                <label><input type="checkbox" checked="checked"  required> <?=lang('term_of_policy')?></label>
                                            </div><!-- /.checkbox --> 
                                       </div>
                                  </div>
                                   <div class="col-sm-12">   
                                         <button type="button" id="btn_next1" class="btn btn-fill btn-info"><?=lang('next')?></button>
                                 </div>
                                  
                    </div><!-- /.row -->
                                   
                </div><!-- /.tab-pane -->

                <div role="tabpanel" class="tab-pane" id="company">  
                      <div class="row">
                        <div class="col-sm-6">
                         <h3><?=lang('permanent_address')?></h3> 
                         <hr>
                        
                             <div class="form-group">
                                <label for="province"><?=lang('province')?></label>
                                 <input type="hidden" name="permanent_address_id" value="<?=$permanent->address_id?>">
                                <input type="text" class="form-control rq" value="<?=$permanent->province?>"  name="province" id="province" placeholder="<?=lang('province')?>" required>
                                <?=form_error('province');?>
                           </div><!-- /.form-group -->  

                            <div class="form-group">
                                <label for="district"><?=lang('district')?></label>
                                <input type="text" class="form-control rq" value="<?=$permanent->district?>"  name="district" id="district" placeholder="<?=lang('district')?>" required>
                                <?=form_error('district');?>
                           </div><!-- /.form-group --> 

                            <div class="form-group">
                                <label for="village"><?=lang('village')?></label>
                                <input type="text" class="form-control rq" value="<?=$permanent->village?>"  name="village" id="village" placeholder="<?=lang('village')?>" required>
                                <?=form_error('village');?>
                           </div><!-- /.form-group -->  

                         
                        </div><!-- /.col-* -->

                        <div class="col-sm-6">
                        <h3><?=lang('current_address')?></h3> 
                        <hr>
                            <div class="form-group">
                                <label for="current_province"><?=lang('current_province')?></label>
                                <input type="hidden" name="current_address_id" value="<?=$current->address_id?>">
                                <input type="text" class="form-control rq" value="<?=$current->province?>"  name="current_province" id="current_province" placeholder="<?=lang('current_province')?>" required>
                                <?=form_error('current_province');?>
                           </div><!-- /.form-group --> 

                            <div class="form-group">
                                <label for="current_district"><?=lang('current_district')?></label>
                                <input type="text" class="form-control rq" value="<?=$current->district?>"  name="current_district" id="current_district" placeholder="<?=lang('current_district')?>" required>
                                <?=form_error('current_district');?>
                           </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="current_village"><?=lang('current_village')?></label>
                                <input type="text" class="form-control rq" value="<?=$current->village?>"  name="current_village" id="current_village" placeholder="<?=lang('current_village')?>" required>
                                <?=form_error('current_village');?>
                           </div><!-- /.form-group -->  
                          
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
                         <div class="col-sm-12">   
                                         <button type="button" id="btn_next2" class="btn btn-fill btn-info"><?=lang('next')?></button>
                                         <button type="button" id="btn_prv1" class="btn btn-fill btn-info"><?=lang('previous')?></button>
                         </div>
                    
                </div><!-- /.tab-pane -->
                <div role="tabpanel" class="tab-pane" id="introduced_by">
                    <div class="row">
                           <div class="col-sm-12">
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="recommender_name"><?=lang('recommender_name')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->r_name?>"  name="recommender_name" id="recommender_name" placeholder="<?=lang('recommender_name')?>" required>
                                        <?=form_error('recommender_name');?>
                                   </div><!-- /.form-group -->  
                                </div>
                                 <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="recommender_fname"><?=lang('recommender_fname')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->r_fname?>"  name="recommender_fname" id="recommender_fname" placeholder="<?=lang('recommender_fname')?>">
                                        <?=form_error('recommender_fname');?>
                                   </div><!-- /.form-group -->  
                                </div>
                             </div>
                             <div class="col-sm-12">
                                <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="recommender_job"><?=lang('recommender_job')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->r_job?>"  name="recommender_job" id="recommender_job" placeholder="<?=lang('recommender_job')?>" required>
                                        <?=form_error('recommender_job');?>
                                   </div><!-- /.form-group -->  
                                </div>
                                 <div class="col-sm-6">
                                   <div class="form-group">
                                        <label for="recommender_address"><?=lang('recommender_address')?></label>
                                        <input type="text" class="form-control rq" value="<?=$rec->r_address?>"  name="recommender_address" id="recommender_address" placeholder="<?=lang('recommender_address')?>">
                                        <?=form_error('recommender_address');?>
                                   </div><!-- /.form-group -->  
                                </div>
                             </div>
                              <div class="col-sm-12">  
                                   <div class="form-group"> 
                                        <div class="checkbox">
                                            <label><input type="checkbox" checked="checked"  required> <?=lang('term_of_policy_recommender')?></label>
                                        </div><!-- /.checkbox --> 
                                   </div>
                              </div>
                          
                    </div><!-- /.row -->

                      <div class="col-sm-12">  
                           <div class="form-group"> 
                             <br>
                             <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
                             <button type="Button" id="btn_prv2" class="btn btn-fill btn-info"><?=lang('previous')?></button>
                           </div><!-- /.form-group -->  
                     </div>
                </div><!-- /.tab-pane -->
               
            </div><!-- /.tab-content -->
             </form>
        </div><!-- /.col-* -->
    </div><!-- /.row -->  
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
    if (xhr) {
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
     
  $("#btn_next1").click(function() {
        
        $("#a_company").click();
    });
   $("#btn_next2").click(function() {
        $("#a_introduced_by").click();
    });                                    
     $("#btn_prv1").click(function() {
        $("#a_personal").click();
        
    }); 
   $("#btn_prv2").click(function() {
        $("#a_company").click();
        
    }); 
       $(document).ready(function () {
            
         $('#date_of_birth').val($('#dob_h').val());     
    });
</script>