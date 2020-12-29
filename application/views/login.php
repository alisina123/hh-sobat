<?=$this->session->flashdata('msg')?>

<div class="header">
    <center><h4 class="title"><?=lang('please_login')?></h4></center>
</div>                                                                    
  <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
       
            <form method="POST" action="<?=site_url('main/login')?>" onsubmit="javascript: void(0);loadAjax();">
                <div class="form-group">
                    <label for="username"><?=lang('username')?></label>
                    <input type="text" class="form-control"  name="username" id="username">
                   <span style="color: red"> <?=form_error('username');?>
               </div><!-- /.form-group -->

                <div class="form-group">
                    <label for="password"><?=lang('password')?></label>
                    <input type="password" class="form-control" name="password" id="password">
                    <span style="color: red"><?=form_error('password');?></span>
                </div><!-- /.form-group -->

                <div class="checkbox">
                   
                    <a href="<?=base_url('users/forgotPassword')?>" class="link-not-important pull-right"><?=lang('forgot_password')?></a>
                </div><!-- /.checkbox -->

                <div class="form-group">
                    <button type="submit" class="btn  btn-block btn-fill btn-info"><?=lang('login')?></button>
                </div><!-- /.form-group -->

                <hr>
                                  
                    
            </form>
        </div><!-- /.col-sm-4 -->
    </div><!-- /.row --> 
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