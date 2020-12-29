<?=$this->session->flashdata('msg');?>
     <!--persian-datepicker Begannig-->                                                    
 <div class="header">
    <center><h4 class="title"><?=lang('add_publish_book')?></h4></center>
</div>                                                                    
<form method="POST" action="<?=site_url('backend/addWeekNews')?>" enctype="multipart/form-data" onsubmit="javascript: void(0);loadAjax();">
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
    
    <div class="col-sm-6">
        <div class="form-group">
            <label for="book_file"><?=lang('book_file').' PDF '?><i class="fa fa-file-pdf-o"></i></label>
            <input type="file" class="form-control rq" required  name="book_file" id="book_file" placeholder="<?=lang('book_file')?>">
            <?=form_error('book_file');?>
        </div>
    </div>
    
    <div class="padding-top-20">                  
      <button type="submit" class="btn btn-fill btn-info"><?=lang('save')?></button>
    </div>
  </form>
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

    $('#username').on('blur change',function(e){
        val = $('#username').val();
        if(val != '') {
         $.ajax({
                url: '<?=site_url('users/checkUsername')?>',
                type: 'POST',
                data:'&username='+val,
                success: function(r)
                {
                    //console.log(r);
                    $('#r_div').html(r);
                }
            });
        }
    });
     var UIToastr = function () {
    return {
        //main function to initiate the module
        init: function () {

            var i = -1,
                toastCount = 0,
                $toastlast   
            $('#save').click(function () {
                   toastr.options = {
                          "closeButton": true,
                          "debug": false,
                          "positionClass": "<?=shortlang()=='en'?"toast-top-right":"toast-top-left"?>", // toast-top-right,toast-top-left ,toast-top-center,toast-top-full-width
                          "onclick": null,
                          "showDuration": "1000",
                          "hideDuration": "1000",
                          "timeOut": "5000",
                          "extendedTimeOut": "1000",
                          "showEasing": "swing",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                    };
                    
                pass = $('#password').val();
                rpass = $('#rpassword').val();
                if( pass =='' || rpass =='')
                {    
                    var shortCutFunction = 'error'; //infor/warning/error,success
                    var msg = '<?=lang('password').' '.lang('or').' '.lang('rpassword').' '.lang('is'). ' '.lang('empty')?>';
                    var title = '';  
                    var toastIndex = toastCount++;   
                                    
                }
                 else
                {
                    if(pass != rpass)
                    {
                        var shortCutFunction = 'warning'; //infor/warning/error
                        var msg = '<?=lang('password').' '.lang('and').' '.lang('rpassword').' '.lang('not'). ' '.lang('match')?>';
                        var title = '';  
                        var toastIndex = toastCount++;   
                           
                        
                    }
                    else
                    {
                        return true;
                    }
                }
                $("#toastrOptions").text("Command: toastr[" + shortCutFunction + "](\"" + msg + (title ? "\", \"" + title : '') + "\")\n\ntoastr.options = " + JSON.stringify(toastr.options, null, 2));
                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
                $toastlast = $toast;  
                return false;    
            });    
        }   
    };

}();
</script>