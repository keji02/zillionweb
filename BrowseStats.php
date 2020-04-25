<?php include "blocks/head.inc.php"; ?>

<?php //include "blocks/menu.inc.php"; ?>
  
  
<!doctype html>
<html lang="en">
<head>
<style>
    
</style>

<title>Zillion</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />  

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
<a href="#">Simple Search</a>
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


<script>  


$(document).ready(function() {
    $('#goz').DataTable();
} );

 </script>  


<div id="content" class="p-4 p-md-5">

    <div class="page-header" style="background-image: url(static/images/prot3.jpg);">
        <h3 class="display 4" id="welcometitle">Gene Ontology Terms Statistics</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>


<?php

if(isset($_POST['goid'])){

    $goidz=$_POST['goid'];

    $type = $_POST['type'];

   $url="tablego.php?goid=".$goidz;
   header('Location:'.$url);

  // echo $idz;
    exit();
}
?>


        <p>The Gene Ontology is a major bioinformatics initiative to unify the representation of gene and gene product attributes across organism </p>
        <label>Examples:
                                     <a href="#" onclick="document.getElementById('goidz').value='GO:0000018';">#1</a> , 
                                     <a href="#" onclick="document.getElementById('goidz').value='GO:0000003';">#2</a>  </label>
      
      <div class="container">
    
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8" >
                        
                            <form action="BrowseStats.php" method="post" >
                            
                                <div class="card-body row no-gutters align-items-center">
                               
                                
                                    <div class="col">
                                   
                                        <input class="form-control form-control-md form-control-borderless"  id="goidz"  type="search" name="goid" placeholder="Search a GO Term">
                                        <input type="hidden" name="type" value="gene">
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



                <?php
include 'db-connect.inc.php';

$sql="SELECT gobiop.GoID,gobiop.Name, COUNT(uniprot2go.GeneID) AS NumGenes FROM `gobiop`,`uniprot2go` WHERE uniprot2go.GOId=gobiop.GoID GROUP BY gobiop.GoID";

    $result=$conn->query($sql);


    echo"  <div class='table-responsive'>
    <table  id='goz' class='table table-hover'>
        <thead>
            <tr>
                <th>Go term</th>
                <th>Name</th>
                <th>NUmber of Genes/Interactors</th>
            </tr>
        </thead>
        <tbody>";
    
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
             
    
            echo"
                       <tr>
                           <td>".$row["GoID"]."</td>
                           <td>".$row["Name"]."</td>
                           <td>".$row["NumGenes"]."</td>
                       </tr>
                       ";
          
    
                
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    
    echo"
        </tbody>
        </table> ";
    

?>






            </div>
		</div>

<?php 
    
    include "blocks/closing.inc.php";
?>
