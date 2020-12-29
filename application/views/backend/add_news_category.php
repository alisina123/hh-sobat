 <?=$this->session->flashdata('msg');?>
<center><h3><?=lang('add_news_category')?></h3></center>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('backend/addNewsCategory')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="name_en"><?=lang('name_en')?></label>
      <input type="text" class="form-control"  name="name_en" id="name_en" required placeholder="<?=lang('name_en')?>">
      <?=form_error('name_en');?>
    </div>  
    <div class="form-group">
      <label for="name_dr"><?=lang('name_dr')?></label>
      <input type="text" class="form-control"  name="name_dr" id="name_dr" required placeholder="<?=lang('name_dr')?>">
      <?=form_error('name_dr');?>
    </div>
    <div class="form-group">
      <label for="name_pa"><?=lang('name_pa')?></label>
      <input type="text" class="form-control"  name="name_pa" id="name_pa" required placeholder="<?=lang('name_pa')?>">
      <?=form_error('name_pa');?>
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