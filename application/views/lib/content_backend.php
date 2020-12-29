
    <div class="main-wrapper">
        <div class="main">
            <div class="container">   
                <div class="row">
                       <div class="col-md-3 col-sm-3 col-xs-12" style="float: <?=shortlang()=='en'?'left':'right'?>;">
                           <?=$sidebar?>                   
                      </div><!-- /.col-* -->   
                      <div class="col-md-9 col-sm-9 col-xs-12" style="background-color: #E8E8E8 ;">
                            <!-- Content -->
                            <div class="content"> 
                                <div id="result"><!-- Results are displayed here -->
                                     <?=$content?>          
                                </div>   
                                <div id="fade">
                                     <div id="modal">   
                                        <img id="loader" src="<?=base_url()?>assets/gif/loader2.gif" />
                                    </div>
                                </div>       
                            </div>
                            <!-- Content --> 
                     </div>
                </div> 
            </div><!-- /.container -->
        </div><!-- /.main -->
    </div><!-- /.main-wrapper -->