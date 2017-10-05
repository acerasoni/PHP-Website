<!--   (!) This file is part of the base template - see report (!) -->
<?php require 'functions.php'; ?> 
<!DOCTYPE html>
<html>
<head>
<body style='margin-top:0;margin-left:50px;margin-right:0px;'>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"type="text/css">  <!--.css template from w3schools.com online resources-->
<style> 
/* Style the tab */  
body{
background: url(background.jpg)
}
div.tab {
overflow: hidden;
border: 1px solid #ccc;
	background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
div.tab button {
	background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

/* Change background color of buttons on hover */
div.tab button:hover {
	background-color: #ddd;
}

/* Create an active/current tablink class */
div.tab button.active {
	background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
	border-top: none;
}
</style>  <!--.css tab style template from w3schools.com online resources-->
<meta charset="utf-8" />
<title><?php siteName(); ?> | <?php pageTitle(); ?></title>
</head>
<body>
<div class="wrap">

<header>
<h2><?php siteName(); ?></h2>
<div class="tab">
<button class="tablinks" onclick="openCity(event, 'Home')"><a href="/" title="Home">Home</a> </button>
<button class="tablinks" onclick="openCity(event, 'artists')"><a href="/?page=artists&error=0">Artists</a></button>
<button class="tablinks" onclick="openCity(event, 'Albums')"><a href="/?page=albums&error=0&q=0">Albums</a></button>
<button class="tablinks" onclick="openCity(event, 'tracks')"> <a href="/?page=tracks&error=0&q=0">Tracks</a></button>
</button>
</div>
</header>    

<article>
<h3><?php pageTitle(); ?></h3>
<?php pageContent(); ?>
</article>

<footer><small><?php echo date('Y'); ?> G51DBI Assignment - Andrea Giulio Cerasoni.</small></footer>
</div>
</body>
</html>