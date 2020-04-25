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
<a href="search.html">Simple Search</a>
</li>
<li class="active">
    <a href="#BrowseSub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Browse</a>
    <ul class="list-unstyled collapse" id="BrowseSub" style>
    <li class="active">
    <a href="#BrowseStats">Statistics</a>
    </li>
    <li>
    <a href="#BrowseNet">Network</a>
    </li>
    </ul>
<li>
<a href="#">Multiple Search</a>
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
        <h3 class="display 4" id="welcometitle">Go term Stats</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>







<?php
include 'db-connect.inc.php';

if(!isset($_GET['goid'])){
 header("location:BrowseStats.php");
 exit();
}


$goid=$_GET['goid'];


$urlgotermdet="gotermdetails.php?goid=".$goid;

$urlgogenedet="gogenedetails.php?goid=".$goid;

$urllistgoint="listgoint.php?goid=".$goid;

$urlgouniprot="gouniprot.php?goid=".$goid;


$urllistgoedges="listgoedges.php?goid=".$goid;

$urlgonet="gonetwork.php?goid=".$goid;

  
$sqlg="SELECT * FROM `go` WHERE GoID='$goid'";




$resultz = $conn->query($sqlg);  

$rowz = mysqli_fetch_array($resultz);

if (!$resultz) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}


$sqlgogene = "SELECT  COUNT(*) FROM `uniprot2go`,`interactors` WHERE interactors.id=uniprot2go.GeneID AND uniprot2go.GOId='$goid'";
$resultgogene = $conn->query($sqlgogene);  

$rowgogene = mysqli_fetch_array($resultgogene);

if (!$resultgogene) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}



$sqlnume="SELECT COUNT(*) FROM interactions WHERE id IN (SELECT GeneID FROM uniprot2go WHERE GoID='$goid') AND id_interaction IN (SELECT GeneID FROM uniprot2go WHERE GoID='$goid') ";

$resulte = $conn->query($sqlnume);  

$rowe = mysqli_fetch_array($resulte);

if (!$resulte) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}




echo"

<p>Your query was: ".$rowz[0].'&nbsp - &nbsp'.$rowz[1]." </p>

<table class='table table-hover'>
      <tr>
        <th scope='col'>Type</th>
        <th colspan='3' style='text-align:center'>Content</th>
        <th scope='col'></th>
        <th scope='col'></th>
      </tr>
  
    <tbody>" ;


   


    echo"
      <tr>
        <td>#GO term</td>
        <td>1</td>
        <td><a href='$urlgotermdet'>Details</a></td>
        <td></td>
      </tr>
      <tr>
        <td>#Genes</td>
        <td>".$rowgogene[0]."</td>
        <td><a href='$urlgogenedet'>Details</a></td>
        <td></td>
      </tr>
      <tr>
        <td>#Interactors by GeneIDs</td>
        <td>".$rowgogene[0]."</td>
        <td><a href='$urllistgoint'>List</a></td>
        <td></td>
      </tr>
      <tr>
        <td>#Interactants by UniprotACs</td>
        <td>".$rowgogene[0]."</td>
        <td><a href='$urlgouniprot'>Details</a></td>
        <td></td>
      </tr>


      <tr>
        <td>#Gene-gene interactions</td>
        <td>".$rowe[0]."</td>
        <td><a href='$urllistgoedges'>List</a></td>
        <td><a href='$urlgonet'>Network</a></td>
      </tr>
      

    </tbody>
  </table>"
  
  ?>

</div>




</body>




</html>