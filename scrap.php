<?php
/* We never meant to break any policy of amazon, flipkart, or any property owner, The scrapping is done just to feed data and is used for educational purpose only.*/
	//scrap.php
	
	if( isset($_GET['url']) ) {
		
		$ch = curl_init($_GET['url']);
		curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
		
		$res = curl_exec($ch);
		curl_close($ch);
		
		echo "<!-- Response : -->";
		die($res);
		
	}
	else if( isset($_GET['flipkartProdId']) ) {
		
		$ch = curl_init("https://www.flipkart.com/api/3/product/reviews?productId=" . $_GET['flipkartProdId'] . "&count=15&ratings=ALL&reviewerType=ALL&sortOrder=MOST_HELPFUL");
		curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );
		curl_setopt( $ch , CURLOPT_HTTPHEADER , array( "User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36" , "Referer:{$_GET['_url']}" , "x-user-agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.143 Safari/537.36 FKUA/website/41/website/Desktop" , "content-type:application/json" , "cookie:s_ch_list=%5B%5B%27Direct%2528No%2520referrer%2529%27%2C%271470589541636%27%5D%5D; __utma=19769839.453816084.1470589539.1470589539.1470589539.1; __utmz=19769839.1470589539.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none); _vz=viz_5708d1fee1d23; VID=2.VI3E9BF27749D44E698B2243FCA0CEC561.1471243485.VS147124348561845670167; NSID=2.SI5A2BED1A7C1E4D0688F2F757B329222F.1471243485.VI3E9BF27749D44E698B2243FCA0CEC561; atl=atlx_v4; s_cc=true; AMCVS_17EB401053DAF4840A490D4C%40AdobeOrg=1; AMCV_17EB401053DAF4840A490D4C%40AdobeOrg=-227196251%7CMCIDTS%7C17098%7CMCMID%7C60795248936458956774138773623098984938%7CMCAID%7CNONE%7CMCAAMLH-1477802414%7C3%7CMCAAMB-1477802414%7Chmk_Lq6TPIBMW925SPhw3Q%7CMCOPTOUT-1477204814s%7CNONE; gpv_pn=Mobile%3AApple%20iPhone%206%20%28Space%20Grey%2C%2016%20GB%29; gpv_pn_t=Product%20Page; s_sq=%5B%5BB%5D%5D; JSESSIONID=1d0kfiyh9a7o319af0wr3qvcsz; T=TI147058953908802245473468618724981804234783543607155591363246734814; SN=2.VI3E9BF27749D44E698B2243FCA0CEC561.SI5A2BED1A7C1E4D0688F2F757B329222F.VS147124348561845670167.1477197605; S=d1t16fh4wPz9KYz8/Pz8qNnA4KgXmJXnRn8MszoGx3/uYiqZKPTc/s32Ttgrt0XeIQOH6CVmU78/NoQn7kNX59hKGGA==" ) );
		$res = curl_exec($ch);
		curl_close($ch);
		die($res);
	}
	
?>
<html>
	<head>
		<title>Scrap Reviews from Flipkart/Amazon</title>
		<link rel='stylesheet' href='//bootswatch.com/superhero/bootstrap.min.css' />
		<Style>.a-section { margin-bottom:10px; border:3px solid black; background:#fff; border-radius:3px; }</style>
	</head>
	<body class='container' >
		<form data-for='scrap' >
			<div id='response' ></div>
			
			<label for='url' >Url</label>
			<input type='url' name='url' id='url' class='form-control' required />
			
			<input type='submit' class='btn btn-danger' value='Scrap' />
		</form>
		
	</body>
</html>
<script src='//code.jquery.com/jquery.min.js' ></script>
<script>
	$("[data-for='scrap']").submit(function (e) {
		e.preventDefault();
		
		$("#response").html("Loading..");
		
		var u = $(this).find("#url").val();
		
		if(u.match(/amazon\.com/i))
			$.get(window.location.href , { url : u } , function (r) {
				
				r = $(r);
				
				var reviews = r.find("[id*='ReviewsMostHelpful']").has(".a-size-mini.a-color-state.a-text-bold").has("[id*='ReviewsMostHelpful']").find("[id*='ReviewsMostHelpful']").not(".officialCommentStripe").find(".a-section");
				
				$("#response").html(reviews);
				
			});
		else 
			$.get(window.location.href , { flipkartProdId : u.match(/pid=([A-Za-z0-9]+)/)[1] , _url : u } , function (r) {
				
				r = typeof r == 'object' ? r : JSON.parse(r);
				
				var data = r.RESPONSE.data ;
				$("#response").html('');
				
				data.forEach(function (rev) {
					rev = rev.value;
					$("#response").append("<a href='https://www.flipkart.com" + rev.url + "' >" + rev.author + "</a> : <br>" + rev.text + "<br><br><br>");
				});
				
			});
	});
</script>