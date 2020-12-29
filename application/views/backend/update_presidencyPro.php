 <?=$this->session->flashdata('msg');?>
<?php
     if($record)
     {
         $record=$record[0];
         $name='name_'.shortlang();
         $description='description_'.shortlang();
         $photo=base_url('uploads/img/presidency/boss/'.$record->boss_photo);
 ?>
 <center><h3><?=lang('update_presidency')?></h3></center>
<div>
    <div>
     <!-- BEGIN FORM-->
     <form method="POST" action="<?=site_url('backend/updateProPresidency/'.$record->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div class="form-group">
          <label for="name"><?=lang('name')?></label>
          <input type="text" class="form-control" value="<?=$record->$name?>"  name="name" id="name" required placeholder="<?=lang('name')?>">
          <?=form_error('name');?>
        </div>
        <div class="form-group">
          <label for="description"><?=lang('description')?></label>
          <textarea class="form-control ckeditor" rows="6"  name="description" id="editor1" required style="max-width: 100%;"><?=$record->$description?></textarea>
          <?=form_error('description');?>
        </div>
        <div class="form-group">
          <label for="boss"><?=lang('boss')?></label>
          <input type="text" class="form-control" value="<?=$record->boss_name?>" name="boss" id="boss" required placeholder="<?=lang('boss')?>">
          <?=form_error('boss');?>
        </div>  
    
        <div class="form-group">
        <div class="row">
                 <div class="col-sm-3"  style="float:<?=shortlang()=='en'?'left':'right'?>;">
                    <div>
                          <img src="<?=$photo?>" onClick="view(this);" onerror='epic(this)'  class="img-responsive img-profile user-img">
                    </div>  
                </div>
         </div> 
          <label for="boss_photo"><?=lang('boss_photo')?></label>
          <input type="hidden" name="pr_photo" value="<?=$record->boss_photo?>">
          <input type="file" class="form-control" name="boss_photo" id="boss_photo" placeholder="<?=lang('boss_photo')?>">
          <?=form_error('boss_photo');?>
        </div>
     
        <div class="padding-top-20">                  
          <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
        </div>
      </form>
      <!-- END FORM--> 
    </div>
</div>
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