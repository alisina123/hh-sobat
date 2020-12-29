 <?=$this->session->flashdata('msg');?>
<?php
     if($record)
     {  
         $record=$record[0];
         $name='name_'.shortlang();
         $address='address_'.shortlang();
         $description='description_'.shortlang();
         $image=base_url('uploads/img/organization/'.$record->photo);
 ?>
 <div class="header">
    <center><h4 class="title"><?=lang('update_organization')?></h4></center>
</div>                                                                    
<div class="row">
     <form method="POST" action="<?=site_url('backend/updateOrganization/'.$record->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div class="col-sm-12">   
               <div class="form-group">
                    <label for="name"><?=lang('name')?></label>
                    <input type="text" class="form-control rq" value="<?=$record->$name?>"  name="name" id="name" placeholder="<?=lang('name')?>">
                    <?=form_error('name');?>
               </div><!-- /.form-group --> 
         </div>
         
         
         <div class="col-sm-12">   
                <div class="form-group">
                 <div class="row">
                         <div class="col-sm-3"  style="float:<?=shortlang()=='en'?'left':'right'?>;">
                            <div>
                                  <img src="<?=$image?>" onClick="view(this);" onerror='epic(this)'  class="img-responsive img-profile user-img">
                            </div>  
                        </div>
                 </div> 
                    <label for="photo"><?=lang('change_photo')?></label> 
                    <input type="hidden" name="pr_photo" value="<?=$record->photo?>">
                    <input type="file" class="form-control rq"  name="photo" id="photo">
                      <?=form_error('photo');?>
                </div><!-- /.form-group --> 
             
         </div>
         <div class="col-sm-12">
                 <div class="col-sm-6">
                      <div class="form-group">
                            <label for="facebook_link"><?=lang('facebook_link')?></label> 
                            <input type="text" class="form-control rq" value="<?=$record->facebook_link?>"  name="facebook_link" id="facebook_link" placeholder="<?=lang('facebook_link')?>">
                              <?=form_error('facebook_link');?>
                        </div><!-- /.form-group --> 
                 </div>
                   <div class="col-sm-6">
                        <div class="form-group">
                            <label for="address"><?=lang('address')?></label>
                            <input type="text" class="form-control rq" value="<?=$record->$address?>"   name="address" id="address" required placeholder="<?=lang('address')?>">
                          <?=form_error('address');?>
                        </div>
                 </div>
         </div>
           <div class="col-sm-12">    
                <div class="form-group">
                    <label for="description"><?=lang('description')?></label>
                      <textarea class="form-control ckeditor" rows="5"  name="description" id="editor1" required style="max-width: 100%;"><?=$record->$description?></textarea>
                 <?=form_error('description');?>
                </div>  
         </div>
         
          <div class="col-sm-12">  
               <div class="form-group"> 
                 <br>
                 <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
                 <button type="Button" class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend')?>'"><?=lang('back')?></button>
               </div><!-- /.form-group -->  
         </div>

            </form>
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
  //for not available image
   function epic(c) {
    c.onerror='';
    c.src='<?php echo base_url().'assets/img/not_available.jpg'?>';
};

   function view(img) {
      imgsrc = img.src.split("_")[0];
      viewwin = window.open(imgsrc,'#modal_image');    
   }
    
</script>