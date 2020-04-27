<?php

 	// define('WEB_META_BASE_URL', 'http://myadminpage.cdn-ads.com/');
	define('WEB_META_BASE_URL', 'http://banner-pages.alpha/');
	
	$cheeseapi = new cheeseapi($_GET['uid']);

	$str =  $cheeseapi->FNC_GEN_BANNER();
	$header = isset($str['header']) ? $str['header'] : "";
	$image = !empty($str['image']) ? $str['image'] : "";
	$social = isset($str['social']) ? $str['social'] : "";
	$gtag = isset($str['gtag']) ? $str['gtag'] : "";
	$gtm_head = isset($str['gtm_head']) ? $str['gtm_head'] : "";
	$gtm_body = isset($str['gtm_body']) ? $str['gtm_body'] : "";
	$pixel = isset($str['pixel']) ? $str['pixel'] : "";
	// var_dump($str);
	class cheeseapi { 
		// public  $DB = OMDb::singleton();
		// private $api_banner = "http://myadminpage.cdn-ads.com/service/design-banner.php"; 
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
	<?php echo $gtag; ?>
	<?php echo $gtm_head; ?>
	<?php echo $pixel; ?>
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
	<?php echo $gtm_body; ?>
	<div class="container">
		<!-- <div class="pd-ltr-20 xs-pd-20-10"> -->
			<div class="min-height-200px wrapper-social">

				<!-- HEADER -->
				<?php echo $header; ?>
				<!-- HEADER -->

				<div class="product-wrap">
					<div class="product-detail-wrap mb-30">

						<!-- CENTER IMAGE -->
						<div class="customscroll customscroll-10-p height-100-p">
							<div class="min-height-200px">
								<div class="mb-3">
									<ul class="row">
										<?php echo $image; ?>
									</ul>
								</div>
							</div>
						</div>
						<!-- CENTER IMAGE -->


						<!-- <h4 class="mb-20">Recent Product</h4> -->

						<!-- BUTTOM SOCIAL -->
						<div class="clearfix footer-social text-center">
							<?php echo $social; ?>
						</div>
						<!-- BUTTOM SOCIAL -->


					</div>
				</div>
			<!-- </div> -->
		</div>
	</div>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/scripts/script.js"></script>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/scripts/sweetalert2.all.js"></script>
</body>

</html> 

