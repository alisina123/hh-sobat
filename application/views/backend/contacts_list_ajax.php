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
                    <th><?=lang('email')?></th>         
                    <th><?=lang('date')?></th> 
                    <th><?=lang('message')?></th> 
                    <th><?=lang('detail')?></th> 
                </thead>
                <tbody>
                    <?php
                    $counter = $start;
                    foreach($record AS $rec)
                    {
                    ?>
                    <tr>
                        <td><?=++$counter?></td>
                        <td><?=$rec->name?></td> 
                        <td><?=$rec->email?></td>              
                        <td>
                        <?=datecheck($rec->message_date,false)?>
                        </td>  
                        <td><?=word_limiter($rec->message,10)?></td> 
                        <td><a href="<?=site_url('backend/updateContact/'.$rec->id)?>"><?=lang('detail')?></a></td> 
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
