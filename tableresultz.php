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
<li class="active">
<a href="tableresultz.php">Simple Search</a>
</li>
<li>
<a href="BrowseStats.php">Browse</a>
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
        <h3 class="display 4" id="welcometitle">Search</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>







<?php
include 'db-connect.inc.php';

if(!isset($_GET['id'])){
 header("location:home.php");
 exit();
}


$id=$_GET['id'];

$type = $_GET['type'];

$urlinter="listint.php?id=".$id;

$urledges="listedges.php?id=".$id;

$urlunip="unipdetails.php?id=".$id;

$urldet="genedetails.php?id=".$id;

$urlgo="godetails.php?id=".$id;

$urlnet="results.php?id=".$id."&type=".$type;

//  $sql = 'SELECT COUNT(*) FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id ='.$id;

$sqlz= 'SELECT DISTINCT ( (SELECT DISTINCT COUNT(*) as C1 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id = '.$id.') + (SELECT DISTINCT COUNT(*) as C2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id_interaction INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id WHERE interactor_two.id = '.$id.') ) as SumCount';
  
$sqlg='SELECT * FROM interactors WHERE id='.$id.'';




$sqle =  'SELECT DISTINCT id FROM interactions  WHERE id IN ('.$id.') OR id_interaction IN ('.$id.')';

$sqlx =  'SELECT DISTINCT id, id_interaction FROM interactions  WHERE id IN ('.$sqle.') AND id_interaction IN ('.$sqle.') UNION SELECT DISTINCT id,id_interaction FROM interactions  WHERE id IN ('.$id.') OR id_interaction IN ('.$id.')    ';


$sqlgo='SELECT COUNT(*) FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID IN ('.$id.') )';




$sqlnode = 'SELECT DISTINCT interactor_one.symbol as Symbol, interactor_one.id as ID1, interactor_two.id as ID2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id = ' .$id .' UNION SELECT DISTINCT interactor_one.symbol, interactor_one.id as ID1, interactor_two.id as ID2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id_interaction INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id WHERE interactor_two.id = ' .$id;

$resultnode = $conn->query($sqlnode);  

$num_rows=mysqli_num_rows($resultnode);



$result = $conn->query($sqlz);  

$row = mysqli_fetch_array($result);



$resultx = $conn->query($sqlx);  
$num_rowsx=mysqli_num_rows($resultx);



$resultz = $conn->query($sqlg);  

$rowz = mysqli_fetch_array($resultz);



$resultg = $conn->query($sqlgo);  

$rowg = mysqli_fetch_array($resultg);



echo"

<p>Your query was: ".$rowz[1].'&nbsp'.$rowz[0]." </p>

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
        <td>#Genes</td>
        <td>1</td>
        <td><a href='$urldet'>Details</a></td>
        <td></td>
      </tr>
  
      <tr>
        <td>#Interactors by GeneIDs</td>
        <td>".$num_rows."</td>
        <td><a href='$urlinter'>List</a></td>
        <td></td>
      </tr>
      <tr>
        <td>#Interactants by UniprotACs</td>
        <td>1</td>
        <td><a href='$urlunip'>Details</a></td>
        <td></td>
      </tr>

      <tr>
      <td># Interactants by Gene Ontology</td>
      <td>".$rowg[0]."</td>
      <td><a href='$urlgo'>Details</a></td>
      <td></td>
    </tr>

      <tr>
        <td>#Gene-gene interactions</td>
        <td>".$num_rowsx."</td>
        <td><a href='$urledges'>List</a></td>
        <td><a href='$urlnet'>Network</a></td>
      </tr>
     

    </tbody>
  </table>"
  
  ?>

</div>




</body>




</html>