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
                    <th><?=lang('title')?></th> 
                    <th><?=lang('date')?></th>    
                    <th><?=lang('edit')?></th> 
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
                        <td><?=substr($rec->$title,0,50)?></td> 
                        <td><?=datecheck($rec->date,false)?></td>  
                        </td>   
                        <td><a href="<?=site_url('backend/updateAnnouncement/'.$rec->id)?>"><?=lang('edit')?></a></td> 
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
