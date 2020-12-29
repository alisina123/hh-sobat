
<?=$this->session->flashdata('msg');?>
<?php
      if($record)
    {     
 ?>
 <center><h3><?=lang('sending_message')?></h3></center>
   <form method="POST" action="<?=site_url('backend/sendingMessage')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
     
    <div class="form-group">
          <label for="message"><?=lang('message')?></label>
          <textarea class="form-control ckeditor" rows="8" name="message" id="editor1"  required style="max-width: 100%;"></textarea>
          <?=form_error('message');?>
     </div>
    <div class="checkbox">
            <label><input type="radio" name="members" checked="checked" value="1" id="to_all"><b style="font-size: large;"><?=lang('to_all')?></b></label>
    </div><!-- /.checkbox -->
    <div class="checkbox">
            <label><input type="radio" name="members" value="2" id="to_specific"><b style="font-size: large;"><?=lang('to_specific')?></b></label>
    </div><!-- /.checkbox -->
      <div class="col-sm-12">  
           <div class="form-group"> 
             <br>
             <button type="submit" id="save" class="btn btn-fill btn-info"><?=lang('save')?></button>
          </div><!-- /.form-group -->  
     </div>
<div id="to_all_div" style="display: none;"> 
<?php
foreach($record AS $rec)
{
    $photo=base_url('uploads/img/member/'.$rec->photo)
?>                                                 
<div class="col-md-4 col-sm-4 col-xs-12">

          <h5><input type="checkbox" style="" name="apply<?=$rec->id?>" id="apply<?=$rec->id?>" value="<?=$rec->id?>"><?=' '?></input><img src="<?=$photo?>" class="img-boss" alt="" onClick="view(this);" onerror='epic(this)'><?=' '.$rec->name.' , '.$rec->lastname?></</h5>                                                
</div>         




  <!-- END FORM--> 
<?php
}
 ?> 
</div>
 </form>
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

 $('input:radio[name="members"]').change(function () {
    if ($(this).val() == '2') 
    {          
          $('#to_all_div').show();
    }            
    else
    {
          $('#to_all_div').hide();
    }
     
});
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