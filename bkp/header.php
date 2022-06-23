<header>
		<style>
		#menuwrapper {
  position: relative;
}

#menuwrapper ul {
  height:500px;
  overflow-x: hidden;
  overflow-y: auto;
  scrollbar-width:none
}

#menuwrapper ul li {
  position: static !important;
  cursor:pointer;
  padding-right: 10px;
  list-style: none;
}

#menuwrapper ul li:hover,
#menuwrapper ul li.iehover{
    position:relative;
}
#menuwrapper ul li ul{
    position:absolute;
    display:none;
}
#menuwrapper ul li:hover ul,
#menuwrapper ul li.iehover ul{
    left:248px;
    top:77px;
    display:block;
	height: auto;
}


	.navbar-nav li:hover > ul.dropdown-menu {
    display: block;
}

/* rotate caret on hover */
.dropdown-menu > li > a:hover:after {
    text-decoration: underline;
    transform: rotate(-90deg);
}
.dropdown-menu.w-100.mt-0.mega-menu {
	top: 75% !important;
}

.mega-submenu {
	list-style-type: none;
	margin-left: 30px;
	display: none;
}

.mega-submenu li a {
	color: inherit;
	border-bottom: 1px solid gray;
	margin-bottom: 5px;
}

</style>
			




			<div class="header_top" id="home">
				<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background:#fdf5f3!important;">
					<a class="navbar-brand" href="<?php echo $siteurl; ?>">
						<img src="images/logo.png" width="70" alt="Soror The Edit" /></a>
					<button class="navbar-toggler navbar-toggler-right mx-auto" style="margin-right:1px!important" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
				   </button>


					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item <?php if(basename($_SERVER['SCRIPT_NAME'])=='index.php'){ echo "active"; } ?>">
								<a class="nav-link" href="<?php echo $siteurl; ?>">Home
									<span class="sr-only">(current)</span>
								</a>
							</li>
							 <li class="nav-item dropdown <?php if(basename($_SERVER['SCRIPT_NAME'])=='blog.php'){ echo "active"; }?>">
                <a class="nav-link dropdown-toggle" href="blogs" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">Blogs</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                   <div id="menuwrapper">
			<ul>
				<?php $sqlcat=mysqli_query($con,"SELECT id,name FROM blog_categories where status=1 and parent_id=0 order by display_order asc");
					while($resultcat=mysqli_fetch_array($sqlcat)){ 
					$sqlsubcat=mysqli_query($con,"SELECT id,name FROM blog_categories where status=1 and parent_id='".$resultcat['id']."' order by display_order asc");
					$subcatnum=mysqli_num_rows($sqlsubcat);
					 ?>
			<li <?php if($subcatnum>0){ ?>class="dropdown-submenu"<?php } ?>><a class="dropdown-item <?php if($subcatnum>0){ ?>dropdown-toggle<?php } ?>" href="category/<?php echo buildURL($resultcat['name']).'/'.$resultcat['id']; ?>"><?php echo $resultcat['name']; ?></a>
			<?php if($subcatnum>0){ ?>
			<ul class="dropdown-menu">
			<?php while($resultsubcat=mysqli_fetch_array($sqlsubcat)){ ?>
                            <li><a class="dropdown-item" href="category/<?php echo buildURL($resultsubcat['name']).'/'.$resultsubcat['id']; ?>"><?php echo $resultsubcat['name']; ?></a></li>
							<div class="dropdown-divider"></div>
							<?php } ?>
							</ul>
							<?php } ?>
							</li>
							<div class="dropdown-divider"></div>
			<?php } ?>
					
			</ul></div>
                    
                </ul>
            </li>

			 <!-- Navbar dropdown -->
			 <li class="nav-item dropdown dropdown-hover position-static">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-mdb-toggle="dropdown" aria-expanded="false">
           Blogs
          </a>
          <!-- Dropdown menu -->
          <div class="dropdown-menu w-100 mt-0 mega-menu" aria-labelledby="navbarDropdown" style="border-top-left-radius: 0;
                  border-top-right-radius: 0;
                ">

            <div class="container">
              <div class="row my-4">
				<?php
				 $sqlcat=mysqli_query($con,"SELECT id,name FROM blog_categories where status=1 and parent_id=0 order by display_order asc");
				 while($resultcat=mysqli_fetch_array($sqlcat))
				 { 
					$sqlsubcat=mysqli_query($con,"SELECT id,name FROM blog_categories where status=1 and parent_id='".$resultcat['id']."' order by display_order asc");
					$subcatnum=mysqli_num_rows($sqlsubcat);
				?>
				<div class="col-md-6 col-lg-3 col-xs-12 mb-3 mb-lg-0">
					<div class="list-group list-group-flush">
						<?php if($subcatnum ==0): ?>
						<a href="category/<?php echo buildURL($resultcat['name']).'/'.$resultcat['id']; ?>" class="list-group-item list-group-item-action"><?php echo $resultcat['name']; ?></a>
						<?php 
						else:
							?>
							<div class="megamenu-dropdown">
							<a href="category/<?php echo buildURL($resultcat['name']).'/'.$resultcat['id']; ?>" class="list-group-item list-group-item-action dropdown-toggle"><?php echo $resultcat['name']; ?></a>
							<ul class="mega-submenu">
							<?php while($resultsubcat=mysqli_fetch_array($sqlsubcat)){ ?>
								<li>
									<a href="category/<?php echo buildURL($resultsubcat['name']).'/'.$resultsubcat['id']; ?>"><?php echo $resultsubcat['name']; ?></a>
								</li>
							<?php } ?>
							</ul>
							</div>
							<?php
						endif;
						?>
					</div>
                </div>
				<?php
				 }
				?>
              </div>
            </div>
          </div>
        </li>
							<li class="nav-item <?php if(basename($_SERVER['SCRIPT_NAME'])=='about.php'){ echo "active"; }?>">
								<a class="nav-link" href="about-soror-the-sisters-edit">About</a>
							</li>
							<li class="nav-item <?php if(basename($_SERVER['SCRIPT_NAME'])=='merchant.php'){ echo "active"; }?>">
								<a class="nav-link" href="blog-with-us">Blog with us</a>
							</li>
							<li class="nav-item <?php if(basename($_SERVER['SCRIPT_NAME'])=='shop.php'){ echo "active"; }?>">
								<a class="nav-link" href="events">Events</a>
							</li>
							
							<li class="nav-item <?php if(basename($_SERVER['SCRIPT_NAME'])=='contact.php'){ echo "active"; } ?>">
								<a class="nav-link" href="contact">Contact</a>
							</li>

						</ul>
						
							<ul class="navbar-nav ml-auto right-nav">
							<li class="search-li">
								<form action="search.php" id="headersearchfrm" method="post" class="form-inline my-2 my-lg-0 header-search" name="form">
								<input class="form-control mr-sm-2 header-search-box" type="search" id="search_box" placeholder="Search here..." required name="search[keyword]">
								<button class="btn btn1 my-2 my-sm-0" id="searchdeact" style="margin-left: 250px;"><i class="fas fa-search"></i></button>
								<button class="btn btn1 my-2 my-sm-0" type="submit" name="submit" id="searchbtn" onclick="searchit()" style="float:right; display:none"><i class="fas fa-search"></i></button>
							</form>
							</li>
							<li class="nav-item dropdown">
							 <?php $userprofile=mysqli_query($con,"SELECT * FROM `membership_users` WHERE id='".$_SESSION['user_id']."'"); 
						$userprofileresult=mysqli_fetch_array($userprofile); 
						?>
                           
								<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
								    aria-expanded="false">
									<?php if($userprofileresult['photo']==''){ ?>
                                <i class="far fa-user" style="border-radius: 50%; width: 40px; height: 40px; border: 2px solid #ddd; text-align: center; padding-top: 10px; margin-top: -10px;"></i>
								<?php }else{ ?>
								<img src="upload-images/user/thumb/<?php echo $userprofileresult['photo']; ?>" style="border-radius:50%; width: 40px; height: 40px; margin-top: -10px; border: 2px solid #ddd;" >
								<?php } ?>
								  &nbsp;<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=''){ echo ""; }else{ echo "Log in"; } ?>
								</a>
								<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=''){ ?>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?php echo $adminurl.'my-profile.php'; ?>" target="_blank">My Account</a>
									<a class="dropdown-item" href="<?php echo $adminurl.'logout.php'; ?>">Sign Out</a>
								</div>
								<?php }else{ ?>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" data-toggle="modal" data-target=".loginmodal" id="loginclick">Log In</a>
									<a class="dropdown-item" href="blog-with-us">Sign Up</a>
								</div>
								<?php } ?>
							</li>
							</ul>

					</div>
				</nav>

			</div>
	</header>