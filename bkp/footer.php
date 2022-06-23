<!-- subscribe modal start-->
<div class="subscribe-bottom">
   <button type="button" class="subscribe-bottom-btn" data-toggle="modal" data-target=".subscribemodal">Subscribe</button>
   </div>

<div class="modal fade subscribemodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:25%">
    <div class="modal-dialog modal-lg modal-custom-width">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two:900,900italic,800,800italic,700,700italic,600,600italic,500,500italic,400,400italic,300,300italic,200,200italic,100,100italic" type="text/css" rel="stylesheet" />
        <div class="modal-content">
		<div class="modal-content" style=" background:url(images/foot.webp)">
	<div style="background:rgba(255,255,255,0.8)">
			<div class="modal-header-class">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>
                </button>
				</div><br />
            <div class="modal-body text-center">
			<div id="sub_content">
			<h6 style="line-height:30px; letter-spacing:"><span style="color:#782929; font-family:Shadows Into Light Two; font-weight: 600; font-size: 20px; font-style: italic;">
			Want to stay updated with what's happenings at SOROR?</span> <br />
			<span style="color:#000; font-family:Arial, Helvetica, sans-serif; text-transform: uppercase; font-size:0.7rem">Signup today for free and be the first to get notified on new updates.</span></h6>
              <form action="subscribe.php" id="subscribe_popform" method="post" enctype="multipart/form-data">
  <input type="hidden" name="subs_path" class="form-control bg-white" value="<?php echo $domain.$_SERVER['REQUEST_URI']; ?>"><br />
  <input type="text" name="subs_name" class="form-control bg-white" placeholder="Enter Full Name" required><br />
  <input type="email" name="subs_email" class="form-control bg-white" placeholder="Enter email ID" id="email" required><br />
  <button type="submit" class="form-control btn-theme-light" id="subdscribebtnpop">Subscribe</button>
  <button class="form-control btn-theme-light" id="subdscribebtnloaderpop" style="display:none" disabled="disabled">Loading...</button>
</form></div>
<div id="subscribe_results" style="width:100%; font-size:16px;"></div>
<br />   
<h6>We respect your privacy. No spam ever!</h6>
            </div>
			</div>
			</div>
        </div>
    </div>
</div>
<!-- subscribe modal ends-->
<!--footer-->
	<div style="background:url(images/foot.webp)">
	<footer style="background:rgba(255,255,255,0.7); margin-top:-50px; padding-top:50px">
	
		<div class="search_section">
			<div class="row">
				<div class="col-lg-4 footer-grid-agileits-w3ls text-left" style="max-width:28.7333%!important">
					<h3>Quick Links</h3>
					<ul class="list-group">
					<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="about-soror-the-sisters-edit">About Us</a>
			</li>
			<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="contact">Contact Us</a>
			</li>
			<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="blogs">Blogs</a>
			</li>
			<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="events">Events</a>
			</li>
			<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="blog-with-us">Blog With Us</a>
			</li>
			<!--<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="faq.php">FAQs</a>-->
			</li>
			<li class="d-flex justify-content-between align-items-center quick-links">
			<a href="terms-and-condition">Terms & Conditions</a>
			</li>
			</ul>
				</div>
				<div class="col-lg-5 footer-grid-agileits-w3ls text-left">

						<h2>Join The Soror Community</h2>
					<div class="text-center">
									<form action="subscribe.php" id="subscribe_form" method="post" enctype="multipart/form-data">
									<input type="hidden" name="subs_path" class="form-control bg-white" value="<?php echo $domain.$_SERVER['REQUEST_URI']; ?>"><br />
									<input type="text" name="subs_name" class="form-control bg-white" placeholder="Enter Full Name" required><br />
  <input type="email" name="subs_email" class="form-control bg-white" placeholder="Enter email ID" id="email" required><br />
  <button type="submit" class="form-control btn-theme-light" id="subdscribebtn">Subscribe</button>
  <button class="form-control btn-theme-light" id="subdscribebtnloader" style="display:none" disabled="disabled">Loading...</button>
</form>
						
<div id="submit_results" style="width:100%; font-size:16px;"></div>
<br />   
<h6>We respect your privacy. No spam ever!</h6>
					</div>

				</div>
				<!-- subscribe -->
				<div class="col-lg-3 subscribe-main footer-grid-agileits-w3ls text-left">
					<h2>Our Mailing Address</h2>
					<div class="subscribe-main text-left">
					<ul class="list-group">
					<li class="d-flex align-items-left quick-links">
			<strong>Email:</strong> &nbsp;info@sororedit.com
			</li>
			</ul>	
			
					</div>
					<!-- //subscribe -->
				</div>
			</div>
			<!-- footer -->
			<div class="footer-cpy text-center">
				<div class="footer-social">
					<div class="copyrighttop">
						<ul>
							<li class="mx-3">
								<a class="facebook" target="_blank" href="<?php getlinks("links","facebook");?>">
									<i class="fab fa-facebook-f"></i>
									<span>Facebook</span>
								</a>
							</li>
							<li>
								<a class="facebook" target="_blank" href="<?php getlinks("links","twitter");?>">
									<i class="fab fa-twitter"></i>
									<span>Twitter</span>
								</a>
							</li>
							<li class="mx-3">
								<a class="facebook" target="_blank" href="<?php getlinks("links","googleplus");?>">
									<i class="fab fa-instagram"></i>
									<span>Instagram</span>
								</a>
							</li>
							<li>
								<a class="facebook" target="_blank" href="<?php getlinks("links","pinterest");?>">
									<i class="fab fa-pinterest-p"></i>
									<span>Pinterest</span>
								</a>
							</li>
							<li>
								<a class="facebook" target="_blank" href="https://www.youtube.com/channel/UC_guZIAqHyyajmAKL6I90lA">
								  &nbsp; <i class="fab fa-youtube"></i>
									<span>YouTube</span>
								</a>
							</li>
						</ul>

					</div>
				</div>
				<div class="w3layouts-agile-copyrightbottom">
					<p> Copyrights <?php $current=date("Y"); print_r($current);?> | Soror - The Sisters Edit</p>

				</div>
			</div>
			<!-- //footer -->
		</div>
	</footer>
   <div class="social">
    <ul>
      <li><a href="<?php getlinks("links","facebook");?>" target="_blank"><i class="fab fa-facebook-f"></i><b>Facebook</b></a></li>
      <li><a href="<?php getlinks("links","twitter");?>" target="_blank"><i class="fab fa-twitter"></i><b>Twitter</b></a></li>
      <li><a href="<?php getlinks("links","pinterest");?>" target="_blank"><i class="fab fa-pinterest-p"></i><b>Pinterest</b></a></li>
      <li><a href="<?php getlinks("links","googleplus");?>" target="_blank"><i class="fab fa-instagram"></i><b>Instagram</b></a></li>
    </ul>
   </div>
   
   
  <!-- login modal start-->
   <div id="loginmodal" class="modal loginmodal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="top:25%;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style=" background:url(images/foot.webp)">
	<div style="background:rgba(255,255,255,0.8)">
      <div class="modal-header-class">
        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
      </div><br />
      <div class="modal-body">
	   <?php if(isset($_SESSION['login_sess']) && $_SESSION['login_sess']=='Error'){ ?><div class="row"><div class="col-md-3"></div>
	  <div class="col-md-8 text-center text-danger">Incorrect Email ID or password.<br /><br /></div></div><?php } ?>
      <form action="login.php" method="post" id="login_form" enctype="multipart/form-data">
	  <input type="hidden" name="pageurl" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-8" align="left">
                                        <!--<input type="email" class="form-control" id="inputEmail3" placeholder="Email" required="">-->
										<input type="email" name="email" class="form-control" id="username" placeholder="Email" required>
                                    </div>
                                </div>
								<div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-8" align="left">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3 text-right"></div>
									<div class="col-sm-8 text-right">
										<button type="submit" class="form-control btn btn-theme-light" id="loginbtn">Login</button>
  <button class="form-control btn-theme-light" id="loginbtnloader" style="display:none" disabled="disabled">Loading...</button>
                                    </div>
                                </div>
								<div id="login_results" style="width:100%; font-size:16px;"></div>
								<div class="form-group row">
                                    <div class="col-sm-3 text-right"></div>
									<div class="col-sm-8 text-center"><a href="forgot-password">Forgot Password?</a>
									</div></div>
                            </form>
      </div>
    </div>

  </div>
</div>
<!-- login modal ends-->

	<script src="js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript">
   $("#subscribe_form").submit(function(e){ 
    e.preventDefault();
	proceed = true;
	if(proceed){ 
		var post_url = $(this).attr("action"); //get form action url
		var request_method = $(this).attr("method"); //get form GET/POST method
		var form_data = new FormData(this); //Creates new FormData object

		$.ajax({ //ajax form submit
			url : post_url,
			type: request_method,
			data : form_data,
			dataType : "json",
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){

    $("#subdscribebtnloader").show();
	$("#subdscribebtn").hide();
   },
		}).done(function(res){ //fetch server "json" messages when done

			if(res.type == "error"){
				$("#subdscribebtnloader").hide();
				$("#subdscribebtn").show();
				$("#submit_results").html('<div class="error" style="color:#782929;">'+ res.text +"</div>");
			}

			if(res.type == "done"){
				$("#subdscribebtnloader").hide();
				$("#subdscribebtn").hide();
				$("#submit_results").html('<div class="success" style="color:#782929;">'+ res.text +"</div>");
			}
		});
	}
});


$("#subscribe_popform").submit(function(e){ 
    e.preventDefault();
	proceed = true;
	if(proceed){ 
		var post_url = $(this).attr("action"); //get form action url
		var request_method = $(this).attr("method"); //get form GET/POST method
		var form_data = new FormData(this); //Creates new FormData object

		$.ajax({ //ajax form submit
			url : post_url,
			type: request_method,
			data : form_data,
			dataType : "json",
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function(){

    $("#subdscribebtnloaderpop").show();
	$("#subdscribebtnpop").hide();
   },
		}).done(function(res){ //fetch server "json" messages when done

			if(res.type == "error"){
				$("#subdscribebtnloaderpop").hide();
				$("#subdscribebtnpop").show();
				$("#subscribe_results").html('<div class="error" style="color:#782929;">'+ res.text +"</div>");
			}

			if(res.type == "done"){
				$("#subdscribebtnloaderpop").hide();
				$("#subdscribebtnpop").hide();
				$("#sub_content").hide();
				$("#subscribe_results").html('<div class="success" style="color:#782929;">'+ res.text +"</div>");
			}
		});
	}
});
</script>
<!-- search start-->
<script type="text/javascript">

$(document).ready(function(){
	$("#search_box").hide();
	$("#searchdeact").click(function(){
		$("#searchdeact").show();
		$("#searchbtn").hide();
			$("#search_box").show();
			$("#search_box").focus();
		});

$("#searchhidebody").click(function(){
		$("#searchdeact").show();
		$("#searchbtn").hide();
		$("#search_box").hide();
		});
});	

function searchit(){
$('#headersearchfrm').submit();
}

$(document).ready(function(){
		$('input#search_box').on('keyup',function(){
		   var charCount = $(this).val().replace(/\s/g, '').length;
			if(charCount>2){
				 $("#searchdeact").hide();
				 $("#searchbtn").show();
			}
			if(charCount<=2){
				 $("#searchdeact").show();
				 $("#searchbtn").hide();
			}
		});

		$(document).on('mouseover','.dropdown',function(){
			$(this).find('.dropdown-menu').show();
		});

		$(document).on('mouseout','.dropdown',function(){
			$(this).find('.dropdown-menu').hide();
		});
		//megamenu-dropdown
		$(document).on('mouseover','.megamenu-dropdown',function(){
			$(this).find('.mega-submenu').show();
		});
		$(document).on('mouseout','.megamenu-dropdown',function(){
			$(this).find('.mega-submenu').hide();
		});
	});

</script>
<!-- search ends-->
 <script>  
        
             $('a.sharelink').click(function(e) {
               var type = $(this).data('type');
			   var dataid = $(this).data('id');
			   var name = $(this).data('name');
			   //alert(name);
               e.preventDefault();
               if(type == 'facebook'){
			   
			   $.ajax({
                       type: 'POST',
                       url:'share-count.php',
                       data:{type:type,dataid:dataid,name:name},
                         success:function(data)
                         {
						 window.location.href = "http://www.facebook.com/share.php?u=https://www.sororedit.com/"+name;
                       
							}
							});
                 } 
				 else if(type == 'twitter' ){
				 $.ajax({
                       type: 'POST',
                       url:'share-count.php',
                       data:{type:type,dataid:dataid,name:name},
                         success:function(data)
                         {
                    window.location.href ="http://www.twitter.com/share?url=https://www.sororedit.com/"+name;
					}
					});
               }else if(type == 'linkedin' ){
			   $.ajax({
                       type: 'POST',
                       url:'share-count.php',
                       data:{type:type,dataid:dataid,name:name},
                         success:function(data)
                         {
                    window.location.href = "https://www.linkedin.com/shareArticle?mini=true&url=https://www.sororedit.com/"+name;
;					}
					});
               }else if(type == 'whatsapp' ){
			   $.ajax({
                       type: 'POST',
                       url:'share-count.php',
                       data:{type:type,dataid:dataid,name:name},
                         success:function(data)
                         {
                    window.location.href = "https://api.whatsapp.com/send?text=https://www.sororedit.com/"+name;
					}
					});
                  } else if(type == 'like' ){
			   $.ajax({
                       type: 'POST',
                       url:'share-count.php',
                       data:{type:type,dataid:dataid,name:name},
                         success:function(data)
                         {
                  liked();
					}
					});
                  } 
             });
		  </script>

<?php  
if(isset($_SESSION['login_sess']) && $_SESSION['login_sess']=='Error'){ ?>
<script>
    $(window).on('load', function() {
        $('#loginmodal').modal('show');
    });
	
</script>
<?php }
unset($_SESSION['login_sess']); 
mysqli_close($con);
?>