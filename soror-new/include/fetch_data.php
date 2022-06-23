<?php 
function buildURL($url) {
$newurl = str_replace(" - ", " ", $url);

$myurl = str_replace("--", "-", str_replace("?", "", str_replace("!", "", str_replace("&", "", str_replace("%", "", str_replace(" ", "-", str_replace("-", " ", trim(str_replace("/", " ", str_replace(",", "", str_replace(".", "", $newurl)))))))))));

return stripslashes(strtolower($myurl));
}

function getShortContent($value) {
$value = stripslashes(trim($value));
    if (strlen($value) > 220) {
        $value = substr($value, 0, 20) . "...";

        return($value);
    }

    return($value);
}
function getFileVer($FileName) {
    return $FileName . '?v=' . filemtime($_SERVER['DOCUMENT_ROOT'] . "/" . $FileName);
    //return $FileName . '?v=' . filemtime($_SERVER['DOCUMENT_ROOT']);
}

function encryptString($text) {
    // Store the cipher method 
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121';

    // Store the encryption key 
    $encryption_key = "SoroR_Key20#21";

    // Use openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt($text, $ciphering, $encryption_key, $options, $encryption_iv);

    return $encryption;
}

function decryptString($enc_text) {
    // Store the cipher method 
    $ciphering = "AES-128-CTR";

    // Non-NULL Initialization Vector for decryption 
    $decryption_iv = '1234567891011121';

    // Use OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Store the decryption key 
    $decryption_key = "SoroR_Key20#21";

    // Use openssl_decrypt() function to decrypt the data 
    $plain = openssl_decrypt($enc_text, $ciphering, $decryption_key, $options, $decryption_iv);

    // Display the decrypted string 
    return $plain;
}
function getYouTubeVideo($url) {
    $a = explode('v=', $url);
    $b = explode('&', $a[1]);
    return ("https://www.youtube.com/embed/" . $b[0]);
}
function gettagline($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Tagline!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $tagline) {
      	# code...
			echo ''.$tagline['tagline'].'';
		}
	}

	mysqli_close($con);
}
function geticon($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no icon alert
		if ($rowcount==0) {
      		# code...
			echo 'NoIcon';
		}
      	//if there are rows available display all the results
		foreach ($result as $webicon => $icon) {
      	# code...
			echo ''.$icon['icon'].'';
		}
	}

	mysqli_close($con);
}
function getjavascripts($table){
require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no script alert
		if ($rowcount==0) {
      		# code...
			echo 'No script';
		}
      	//if there are rows available display all the results
		foreach ($result as $jsscripts => $js) {
      	# code...
			echo ''.$js['javascript'].'';
		}
	}

	mysqli_close($con);
}
function getsharingscript($table){
require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no script alert
		if ($rowcount==0) {
      		# code...
			echo 'No script';
		}
      	//if there are rows available display all the results
		foreach ($result as $sharingscript => $sharing) {
      	# code...
			echo ''.$sharing['sharing_script'].'';
		}
	}

	mysqli_close($con);
}
function getshortdescription($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Description!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $sdc) {
      	# code...
			echo ''.$sdc['short_description'].'';
		}
	}

	mysqli_close($con);
}
function getcontacts($table,$num){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Description!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $contacts) {
      	# code...num
			if ($num==1) {
				# code...
				echo ''.$contacts['address'].'';
			}
			elseif ($num==2) {
				# code...
				echo ''.$contacts['email'].'';
			}
			elseif ($num==3) {
				# code...
				echo ''.$contacts['phone'].'';
			}
			elseif ($num==4) {
				# code...
				echo ''.$contacts['googlemap'].'';
			}
		
		}
	}

	mysqli_close($con);
}
function getdetaileddescription($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Description!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $sdc) {
      	# code...
			echo ''.$sdc['detailed_description'].'';
		}
	}

	mysqli_close($con);
}
function countcategories(){
	require("database/db_connect.php");
	$sql="SELECT * FROM blog_categories where status=1 and parent_id=0 order by display_order";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Categories!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $categoriescount => $categorydata) {
				#count how many times each category appears in blogs
			$categoryid=$categorydata['id'];
			$sql="SELECT * FROM blogs WHERE category='$categoryid' and posted='publish' and (review_status!='Under Review' || review_status='')";
			if ($result=mysqli_query($con,$sql)) {
					# code...
				$rowcountcategory=mysqli_num_rows($result);
				$getcatcount=$rowcountcategory;
			}
					# code...show data
			echo '<li class="list-group-item d-flex justify-content-between align-items-center">
			<a href="category/'.buildURL($categorydata['name']).'/'.$categoryid.'" style="text-decoration:none; color:#000">'.$categorydata['name'].'</a>
			<span class="badge badge-success badge-pill">'.$rowcountcategory.'</span>
			</li>';
		}
	}

	mysqli_close($con);
}
function getbannertext($table,$position){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'Hello World!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $bannertext) {
      	# code...
			if ($position==1) {
					# code...
				echo ''.$bannertext['bannertext1'].'';
			}
			elseif ($position==2) {
					# code...
				echo ''.$bannertext['bannertext2'].'';
			}
			elseif ($position==3) {
					# code...
				echo ''.$bannertext['bannertext3'].'';
			}
			elseif ($position==4) {
					# code...
				echo ''.$bannertext['bannertext4'].'';
			}
		}
	}

	mysqli_close($con);
}
function getwebname($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Name!!';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $blogname) {
      	# code...
			echo ''.$blogname['website_name'].'';
		}
	}

	mysqli_close($con);
}
function getkeywords($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'Nothing';
		}
      	//if there are rows available display all the results
		foreach ($result as $titles => $keywords) {
      	# code...
			echo ''.$keywords['keywords'].'';
		}
	}

	mysqli_close($con);
}
function getlinks($table,$platform){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo '#';
		}
      	//if there are rows available display all the results
		foreach ($result as $link => $site) {
      	# code...
			if ($platform=="facebook") {
					# code...
				echo ''.$site['facebook'].'';
			}
			elseif ($platform=="twitter") {
					# code...
				echo ''.$site['twitter'].'';
			}
			elseif ($platform=="googleplus") {
					# code...
				echo ''.$site['googleplus'].'';
			}
			elseif ($platform=="pinterest") {
					# code...
				echo ''.$site['pinterest'].'';
			}
			elseif ($platform=="dribble") {
					# code...
				echo ''.$site['dribble'].'';
			}

		}
	}

	mysqli_close($con);
}
function getcategoriesmenu($table)
{
	require("database/db_connect.php");
	$sql="SELECT * FROM $table where status=1 order by display_order asc";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no categories alert
		if ($rowcount==0) {
      		# code...
			echo 'No Categories';
		}
      	//if there are rows available display all the results
		foreach ($result as $blog_categories => $category) {
      	# code...
			echo '<a class="dropdown-item" id="submenu" href="category/'.buildURL($category['name']).'/'.$category['id'].'">'.$category['name'].'</a>
			<div class="dropdown-divider"></div>';
		}
	}

	mysqli_close($con);
}
function getbottomsliderposts($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table WHERE posted='publish' and review_status!='Under Review' ORDER BY id DESC LIMIT 5";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No posts to fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $sliderposts => $slideritem) {
      	# code...fetch actual category from categories table
			$category_id=$slideritem['category'];
			$sql="SELECT * FROM blog_categories WHERE id='$category_id'";
			if ($result=mysqli_query($con,$sql))
			{
				foreach ($result as $results => $actualcategory) {
					$ctgry=$actualcategory['name'];
				}
			}
				#code...display the results
			echo '<li>
			<div class="blog-item">
			<img src="../upload-images/category/thumb/'.$slideritem['photo'].'" alt="image" class="img-fluid" style="width:450px;height:250px"/>
			<button type="button" class="btn btn-primary play">
			<a href="single.php?id='.$slideritem['id'].'" style="text-decoration:none;color:white"><i class="fas fa-eye"></i></a>
			</button>
			<div class="floods-text">
			<h3>'.$slideritem['title'].'
			<span>'.$ctgry.'
			<label>|</label>
			<i>'.$slideritem['author'].'</i>
			</span>
			</h3>

			</div>
			</div>
			</li>';
		}
	}

	mysqli_close($con);
}
function getbottomslidercategory($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table WHERE status=1 and parent_id=0 ORDER BY display_order";
	if ($result=mysqli_query($con,$sql))
	{
		$rowcount=mysqli_num_rows($result);
		if ($rowcount==0) {
			echo 'No posts to fetch';
		}
		foreach ($result as $sliderposts => $slideritem) {
		$sql=mysqli_query($con,"SELECT * FROM blogs WHERE category='".$slideritem['id']."' and posted='publish'");
		$resultcount=mysqli_num_rows($sql);

			echo '<li>
			<div class="blog-item zoomimage">
			<a href="category/'.buildURL($slideritem['name']).'/'.$slideritem['id'].'" style="text-decoration:none;color:white">';
			if (is_file("upload-images/category/thumb/".$slideritem['photo'])) {
                               echo '<img src="upload-images/category/thumb/'.$slideritem['photo'].'" alt="'.$slideritem['name'].'" class="img-fluid" style="width:375px;height:200px">';
                            } else { echo '<img src="images/noimage.png" alt="'.$slideritem['name'].'" class="img-fluid" style="width:375px;height:200px">'; }
			echo '<div class="floods-text">
			<h3>'.$slideritem['name'].'
			<label>|</label>
			<i class="badge badge-success badge-pill">'.$resultcount.'</i>
			</h3>
			</div>
			</a>
			</div>
			</li>';
		}
	}

	mysqli_close($con);
}
function getblogridposts($table){

	require("database/db_connect.php");
	$sql="SELECT * FROM $table WHERE posted='publish' and review_status!='Under Review' and category in(select id from blog_categories where showonhome=1) ORDER BY approval_date DESC LIMIT 9";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Posts To Fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $bloggrid => $griditem) {
      	# code...
			echo '<div class="col-md-4 blog-grid-top">
			<div class="">
			<div class="zoomimage">
			<a href="blog/'.buildURL($griditem['title']).'/'.$griditem['id'].'">';
			if (is_file("upload-images/blog/thumb/". $griditem['photo'])) {
                               echo '<img src="upload-images/blog/thumb/'.$griditem['photo'].'" class="img-fluid" alt="'.$griditem['title'].'" style="width:100%;height:220px">';
                            } else { echo '<img src="images/noimage.png" class="img-fluid" alt="'.$griditem['title'].'" style="width:100%;height:220px">'; }
			echo '<div class="mask" style="background-color: rgba(57, 192, 237, 0.2)"></div>
			</a>
			</div>
			<h3>
			<a href="blog/'.buildURL($griditem['title']).'/'.$griditem['id'].'">'.$griditem['title'].'</a>
			</h3>
			</div>
			<ul class="blog-icons">
			<li><a href="javascript:void(0)">'.date('Y-m-d',strtotime($griditem['approval_date'])).' | '.$griditem['author'].'</a>
			<!--<a href="#">
			<i class="far fa-clock"></i>'.date('Y-m-d',strtotime($griditem['approval_date'])).'</a>
			</li>
			<li class="mx-2">
			<a href="#">
			<i class="far fa-user"></i> '.$griditem['author'].'</a>
			</li>-->
			</ul>
<div class="row mt-3" align="center">
			<div style="width:30%">Share by</div>
			<div style="width:15%"><a class="sharelink" data-type="facebook" data-name="blog/'.buildURL($griditem['title']).'/'.$griditem['id'].'" data-id="'.$griditem['id'].'" target="_blank"   title="Facebook"><i class="fab fa-facebook-f sharefb"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="twitter"  data-name="blog/'.buildURL($griditem['title']).'/'.$griditem['id'].'" data-id="'.$griditem['id'].'" target="_blank" title="Twitter"><i class="fab fa-twitter sharetw"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="linkedin"  data-name="blog/'.buildURL($griditem['title']).'/'.$griditem['id'].'" data-id="'.$griditem['id'].'" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in shareli"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="whatsapp" data-name="blog/'.buildURL($griditem['title']).'/'.$griditem['id'].'"  data-id="'.$griditem['id'].'" data-action="share/whatsapp/share" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp sharewa"></i></a></div>
			
									</div>
									</div>';
		}
	}

	mysqli_close($con); 

}
function getolderposts($table){
	require("database/db_connect.php");
	$sql="SELECT *,$table.id FROM $table inner join page_hits on $table.id=page_hits.page_id WHERE posted='publish' and review_status!='Under Review' and category!=16 ORDER BY count desc LIMIT 8";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no posts alert
		if ($rowcount==0) {
      		# code...
			echo 'No Posts To Fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $olderposts => $op) {
      	# code...
			echo '<div class="blog-grids row mb-3">
			<div class="col-md-5 blog-grid-left">
			<a href="blog/'.buildURL($op['title']).'/'.$op['id'].'">';
			if (is_file("upload-images/blog/thumb/". $op['photo'])) {
                               echo '<img src="upload-images/blog/thumb/'.$op['photo'].'" class="img-popular" alt="'.$op['title'].'">';
                            } else { echo '<img src="images/noimage.png" class="img-popular" alt="'.$op['title'].'">'; }
							if($op['count']){ $count=$op['count']; }else{ $count=0; }
							$total_share=$op['fb_count']+$op['tw_count']+$op['wa_count']+$op['link_count'];
			if($op['approval_date']){ $posteddate= date('Y-m-d',strtotime($op['approval_date'])); 
											}else{ 
											$posteddate= date('Y-m-d',strtotime($op['date'])); }
			echo '</a>
			</div>
			<div class="col-md-7 blog-grid-right">

			<h5>
			<a href="blog/'.buildURL($op['title']).'/'.$op['id'].'">'.$op['title'].'</a>
			</h5>
			<div class="sub-meta">
			<span>
			<i class="far fa-clock" title="Posted Date"></i> '.$posteddate.' &nbsp; &nbsp; <i class="fas fa-eye" title="Views"></i> '.$count.' <!--&nbsp; &nbsp; <i class="fas fa-share-alt" title="Total Shares"></i> '.$total_share.'--></span>
			</div>
			</div>

			</div>';
		}
	}

	mysqli_close($con);
}
function getfour($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table where posted='publish' ORDER BY id DESC LIMIT 4";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no posts alert
		if ($rowcount==0) {
      		# code...
			echo 'No posts to fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $thefour => $fourdata) {
      	# code...
			echo '<li>
			<a href="upload-images/blog/thumb/'.$fourdata['photo'].'">
			<img src="upload-images/blog/thumb/'.$fourdata['photo'].'" alt="image" data-desoslide-caption="<h3>Latest Post '.$fourdata['id'].'</h3>">
			<div class="mid-text-info">
			<h4 style="height:40px;overflow:hidden;text-overflow:ellipsis">'.$fourdata['title'].'</h4>
			<p>'.$fourdata['author'].'</p>
			<div class="sub-meta">
			<span>
			<i class="far fa-clock"></i> '.$fourdata['date'].'</span>
			</div>
			</div>
			</a>
			</li>';
		}
	}

	mysqli_close($con);
}
function getonelatest($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ORDER BY id DESC LIMIT 1";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no posts alert
		if ($rowcount==0) {
      		# code...
			echo 'No posts to fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $onelatest => $onedata) {
      	# code...
			echo '<div class="blog-grid-top">
			<div class="b-grid-top">
			<div class="blog_info_left_grid">
			<a href="single.php?id='.$onedata['id'].'">
			<img src="upload-images/blog/thumb/'.$onedata['photo'].'" class="img-fluid" alt="image" style="width:900px;height:500px">
			</a>
			</div>
			<div class="blog-info-middle">
			<ul>
			<li>
			<a href="#">
			<i class="far fa-calendar-alt"></i> '.$onedata['date'].'</a>
			</li>
			<li class="mx-2">
			<a href="#">
			<i class="far fa-check"></i> '.$onedata['tags'].'</a>
			</li>
			<li>
			<a href="#">
			<i class="far fa-user"></i> '.$onedata['author'].'</a>
			</li>

			</ul>
			</div>
			</div>

			<h3>
			<a href="single.php?id='.$onedata['id'].'">'.$onedata['title'].'</a>
			</h3>
			<a href="single.php?id='.$onedata['id'].'" class="btn btn-primary read-m">Read More</a>
			</div>';
		}
	}

	mysqli_close($con);
}
function geteditorschoice($table){
	require("database/db_connect.php");
	$sql="SELECT * FROM $table ORDER BY id DESC LIMIT 8";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no posts alert
		if ($rowcount==0) {
      		# code...
			echo 'No Posts To Fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $edschoice => $choice) {
			#get actual blog post data
			$postid=$choice['blog'];
			$sql="SELECT * FROM blogs WHERE id='$postid'";
			if ($result=mysqli_query($con,$sql)) {
				# code...
				foreach ($result as $posts => $postdata) {
					# code...display actual posts
					echo '<li>
			<a href="upload-images/blog/thumb/'.$postdata['photo'].'">
			<img src="upload-images/blog/thumb/'.$postdata['photo'].'" alt="" data-desoslide-caption="<h3>Editors Choice '.$postdata['id'].'</h3>">
			<div class="mid-text-info">
			<h4 style="height:40px;overflow:hidden;text-overflow:ellipsis">'.$postdata['title'].'</h4>
			<p>'.$postdata['author'].'</p>
			<div class="sub-meta">
			<span>
			<i class="far fa-clock"></i> '.$postdata['date'].'</span>
			</div>
			</div>
			</a>
			</li>';
				}
			}
      	# code...
		}
	}

	mysqli_close($con);
}
function getcategoryblogs($table,$id){
	require("database/db_connect.php");
							$pagelimit=10;
							$start=($_REQUEST['page']-1)*$pagelimit;
							if($start<0){ $start=0; }
	$sql="SELECT *,$table.id FROM $table left join page_hits on $table.id=page_hits.page_id WHERE category='$id' and posted='publish' and (review_status!='Under Review' || review_status='') ORDER BY $table.id DESC LIMIT $start,$pagelimit";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No records found.';
		}
      	//if there are rows available display all the results
		foreach ($result as $categories => $cdata) {
			if($cdata['approval_date']){ $posteddate= date('Y-m-d',strtotime($cdata['approval_date'])); 
											}else{ 
											$posteddate= date('Y-m-d',strtotime($cdata['date'])); }
      	# code...
			echo '<div class="col-md-12 card mb-5">
			<div class="row" style="box-shadow:1px 1px 10px 1px #66666652">
			<div class="col-md-5 p-sm-0 pt-3 pb-1 zoomimage">
							<a href="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'">';
							if (is_file("upload-images/blog/thumb/". $cdata['photo'])) {
                               echo '<img src="upload-images/blog/thumb/'.$cdata['photo'].'" class="card-img-top img-fluid" alt="'.$cdata['title'].'" style="width:480px;height:250px">';
                            } else { echo '<img src="images/noimage.png" class="card-img-top img-fluid" alt="'.$cdata['title'].'" style="width:480px;height:250px">'; }
							$total_share=$cdata['fb_count']+$cdata['tw_count']+$cdata['wa_count']+$cdata['link_count'];
			echo '</a>
							</div>
							<div class="col-md-7 p-1">
							<div class="card-body">
								<ul class="blog-icons">
									<li>
										<a href="javascript:void(0)" title="Posted Date">
											<i class="far fa-calendar-alt"></i> '.$posteddate.'</a>
									</li>
									<li class="mx-2">
										<a href="javascript:void(0)" title="Author">
											<i class="far fa-user"></i> '.$cdata['author'].'</a>
									</li>
									<li class="mx-2">
										<a href="javascript:void(0)" title="View Count">
											<i class="fas fa-eye"></i> '.$cdata['count'].'</a>
									</li>
									<li class="mx-2">
										<a href="javascript:void(0)" title="Shares">
											<i class="fas fa-share-alt"></i> '.$total_share.'</a>
									</li>
								</ul>
								<h5 class="card-title ">
									<a href="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'">'.$cdata['title'].'</a>
								</h5>
								<a href="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" class="btn btn-primary read-m">Read More</a>
								<div class="row mt-3" align="center">
			<div style="width:30%">Share by</div>
			<div style="width:15%"><a class="sharelink" data-type="facebook" data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank"   title="Facebook"><i class="fab fa-facebook-f sharefb"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="twitter"  data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank" title="Twitter"><i class="fab fa-twitter sharetw"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="linkedin"  data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in shareli"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="whatsapp" data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'"  data-id="'.$cdata['id'].'" data-action="share/whatsapp/share" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp sharewa"></i></a></div>
			<!--<div style="width:15%"><a href="#" class="idmail" data-type="mail"  data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank" title="Gmail"><i class="far fa-envelope sharegmail"></i></a></div>-->
									</div>
							</div></div></div>
						</div>';
		}
	}
$qu=mysqli_query($con,"SELECT * FROM $table WHERE category='$id' and posted='publish' and (review_status!='Under Review' || review_status='')") or mysqli_error($con);
$row=mysqli_fetch_array($qu);
$rescount=mysqli_num_rows($qu);
$pages=ceil($rescount/$pagelimit);
	 echo '<ul class="pagination">
  <!--<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left"></i></a></li>-->';
  for($x=1; $x<=$pages; $x++){ 
  if($_REQUEST['page']==$x || ($_REQUEST['page']=='' && $x=='1')){ $active="active"; }else{ $active='';}
  echo '<li class="page-item '.$active;  echo '"><a class="page-link" href="'; if($x==1){ echo "category/".$_REQUEST['cat_slug'].'/'.$_REQUEST['id'];}else{ echo "category/pages/".$_REQUEST['cat_slug'].'/'.$_REQUEST['id'].'/'.$x; }; echo '">'.$x.'</a></li>';
  }
  echo '<!--<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a></li>-->
</ul> ';
	mysqli_close($con);
}
function getallblogs($table){
	require("database/db_connect.php");
							$pagelimit=10;
							$start=($_REQUEST['page']-1)*$pagelimit;
							if($start<0){ $start=0; }
							$sql="SELECT *,$table.id FROM $table left join page_hits on $table.id=page_hits.page_id WHERE posted='publish' and (review_status!='Under Review' || review_status!='') and category in(select id from blog_categories where showonhome=1) ORDER BY $table.id DESC LIMIT $start,$pagelimit";
							
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no news alert
		if ($rowcount==0) {
      		# code...
			echo 'No Blogs To Fetch';
		}
      	//if there are rows available display all the results
		foreach ($result as $categories => $cdata) {
			if($cdata['approval_date']){ $posteddate= date('Y-m-d',strtotime($cdata['approval_date'])); 
											}else{ 
											$posteddate= date('Y-m-d',strtotime($cdata['date'])); }
      	# code...
			echo '<div class="col-md-12 card mb-5">
			<div class="row" style="box-shadow:1px 1px 10px 1px #66666652">
			<div class="col-md-5 p-sm-0 pt-3 pb-1 zoomimage">
							<a href="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'">';
							if (is_file("upload-images/blog/thumb/". $cdata['photo'])) {
                               echo '<img src="upload-images/blog/thumb/'.$cdata['photo'].'" class="card-img-top img-fluid" alt="'.$cdata['title'].'" style="width:480px;height:250px">';
                            } else { echo '<img src="images/noimage.png" class="card-img-top img-fluid" alt="image" style="width:480px;height:250px">'; }
							$total_share=$cdata['fb_count']+$cdata['tw_count']+$cdata['wa_count']+$cdata['link_count'];
			echo '</a></div>
							<div class="col-md-7 p-1">
							<div class="card-body">
								<ul class="blog-icons">
									<li>
										<a href="javascript:void(0)" title="Posted date">
											<i class="far fa-calendar-alt"></i> '.$posteddate.'</a>
									</li>
									<li class="mx-2">
										<a href="javascript:void(0)" title="Author">
											<i class="far fa-user"></i> '.$cdata['author'].'</a>
									</li>
									<li class="mx-2">
										<a href="javascript:void(0)" title="Views Count">
											<i class="fas fa-eye"></i> '.$cdata['count'].'</a>
									</li>
									<li class="mx-2">
										<a href="javascript:void(0)" title="Shares">
											<i class="fas fa-share-alt"></i> '.$total_share.'</a>
									</li>
								</ul>
								<h5 class="card-title ">
									<a href="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'">'.$cdata['title'].'</a>
								</h5>
								<a href="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" class="btn btn-primary read-m">Read More</a>
								<div class="row mt-3" align="center">
			<div style="width:30%">Share by</div>
			<div style="width:15%"><a class="sharelink" data-type="facebook" data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank"   title="Facebook"><i class="fab fa-facebook-f sharefb"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="twitter"  data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank" title="Twitter"><i class="fab fa-twitter sharetw"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="linkedin"  data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'" data-id="'.$cdata['id'].'" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in shareli"></i></a></div>
			<div style="width:15%"><a class="sharelink" data-type="whatsapp" data-name="blog/'.buildURL($cdata['title']).'/'.$cdata['id'].'"  data-id="'.$cdata['id'].'" data-action="share/whatsapp/share" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp sharewa"></i></a></div>
			
									</div>
							</div></div></div>
						</div>';
		}
	}
$qu=mysqli_query($con,"SELECT count(*) FROM $table WHERE posted='publish' and (review_status!='Under Review' || review_status!='') and category!=16 ") or mysqli_error($con);
$row=mysqli_fetch_array($qu);
$rescount=$row['count(*)'];
$pages=ceil($rescount/$pagelimit);
	 echo '<ul class="pagination">
  <!--<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-left"></i></a></li>-->';
  for($x=1; $x<=$pages; $x++){ 
  if($_REQUEST['page']==$x || ($_REQUEST['page']=='' && $x=='1')){ $active="active"; }else{ $active='';}
  echo '<li class="page-item '.$active;  echo '"><a class="page-link" href="'; if($x==1){ echo "blogs";}else{ echo "blogs/pages/".$x; }; echo '">'.$x.'</a></li>';
  }
  echo '<!--<li class="page-item"><a class="page-link" href="#"><i class="fa fa-chevron-right"></i></a></li>-->
</ul> ';
	mysqli_close($con);
}

function getPostfromsameauthor($table,$limit=false,$authorid,$exceptbdata=false,$category=false){
	require("database/db_connect.php");
	$sql="SELECT *,$table.id FROM $table inner join page_hits on $table.id=page_hits.page_id WHERE posted='publish' and review_status!='Under Review' and author_id='$authorid' and $table.id!='$exceptbdata' ORDER BY count desc LIMIT $limit";
	if ($result=mysqli_query($con,$sql))
	{
      	//count number of rows in query result
		$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no posts alert
		if ($rowcount==0) {
      		$sql="SELECT *,$table.id FROM $table inner join page_hits on $table.id=page_hits.page_id WHERE posted='publish' and review_status!='Under Review' and category='$category' and $table.id!='$exceptbdata' ORDER BY count desc LIMIT $limit";
	if ($result=mysqli_query($con,$sql))
	
	$rowcount=mysqli_num_rows($result);
      	//if no rows returned show no posts alert
		if ($rowcount==0) {
			echo 'No Posts To Fetch';
			}
		}
      	//if there are rows available display all the results
		foreach ($result as $olderposts => $op) {
      	# code...
			echo '<div class="blog-grids row mb-3">
			<div class="col-md-5 blog-grid-left">
			<a href="blog/'.buildURL($op['title']).'/'.$op['id'].'">';
			if (is_file("upload-images/blog/thumb/". $op['photo'])) {
                               echo '<img src="upload-images/blog/thumb/'.$op['photo'].'" class="img-popular" alt="'.$op['title'].'">';
                            } else { echo '<img src="images/noimage.png" class="img-popular" alt="'.$op['title'].'">'; }
							if($op['count']){ $count=$op['count']; }else{ $count=0; }
							$total_share=$op['fb_count']+$op['tw_count']+$op['wa_count']+$op['link_count'];
			if($op['approval_date']){ $posteddate= date('Y-m-d',strtotime($op['approval_date'])); 
											}else{ 
											$posteddate= date('Y-m-d',strtotime($op['date'])); }
			echo '</a>
			</div>
			<div class="col-md-7 blog-grid-right">

			<h5>
			<a href="blog/'.buildURL($op['title']).'/'.$op['id'].'">'.$op['title'].'</a>
			</h5>
			<div class="sub-meta">
			<span>
			<i class="far fa-clock" title="Posted Date"></i> '.$posteddate.' &nbsp; &nbsp; <i class="fas fa-eye" title="Views"></i> '.$count.' <!--&nbsp; &nbsp; <i class="fas fa-share-alt" title="Total Shares"></i> '.$total_share.'--></span>
			</div>
			</div>

			</div>';
		}
	}

	mysqli_close($con);
}

?>
