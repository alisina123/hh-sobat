 <?=$this->session->flashdata('msg');?>
<?php
     if($record)
     {
         $record=$record[0];
         $title='title_'.shortlang();
         $content='content_'.shortlang();
 ?>
 <center><h3><?=lang('update_rule')?></h3></center>
     <!-- BEGIN FORM-->
     <form method="POST" action="<?=site_url('backend/updateRule/'.$record->id)?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div id="rule">
             <div class="form-group">
                  <label for="title"><?=lang('title')?></label>
                  <input type="text" class="form-control" value="<?=$record->$title?>"  name="title" id="title" required placeholder="<?=lang('title')?>">
                  <?=form_error('title');?>
            </div>   
             <div class="form-group">
              <label for="content"><?=lang('content')?></label>
              <textarea class="ckeditor form-control" name="content" rows="5" id="editor1" required style="max-width: 100%;"><?=$record->$content?></textarea>
              <?=form_error('content');?>
            </div>
             
         </div>
        <br>
        
        <div class="padding-top-20">                  
          <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
        </div>
        
      </form>
 <?php
     }
  ?>
      <!-- END FORM--> 
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