<!DOCTYPE HTML>

<html>
	<head>
<meta name="theme-color" content="#151515">
<meta name="msapplication-navbutton-color" content="#151515">
<meta name="apple-mobile-web-app-status-bar-style" content="#151515">
<style>
input[type="text"], input[type="password"], input[type="email"], select, textarea{
    width: 50% !important;
    padding-left: 20px;

}
input[type="text"],input[type="submit"]{
    display: table-cell;
}

#response {
    margin-top: 2%;
}
</style>
                <link rel="icon" type="image/png" href="http://ziddle.net/wp-content/uploads/2016/03/favicon.png">
		<title>Ziddle</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="robots" content="index, follow">
		<link rel="stylesheet" href="css/main.css?v=1.1" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
         

	</head>
	<body>

		<!-- [Header] -->
			<header id="header">
				<h1><img height="300" src ="css/logo.png" style="opacity:0.8;filter:alpha(opacity=80);"></h1>
                               
					<!--<ul class="icons" data-for='nav' >
						<li class='active' ><h2><a data-for='toggleTab' href="#login"><span class="label">Home</span></a></h2></li>
					</ul>-->
                                <p>Search your product,<br />
				all reviews at one place <a href="#">#ziddle.</a></p>
			</header>
			
		<!-- [/Header] -->



		<div id='form_response' ></div>
		
		
		<form data-for='search' id="signup-form" method="post" action="#">
				<input type="text" name="search-key" id="search-key" placeholder="Search Now"/>
				<input name="submit" type="submit" value="Search" />
		</form>



			<div id='response' ><br><Br></div>
<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" title="Forums" target="_blank"><span class="label"><i class="fa fa-forumbee" aria-hidden="true"></i>
</span></a></li>
					<li><a href="#" title="Facebook" target="_blank"><span class="label"><i class="fa fa-facebook" aria-hidden="true"></i>
</span></a></li>
					<li><a href="mailto:ziddlecorp@gmail.com" title="Mail Us"><span class="label"><i class="fa fa-google" aria-hidden="true"></i>
</span></a></li>


				</ul>
				<ul class="copyright">
					<li>This site is not affiliated with any E-commerce website. | &copy; Natus Vincere</li>
				
	
</ul>
		</footer>
	</body>
<!-- Script -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="js/main.js?v=1.1"></script>
<script>
	$("[data-for='search']").submit(function (e) {
		e.preventDefault();
		$("#response").html("<i class='fa fa-spinner' /> Loading..");
		$.post( "search.php" , { key : $(this).find("#search-key").val() } , function (r) {
			$("#response").html(r);
			setupDivs();
		}).error(function (e) { $("#response").html("<div class=error >Error searching..<Br>Make sure your internet connection is working fine</div>"); });
	});
	
	function setupDivs() {
		var d = $(".minimize") , l = 60;
		
		d.filter(function () {
			if( this.innerText.length < l) return ;
			var t = $(this) , txt = t.text(); 
			t.html( txt.substr(0,l) + '....<a data-for="maximize" href=# >More</a>')
			.data("orig-txt" , txt )
			.data("new-html", t.html() );
			return true;
		});
		
		d.on("click","[data-for='maximize']",function (e) {
			e.preventDefault();
			$(this).parents(".minimize").html( $(this).parents(".minimize").data("orig-txt") + "<a data-for='minimize' href=# >Less</a>" );
		}).on("click","[data-for='minimize']",function (e) {
			e.preventDefault();
			$(this).parents(".minimize").html( $(this).parents(".minimize").data("new-html") );
		});
	}
	
</script>