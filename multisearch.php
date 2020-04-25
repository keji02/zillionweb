<?php include "blocks/head.inc.php"; ?>
<?php //include "blocks/menu.inc.php"; ?>


<script src="js/jquery.min.js" type="f50d1d2229a0e5fa1303824b-text/javascript"></script>
<script src="js/popper.js" type="f50d1d2229a0e5fa1303824b-text/javascript"></script>
<script src="js/bootstrap.min.js" type="f50d1d2229a0e5fa1303824b-text/javascript"></script>
<script src="js/main.js" type="f50d1d2229a0e5fa1303824b-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="f50d1d2229a0e5fa1303824b-|49" defer=""></script>


<!doctype html>
<html lang="en">
<head>
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
    <a href="dashboard.php">Home</a>
<li>
<a href="tableresultz.php?id=1&type=gene">Simple Search</a>
</li>
<li>
<a href="BrowseStats.php">Browse</a>
    </li>
    
<li class="active">
<a href="multisearch.php">Multiple Search</a>
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
        <h3 class="display 4" id="welcometitle">Multiple Genes Search</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>


<br>
<br>


<?php


?>


        <p>Query Multiple Genes of interest  </p>
        
      
      <div class="container">
    
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8" >
                        
                            <form action="MultiSearchStats.php" method="get" >
                            
                                <div class="card-body row no-gutters align-items-center">
                               
                                
                                    <div class="col">
                                        <input class="form-control form-control-md form-control-borderless"  type="text" name="dataid" placeholder="Enter Multiple Gene IDs separated by ,">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-md btn-primary btn-search" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                   
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
                </div>
            </div>
		</div>

<?php 
    include "blocks/footer.inc.php";
    include "blocks/closing.inc.php";
?>






