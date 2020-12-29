 <?=$this->session->flashdata('msg');?>
<?php
     if($record)
     {  
         $record=$record[0];
         $title='title_'.shortlang();
         $content='description_'.shortlang();
         $image=base_url('uploads/img/announcement/'.$record->photo);
     
 ?>
 <center><h3><?=lang('add_new_announcement')?></h3></center>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/updateAnnouncement/'.$record->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="title"><?=lang('title')?></label>
      <input type="text" class="form-control" value="<?=$record->$title?>"  name="title" id="title" required placeholder="<?=lang('title')?>">
      <?=form_error('title');?>
    </div>
     
    <div class="form-group">   
      <label for="date"><?=lang('date')?></label>
         <?php
             $date=datecheck($record->date,false)
         ?>
        <input type="hidden" class="form-control" value="<?=$date?>"   name="" id="date_h">
       
      <input type="text" class="form-control dates"   name="date" id="date" placeholder="<?=lang('date')?>">
      <?=form_error('date');?>
    </div> 
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
      <input type="file" class="form-control"  name="photo" id="photo" placeholder="<?=lang('photo')?>">
      <?=form_error('photo');?>
    </div>
    
     <div class="form-group">
      <label for="content"><?=lang('content')?></label>
      <textarea class="form-control ckeditor" rows="6"  name="content" id="editor1" required style="max-width: 100%;"><?=$record->$content?></textarea>
      <?=form_error('content');?>
    </div> 
    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
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
}   //for not available image
   function epic(c) {
    c.onerror='';
    c.src='<?php echo base_url().'assets/img/not_available.jpg'?>';
};

   function view(img) {
      imgsrc = img.src.split("_")[0];
      viewwin = window.open(imgsrc,'#modal_image');    
   }
    $(document).ready(function () {
            
         $('#date').val($('#date_h').val());     
    });
</script>