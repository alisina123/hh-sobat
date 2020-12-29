 <?=$this->session->flashdata('msg');?>
<?php
    $title ='title_'.shortlang();
    $content ='content_'.shortlang();
    $source ='source_'.shortlang();
    if($record)
    {
        $rec =$record[0]; 
        $image='';    
        $image=base_url('uploads/img/news/'.$rec->photo);
        
?>
<center><h3><?=lang('update_news')?></h3></center>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/updateNews/'.$rec->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="title"><?=lang('title')?></label>
      <input type="text" class="form-control"  name="title" id="title" value="<?=$rec->$title?>" required placeholder="<?=lang('title')?>">
      <?=form_error('title');?>
    </div> 
    <div class="form-group">
      <label for="title"><?=lang('category')?></label>
       <select class="form-control" name="category" required>
            <?php
                 if($news_category)
                 {  
                     $name='name_'.shortlang();   
                     foreach($news_category AS $cat)
                     {
                          $selected=''; 
                          if($cat->id==$rec->category_id)
                          {
                              $selected='selected'; 
                          }
             ?>
              <option value="<?=$cat->id?>" <?=$selected?>><?=$cat->$name?></option>
             <?php
                     }
                 }
             ?>
             
        </select>
      <?=form_error('category');?>
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
          <input type="hidden" name="pr_photo" value="<?=$rec->photo?>">
          <input type="file" class="form-control"  name="photo" id="photo" value="<?=$rec->photo?>" placeholder="<?=lang('photo')?>">
          <?=form_error('photo');?> 
    </div> 
     <div class="form-group">
      <label for="source"><?=lang('source')?></label>
      <input type="text" class="form-control"  name="source" id="source" value="<?=$rec->$source?>" placeholder="<?=lang('source')?>">
      <?=form_error('source');?>
    </div>
     <div class="form-group">
      <label for="content"><?=lang('content')?></label>
      <textarea class="form-control ckeditor" rows="6"  name="content" id="editor1"  required style="max-width: 100%;"><?=$rec->$content?></textarea>
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