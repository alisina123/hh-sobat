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
                    <th><?=lang('name')?></th>        
                    <th><?=lang('boss')?></th>     
                    <th><?=lang('edit')?></th> 
                </thead>
                <tbody>
                    <?php
                    $counter = $start;
                    $name='name_'.shortlang();                
                    foreach($record AS $rec)
                    {
                    ?>
                    <tr>
                        <td><?=++$counter?></td>
                        <td><?=$rec->$name?></td>                      
                        <td><?=$rec->boss_name?></td> 
                        <td><a href="<?=site_url('backend/updateProPresidency/'.$rec->id)?>"><?=lang('edit')?></a></td> 
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
