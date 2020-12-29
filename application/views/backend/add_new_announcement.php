 <?=$this->session->flashdata('msg');?>
<center><h3><?=lang('add_new_announcement')?></h3></center>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/addNewAnnouncement')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="title"><?=lang('title')?></label>
      <input type="text" class="form-control"  name="title" id="title" required placeholder="<?=lang('title')?>">
      <?=form_error('title');?>
    </div> 
    <div class="col-sm-12">
        <div class="col-sm-6">
                <div class="form-group">
          <label for="date"><?=lang('date')?></label>
          <input type="text" class="form-control dates"  name="date" id="date" placeholder="<?=lang('date')?>">
          <?=form_error('date');?>
        </div>
    </div>
     <div class="col-sm-6">
        <div class="form-group">
          <label for="photo"><?=lang('photo')?></label>
          <input type="file" class="form-control"  name="photo" id="photo" placeholder="<?=lang('photo')?>">
          <?=form_error('photo');?>
        </div>
    </div>
    </div>
    
     <div class="form-group">
      <label for="content"><?=lang('content')?></label>
      <textarea class="ckeditor form-control" rows="5"  name="content" id="editor1" required style="max-width: 100%;"></textarea>
      <?=form_error('content');?>
    </div> 
    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
    </div>
  </form>
  <!-- END FORM-->
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