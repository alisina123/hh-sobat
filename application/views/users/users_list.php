 <?=$this->session->flashdata('msg');?>
<form action="#" id="SearchForm" method="post">
<div class="row">
    <?php
     if($record)
     {
    ?>
    <!-- Search -->
    <div class="col-sm-6">                  
        <div class="form-group input-group">
            <input type="text" name="search" id="search" class="form-control" value="<?=$keyword?>" placeholder="<?=lang('search')?>..">
            <div class="input-group-btn">
                <button class="btn btn-fill btn-info" onclick="makeSearch('<?=site_url("users/usersList")?>','SearchForm','searchResult');" type="button"><?=lang('search')?></button>
            </div> 
        </div> 
    </div>
     <?php
     }
     ?>                                       
            <?php
                 if(getRole()==1)
                 {
             ?>
             <div class="col-sm-6">
                <a href="#" style="float: right;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('users/addNewUser')?>'"><?=lang('add_new_user')?></a>
            </div><!-- /.col-sm-6 --> 
             <?php
                 }
              ?>
                      
</div> 
</form>                               

<hr/>
<div class="ulist" id="searchResult">
<?=$list?>
</div>
<script>
    function makeSearch(url,formID,targetDiv)
    {   
        openModal();
        $.ajax({
            url     : url,
            type    : 'POST',
            dataType:'json',
            data    : $("#"+formID).serialize()+"&ajax=search",
            success : function(r){ 
                closeModal();
                $("#"+targetDiv).html(r.result);
            }
        });
    }
</script> 

