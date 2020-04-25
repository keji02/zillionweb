<?php include "blocks/head.inc.php"; ?>
<?php //include "blocks/menu.inc.php"; ?>

<!doctype html>
<html lang="en">
<head>
<style>
    #cy {
        height: 100%;
      width: 100%;
      position: absolute;
      left: 0;
      top: 10;
      right: 0;
      margin-left: auto; 
      margin-right: auto;
      
    }

    .row{
      height:400px;
      
    }


#uniprot-panel{
   
}

</style>

<title>Zillion</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="wrapper d-flex align-items-stretch">
<nav id="sidebar">
<div class="p-4 pt-5">
    <h4 id="title">🅩🅘🅛🅛🅘🅞🅝</h4>
<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(static/images/logoz.png);"></a>
<ul class="list-unstyled components mb-5">
<li>
    <a href="home.html">Home</a>
<li class="active">
<a href="search.html">Search</a>
</li>
<li>
    <a href="#BrowseSub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Browse</a>
    <ul class="list-unstyled collapse" id="BrowseSub" style>
    <li>
    <a href="#BrowseStats">Statistics</a>
    </li>
    <li>
    <a href="#BrowseNet">Network</a>
    </li>
    </ul>
<li>
<a href="#">Download</a>
</li>
<li>
<a href="#">Contact</a>
</li>
</ul>
<div class="footer">
<p>
Copyright &copy;<script type="f50d1d2229a0e5fa1303824b-text/javascript">document.write(new Date().getFullYear());</script> All rights reserved | Kejilen Parrianen
</p>
</div>
</div>
</nav>



<div id="content" class="p-4 p-md-5">

    <div class="page-header" style="background-image: url(static/images/prot3.jpg);">
        <h3 class="display 4" id="welcometitle">Interactive Network</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>


<div class="container-fluid">
<div class="row">

 <div class="col-sm-9">

<p>Click on a node to display its information summary and 3D structure.</p>
<div id="cy"> </div>
 
 </div>

  <div id="uniprot-panel" class="col-sm-3" >
 

        <div class="btn btn-success" role="alert">
					  	Protein Information Summary
		</div>
						   
            <div class="alert alert-dark" role="alert">
   						   <div class="protein-code"> </div>
						   <div class="protein-name"> </div>
						   <div class="protein-function"> </div>	   
		     </div>

<button id="saveJPG" type="button" class="btn btn-outline-info">Export network image </button>
<p></p>
<button id="saveJSON" type="button" class="btn btn-outline-warning">Export network data </button>

   </div>


</div>

</div>

  


 

<?php
 if(!isset($_GET['id'])){
  header("location:tableresultz.php");
  exit();
}


$id=$_GET['id'];

$type = $_GET['type'];


?>


<?php include "blocks/footer.inc.php"; ?>

<script>
	$(document).ready(function() {
		search('<?php if(isset($_GET['type']) && !empty($_GET['type'])) echo $_GET['type']; ?>', '<?php if(isset($_GET['id']) && !empty($_GET['id'])) echo $_GET['id']; ?>','<?php if(isset($_POST['filter']) && !empty($_POST['filter'])) echo $_POST['filter']; ?>');
	});
</script>


 <?php   include "blocks/closing.inc.php"; ?>