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
                <button class="btn btn-fill btn-info" onclick="makeSearch('<?=site_url("backend/newsList")?>','SearchForm','searchResult');" type="button"><i class="fa fa-search"></i><?=lang('search')?></button>
            </div> 
        </div> 
    </div>
     <?php
     }
     ?>                                       
          <div class="col-sm-6">
            <a href="#" style="float: right; margin-left: 5px;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend/addNewsCategory')?>'"><?=lang('add_news_category')?></a>   
            <a href="#" style="float: right; margin-left: 5px;"  class="btn btn-fill btn-info" onclick="location.href='<?=site_url('backend/addNewNews')?>'"><?=lang('add_new_news')?></a>
        </div><!-- /.col-sm-6 --> 
                      
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

