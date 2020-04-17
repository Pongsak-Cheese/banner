<?php

 	// define('WEB_META_BASE_URL', 'http://49.231.159.204/');
	define('WEB_META_BASE_URL', 'http://banner-pages.alpha/');
	$cheeseapi = new cheeseapi($_GET['uid']);

	$str =  $cheeseapi->FNC_GEN_BANNER();
	$header = isset($str['header']) ? $str['header'] : "";
	$image = !empty($str['image']) ? $str['image'] : "";
	$social = isset($str['social']) ? $str['social'] : "";
	$tag = isset($str['tag']) ? $str['tag'] : "";
	// var_dump($tag);
	class cheeseapi { 
		// public  $DB = OMDb::singleton();
		// private $api_banner = "http://49.231.159.204/service/design-banner.php"; 
		private $api_banner = "http://banner-pages.alpha/service/design-banner.php";
		public 	$uid;
		public function __construct($uid = null) {
			$this->uid = $uid;
		}
		private function HTTPPost($url = null, array $params = null) {
			$response = array();
			$ch = curl_init();
			$query = http_build_query($params);
			curl_setopt($ch, CURLOPT_URL, $url);
			//------------------------------- ลบได้
			curl_setopt($ch, CURLOPT_SSLVERSION, 6);
			curl_setopt($ch, CURLOPT_ENCODING , "gzip");
			//------------------------------- 
			curl_setopt($ch, CURLOPT_USERAGENT,'okhttp/3.8.0');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
			curl_setopt($ch, CURLOPT_TIMEOUT, 40000); //-- ค่าเดิม10
			$httpCode = curl_getinfo($ch , CURLINFO_HTTP_CODE); 
			$response = curl_exec($ch);
			curl_close($ch);
			$json = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', utf8_encode($response));
			$json = json_decode(utf8_encode($json), true);
		   
	  		return $json;
		}

		public function FNC_GEN_BANNER($uid = null) {
			if (!isset($this->uid)) return false;
			$params = array(
				"cmd"=>"banner_page",
				"uid"=>$this->uid,
			);
			return  $this->HTTPPost($this->api_banner,$params);
		}
	}

?>
<!DOCTYPE html>
<html style="margin: 0;padding: 0;height: 100%;">
<head>
<meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Cheese mobile banner</title>
	<meta name="description" content="cheesemobile">
	<meta name="keywords" content="cheesemobile">
	<meta name="author" content="cheesemobile.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="shortcut icon" href="<?=WEB_META_BASE_URL?>favicon.png" />
	<meta property="fb:app_id" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:type" content=""/>
    <meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:url" content=""/>
	<base href="<?=WEB_META_BASE_URL?>" />

	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/scripts/jquery.min.js"></script>
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link rel="stylesheet" href="<?=WEB_META_BASE_URL?>css/styles/style.css">
</head>

<body style="background: white;">
	<div class="container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">

				<!-- HEADER -->
				<div class="page-header mb-30">
					<div class="row">
						<?php echo $header; ?>
					</div>
				</div>
				<!-- HEADER -->

				<div class="product-wrap">
					<div class="product-detail-wrap mb-30">

						<!-- CENTER IMAGE -->
						<div class="customscroll customscroll-10-p height-100-p xs-pd-20-10">
							<div class="min-height-200px">
								<div class="gallery-wrap">
									<ul class="row">
										<?php echo $image; ?>
									</ul>
								</div>
							</div>
						</div>
						<!-- CENTER IMAGE -->


						<!-- <h4 class="mb-20">Recent Product</h4> -->

						<!-- BUTTOM SOCIAL -->
						<div class="row clearfix">
							
							<?php echo $social; ?>
<!-- 							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-10">
								<div class="bg-white pd-10 box-shadow border-radius-5 height-100-p">
									<div class="notification-list mx-h-450 customscroll">
										<ul>
											<li>
												<a href="#">
													<img src="<?=WEB_META_BASE_URL?>images/line.png" alt="">
													<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
													<p>Lorem ipsum dolor sit amet, </p>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-10">
								<div class="bg-white pd-10 box-shadow border-radius-5 height-100-p">
									<div class="notification-list mx-h-450 customscroll">
										<ul>
											<li>
												<a href="#">
													<img src="<?=WEB_META_BASE_URL?>images/facebook.png" alt="">
													<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
													<p>Lorem ipsum dolor sit amet, </p>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-10">
								<div class="bg-white pd-10 box-shadow border-radius-5 height-100-p">
									<div class="notification-list mx-h-450 customscroll">
										<ul>
											<li>
												<a href="#">
													<img src="<?=WEB_META_BASE_URL?>images/instagram.png" alt="">
													<h3 class="clearfix">John Doe <span>3 mins ago</span></h3>
													<p>Lorem ipsum dolor sit amet, </p>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div> -->
						</div>
						<!-- BUTTOM SOCIAL -->

					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/scripts/script.js"></script>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/scripts/sweetalert2.all.js"></script>
</body>

</html> 

