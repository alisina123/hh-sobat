 <?=$this->session->flashdata('msg');?>

 <h3><?=lang('contact_us')?></h3>
 <!-- BEGIN FORM-->
 <form method="POST" action="<?=site_url('main/contactUs')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
    <div class="form-group">
      <label for="name"><?=lang('name')?></label>
      <input type="text" class="form-control"  name="name" id="name" required placeholder="<?=lang('name')?>">
      <?=form_error('name');?>
    </div>
    <div class="form-group">
      <label for="email"><?=lang('email')?></label>
      <input type="email" class="form-control" name="email" id="email" required placeholder="<?=lang('email')?>">
      <?=form_error('email');?>
    </div>
    <div class="form-group">
      <label for="message"><?=lang('message')?></label>
      <textarea class="form-control" rows="8" name="message" id="message" required style="max-width: 100%;"></textarea>
      <?=form_error('message');?>
    </div>
    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('send')?></button>
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