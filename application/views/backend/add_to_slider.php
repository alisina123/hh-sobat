<!-- END PAGE LEVEL SCRIPTS -->
 <?=$this->session->flashdata('msg');?>
<center><h3><?=lang('add_to_slider')?></h3></center>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/addToSlider')?>"  enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="photo"><?=lang('photo')?></label><br> 
      <label for="photo"><?=lang('width').': '."980px".' '.lang('height').': '.'300px'?></label> 
     <br>
      <span style="color: red;"><?=lang('slider_note')?></span>
      <input type="file" class="form-control"  name="photo" id="photo" required>
      <?=form_error('photo');?>
    </div>    

    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
    </div>
  </form>
  <!-- END FORM--> 
  <?php
  if($record)
  {
?>
<div class="row">
    <div class="col-sm-12">
        <div class="company-item table-responsive table-full-width ulist">
            <table class="table table-hover table-striped">
                <thead>       
                    <th>#</th> 
                    <th><?=lang('Id')?></th> 
                </thead>
                <tbody> 
                    <?php
                    $counter = 0;
                    foreach($record AS $rec)
                    {
                      $image='';    
                      $image=base_url('uploads/img/slider/'.$rec->photo);
                      ?>   
                    <tr> 
                        <td><?=++$counter?></td>
                        <td><img src="<?=$image?>" alt="" width="15%" onClick="view(this);" onerror='epic(this)'></td> 
                        
                        </td>      
                       <input type="hidden" id="delete_url" value="<?=site_url('backend/deleteSlider')?>"> 
       
                 <td> <a onclick="delete_record(<?=$rec->id?>)"  class="btn  btn-small btn-danger" ><?=lang('delete')?></a>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
  }
  else
  {
      echo '<div  class="alert alert-danger fade in">'.lang('no_record_found').'</div>';
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
<script type="text/javascript">
        function delete_record(id)
        {                                          
            var url=document.getElementById('delete_url').value;
            if (confirm("معلومات حذف شود"))
            {
            
                window.location.href = url +'/'+ id;
            }
        } 
    </script>
