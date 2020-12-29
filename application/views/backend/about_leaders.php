<?=$this->session->flashdata('msg')?>                                                                   
  <div class="row">  
        <a href="#" style="float: right; margin-left: 5px; margin-right: 5px;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend/addPersonalInformation')?>'"><?=lang('add_personal_information')?></a>
        <a href="#" style="float: right;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend/addPublishBook')?>'"><i class="fa fa-book"></i><?=lang('add_publish_book')?></a>
    
    </div><!-- /.row --> 
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
                    <th><?=lang('photo')?></th> 
                    <th><?=lang('name')?></th> 
                    <th><?=lang('lastname')?></th>         
                    <th><?=lang('fname')?></th>   
                    <th><?=lang('detail')?></th> 
                </thead>
                <tbody>
                    <?php             
                    $counter=0;
                    foreach($record AS $rec)
                    {
                        $image=base_url('uploads/img/aboutus/'.$rec->photo);
                    ?>
                    <tr>                        
                        <td><?=++$counter?></td>
                        <td><img src="<?=$image?>" class="img-boss" alt=""></td>
                        <td><?=$rec->name?></td> 
                        <td><?=$rec->lastname?></td>  
                        <td><?=$rec->fname?></td>  
                                      
                        <td><a href="<?=site_url('backend/leaderDetail/'.$rec->id)?>"><?=lang('detail')?></a></td> 
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