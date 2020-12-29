<?=$this->session->flashdata('msg')?>                                                                   
  <div class="row">  
        <a href="#" style="float: right;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend/addWeekNews')?>'"><i class="fa fa-book"></i><?=lang('add_weeknews')?></a>
    
    </div><!-- /.row --> 
  <?php
  if($record)
  {
       $title='title_'.shortlang();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="company-item table-responsive table-full-width ulist">
            <table class="table table-hover table-striped">
                <thead>        
                    <th>#</th> 
                    <th><?=lang('title')?></th>      
                    <th><?=lang('date')?></th>   
                    
                </thead>
                <tbody>
                    <?php             
                    $counter=0;
                    foreach($record AS $rec)
                    {
                       
                    ?>
                    <tr>                        
                        <td><?=++$counter?></td>
                        <td><?=$rec->$title?></td>  
                         <td><?=datecheck($rec->date,false)?></td>  
                         <input type="hidden" id="delete_url" value="<?=site_url('backend/deleteDownload')?>"> 
     
                        <td> <a onclick="delete_record(<?=$rec->id?>)"  class="btn  btn-small btn-danger btn-xs" ><span class="fa fa-trash"></span></a>
                        </td> 
                        
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
          if (confirm("Do you want to delete it!"))
          {
          
              window.location.href = url +'/'+ id;
          }
      } 
  </script>