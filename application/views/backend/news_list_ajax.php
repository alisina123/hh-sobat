<?php
  if($record)
  {
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-wrapper-responsive table-responsive table-full-width nlist">
            <table class="table table-hover table-striped">
                <thead>       
                    <th>#</th> 
                    <th><?=lang('title')?></th> 
                    <th><?=lang('category')?></th> 
                    <th><?=lang('post_date')?></th>     
                    <th><?=lang('views')?></th>     
                    <th><?=lang('edit')?></th> 
                    <th><?=lang('delete')?></th> 
                    
                </thead>
                <tbody>
                    <?php
                    $counter = $start;
                    $title='title_'.shortlang();     
                    foreach($record AS $rec)
                    {    
                    ?>
                    <tr>
                        <td><?=++$counter?></td>
                        <td><?=$rec->$title?></td>   
                        <td><?=$rec->catgory_name?></td>               
                        <td><?=datecheck($rec->post_date,false)?></td> 
                        <td><?=$rec->views?></td>
                        <td><a href="<?=site_url('backend/updateNews/'.$rec->id)?>"><?=lang('edit')?></a></td> 
                        <input type="hidden" id="delete_url" value="<?=site_url('backend/deleteNews')?>"> 
       
                        <td> <a onclick="delete_record(<?=$rec->id?>)"  class="btn  btn-small btn-danger" ><?=lang('delete')?></a>
                       </td> 
                                                       
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div  class="col-md-12 col-sm-12 col-xs-12 pgn"><?=@$pagination?></div>
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
        function delete_record(id)
        {                                          
            var url=document.getElementById('delete_url').value;
            if (confirm("معلومات حذف شود"))
            {
            
                window.location.href = url +'/'+ id;
            }
        } 
    </script>
