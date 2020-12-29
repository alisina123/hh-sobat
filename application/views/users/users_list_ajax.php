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
                    <th><?=lang('username')?></th> 
                    <th><?=lang('role')?></th> 
                    <th><?=lang('status')?></th> 
                    <th><?=lang('last_login')?></th> 
                    <th><?=lang('edit')?></th> 
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
                        <td><?=$rec->username?></td> 
                        <td>
                        <?php
                        if($rec->role ==1)
                        {
                            echo lang('admin');
                        }
                        elseif($rec->role==2)
                        {
                            echo lang('staff');;
                        }
                        else
                        {
                            echo lang('patient');
                        }
                        ?>
                        </td> 
                        <td>
                        <?php
                        if($rec->active ==1)
                        {
                            echo '<div class="alert-success fade in">'.lang('active').'</div>';
                        }
                        else
                        {
                            echo '<div class="alert-danger fade in">'.lang('inactive').'</div>';
                        }
                        ?>
                        </td>     
                        <td>
                         <?php
                             $post_date='';
                             $date='';
                             if(shortlang()!='en')
                             {
                                $post_date = explode('-', date('Y-m-d',$rec->lastLogin));
                                $date_conv = $this->dateconverter->GregorianToJalali($post_date[0], $post_date[1], $post_date[2]);
                                $date= $date_conv[0] . '-' . $date_conv[1] . '-' . $date_conv[2];
                             }
                             else{
                                 $date = date('Y-m-d',$rec->lastLogin);
                             }
                        echo $date;
                        ?>
                        </td>
                        <td><a href="<?=site_url('users/updateUser/'.$rec->id.'/'.$rec->pid)?>"><?=lang('edit')?></a></td> 
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
