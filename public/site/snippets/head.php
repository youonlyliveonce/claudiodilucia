<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">

	<title><?php echo $site->title()->escape() ?> | <?php echo $page->title()->escape() ?></title>
	<meta name="description" content="<?php echo $site->description()->html() ?>">
	<meta name="keywords" content="<?php echo $site->keywords()->html() ?>">

	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="/ico_29-29.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico_72-72.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico_114-114.png">

	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="HandheldFriendly" content="true">

	<script>
	  (function(d) {
	    var config = {
	      kitId: 'sok5vhe',
	      scriptTimeout: 3000,
	      async: true
	    },
	    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
	  })(document);
	</script>
	<!-- SKRIPT -->
	 <script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-96532469-2', 'auto');
		ga('set', 'anonymizeIp', true);
		ga('send', 'pageview');
	 </script>
	<style>
			body {
				background-color: black;
				overflow: hidden;
				margin: 0px;
				padding: 0px;
			}

			.preloader {
				text-align:center;
				position: fixed;
				top: 0;
				width: 100%;
				height: 100%;
				z-index: 111110;
			}
			.Page {
				-ms-transform: scale(.75, .75);
				-webkit-transform: scale(.75, .75);
				-moz-transform: scale(.75, .75);
				transform: scale(.75, .75);
			}
			.Header__logo {
				opacity: 0;
			}
			.preloader .curtain {
				background-color: #000;
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				width: 100%;
				height: 100%;
				opacity: 1;
				-webkit-transition: all 0.75s cubic-bezier(0.395, 0.060, 0.610, 0.925);
				-moz-transition: all 0.75s cubic-bezier(0.395, 0.060, 0.610, 0.925);
				-ms-transition: all 0.75s cubic-bezier(0.395, 0.060, 0.610, 0.925);
				transition: all 0.75s cubic-bezier(0.395, 0.060, 0.610, 0.925);
			}
			.run .Page {
				/*-webkit-transition: all 0.45s cubic-bezier(0.250, 0.250, 0.195, 1.085) 0.35s;
				-moz-transition: all 0.45s cubic-bezier(0.250, 0.250, 0.195, 1.085) 0.35s;
				-ms-transition: all 0.45s cubic-bezier(0.250, 0.250, 0.195, 1.085) 0.35s;
				transition: all 0.45s cubic-bezier(0.250, 0.250, 0.195, 1.085) 0.35s;
				-ms-transform: scale(1, 1);
				-webkit-transform: scale(1, 1);
				-moz-transform: scale(1, 1);
				transform: scale(1, 1);*/
			}
			.run .Scrollnavigation {
				/*right: 0px;*/
			}
			.run .Header__logo {
				/*opacity: 1;*/
			}
			.newload {
				overflow: hidden
			}
			.newload .Page,
			.loading .Page,
			.hideloader .Page,
			.loaded .Page {
				-ms-transform: scale(.75, .75);
				-webkit-transform: scale(.75, .75);
				-moz-transform: scale(.75, .75);
				transform: scale(.75, .75);
			}
			.newload .preloader,
			.loading .preloader,
			.hideloader .preloader,
			.loaded .preloader {
				z-index: 99999;
			}
			.newload .preloader .curtain,
			.loading .preloader .curtain,
			.loaded .preloader .curtain {
				opacity: 1;
			}
			.hideloader .preloader .curtain {
				/*opacity: 0;*/
				left: 100%;
				width: 0%;

			}
			.preloader .loader {
				display: block;
				width: 100%;
				height: 100%;
				position: relative;
				top: 0%;
			}
			.preloader .loader-inner {
				vertical-align: top;
				position: absolute;
				display: block;
				/*top: 33.333%;
				height: 33.333%;*/
				top: 50%;
				height: 1px;

				background-color: #fff;
				animation: loader-inner 8s infinite ease;
				-webkit-animation: loader-inner 8s infinite ease;
				-moz-animation: loader-inner 8s infinite ease;
				-o-animation: loader-inner 8s infinite ease;
			}


			@keyframes loader-inner {
				0% {
					left: 0%;
					width: 0%;
				}

				25% {
					left: 0%;
					width: 50%;
				}

				50% {
					left: 0%;
					width: 100%;
				}

				75% {
					left: 50%;
					width: 50%;
				}

				100% {
					left: 100%;
					width: 0%;
				}
			}
			@-webkit-keyframes loader-inner {
				0% {
					left: 0%;
					width: 0%;
				}

				25% {
					left: 0%;
					width: 50%;
				}

				50% {
					left: 0%;
					width: 100%;
				}

				75% {
					left: 50%;
					width: 50%;
				}

				100% {
					left: 100%;
					width: 0%;
				}
			}
			@-moz-keyframes loader-inner {
				0% {
					left: 0%;
					width: 0%;
				}

				25% {
					left: 0%;
					width: 50%;
				}

				50% {
					left: 0%;
					width: 100%;
				}

				75% {
					left: 50%;
					width: 50%;
				}

				100% {
					left: 100%;
					width: 0%;
				}
			}
			@-o-keyframes loader-inner {
				0% {
					left: 0%;
					width: 0%;
				}

				25% {
					left: 0%;
					width: 50%;
				}

				50% {
					left: 0%;
					width: 100%;
				}

				75% {
					left: 50%;
					width: 50%;
				}

				100% {
					left: 100%;
					width: 0%;
				}
			}
	</style>

</head>
<body class="loading">

	<div class="preloader">
		<div class="curtain">
			<div class="loader">
				<div class="loader-inner"></div>
			</div>
		</div>
	</div>
