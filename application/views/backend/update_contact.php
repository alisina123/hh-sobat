
<script src="<?=base_url()?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<?=$this->session->flashdata('msg');?>
<?php
    if($record)
    {
        $record=$record[0];
?>
   

               
 <a data-toggle="modal" href="#large"  class="btn btn-fill btn-info"><?=lang('reply')?></a>


    <!-- /.modal -->
    <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        
            <div class="modal-content">
              <form method="POST" action="<?=site_url('backend/updateContact/'.$record->id)?>" enctype="multipart/form-data">
                   
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="<?=base_url()?>assets/img/remove-icon.png" alt=""></button>
                    <center><h4 class="modal-title"><?=lang('reply')?></h4></center>
                </div>
                <div class="modal-body">
                           <div class="form-group">
                              <label for="to"><?=lang('to')?></label>
                              <input type="email" class="form-control" name="to" id="to" value="<?=$record->email?>" required placeholder="<?=lang('email')?>">
                              <?=form_error('email');?>
                            </div>
                        <div class="form-group">
                              <label for="message"><?=lang('message')?></label>
                              <textarea class="form-control ckeditor" rows="8" name="message" id="editor1"  required style="max-width: 100%;"></textarea>
                              <?=form_error('message');?>
                         </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-fill btn-info" data-dismiss="modal" style="float: <?=shortlang()=='en'?'left':''?>;"><?=lang('cancel')?></button>
                    <button type="submit" class="btn btn-fill btn-info" style="float: <?=shortlang()=='en'?'left':'right'?>;">Save</button>
                </div>
            </div>
             </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
                        
                        
 <form method="POST" action="<?=site_url('backend/updateContact/'.$record->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="name"><?=lang('name')?></label>
      <input type="text" class="form-control"  name="name" id="name" value="<?=$record->name?>" required placeholder="<?=lang('name')?>">
      <?=form_error('name');?>
    </div>
    <div class="form-group">
      <label for="email"><?=lang('email')?></label>
      <input type="email" class="form-control" name="email" id="email" value="<?=$record->email?>" required placeholder="<?=lang('email')?>">
      <?=form_error('email');?>
    </div>
    <div class="form-group">
      <label for="message"><?=lang('message')?></label>
      <textarea class="form-control" rows="8" name="message" id="message"  required style="max-width: 100%;"><?=$record->message?></textarea>
      <?=form_error('message');?>
    </div>
    <div class="form-group">
         <?php
            if($reply)
            {   $counter=0;
                foreach($reply AS $reply)
                { $counter++;
         ?>  
           <div class="col-sm-12">          
                <div class="">
                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption" style="float:<?=shortlang()=='en'?'left':'right'?>">
                                <?=lang('reply').': '.$counter?>
                            </div>
                            <div class="tools" style="float:<?=shortlang()=='en'?'right':'left'?>">
                                <a href="javascript:;" class="collapse">
                                </a>
                               
                            </div>
                        </div>
                        <div class="portlet-body" style="background-color:#f5f5f0">
                            <div class="table-scrollable">
                                <div class="col-sm-12">
                                          <div class="form-group">
                                              <label for="date"><?=lang('date')?></label>
                                                  <?php       
                                                         $post_date='';
                                                         $date='';
                                                         if(shortlang()!='en')
                                                         {
                                                            $post_date = explode('-', date('Y-m-d',$reply->reply_date));
                                                            $date_conv = $this->dateconverter->GregorianToJalali($post_date[0], $post_date[1], $post_date[2]);
                                                            $date= $date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
                                                         }
                                                         else{
                                                             $date = date('Y-m-d',$reply->reply_date);
                                                         }      
                                                    ?>
                                                    
                                              <input type="text" class="form-control" name="date" id="date" value="<?=$date?>" required placeholder="<?=lang('date')?>">
                                              <?=form_error('date');?>
                                            </div>  
                                                                               <div class="form-group">
                                          <label for="message"><?=lang('message')?></label>
                                          <textarea class="form-control" rows="6" name="message" id="message"  required style="max-width: 100%;"><?=$reply->message?></textarea>
                                          <?=form_error('message');?>
                                        </div>
                               
                             </div>   
                            </div>
                        </div>
                    </div>
                    <!-- END SAMPLE TABLE PORTLET-->
                </div>
                
            </div>
         <?php
                }
            }
         ?>
    </div>
  </form>
  <!-- END FORM--> 

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
</script>