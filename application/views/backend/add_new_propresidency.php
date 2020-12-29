 <?=$this->session->flashdata('msg');?>
<center><h3><?=lang('add_new_presidency')?></h3></center>
<div>
    <div>
     <!-- BEGIN FORM-->
     <form method="POST" action="<?=site_url('backend/addNewProPresidency')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
        <div class="form-group">
          <label for="name"><?=lang('name')?></label>
          <input type="text" class="form-control"  name="name" id="name" required placeholder="<?=lang('name')?>">
          <?=form_error('name');?>
        </div>
        <div class="form-group">
          <label for="description"><?=lang('description')?></label>
          <textarea class="form-control ckeditor" rows="6"  name="description" id="editor1" required style="max-width: 100%;"></textarea>
          <?=form_error('description');?>
        </div>
       <div class="col-sm-12">
        <div class="col-sm-6">
            <div class="form-group">
              <label for="boss"><?=lang('boss')?></label>
              <input type="text" class="form-control" name="boss" id="boss" required placeholder="<?=lang('boss')?>">
              <?=form_error('boss');?>
            </div>  
        
        </div>
        <div class="col-sm-6">
            <div class="form-group">
              <label for="boss_photo"><?=lang('boss_photo')?></label>
              <input type="file" class="form-control" name="boss_photo" id="boss_photo" required placeholder="<?=lang('boss_photo')?>">
              <?=form_error('boss_photo');?>
            </div>
        </div>
       </div>
     
        <div class="padding-top-20">                  
          <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
        </div>
      </form>
      <!-- END FORM--> 
    </div>
</div>
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