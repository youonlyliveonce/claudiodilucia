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

	<!-- SKRIPT -->
	 <script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-96990711-1', 'auto');
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
			.preloader .curtain {
				background-color: #fff;
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
			.newload {
				overflow: hidden
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
				top: 50%;
				height: 1px;

				background-color: #000;
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
