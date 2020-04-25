<?php include "blocks/head.inc.php"; ?>
<?php //include "blocks/menu.inc.php"; ?>



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
    <a href="home.html">Home</a>
<li class="active">
<a href="search.html">Simple Search</a>
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
        <h3 class="display 4" id="welcometitle">Gene Ontology Details</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>



    <?php
    include 'db-connect.inc.php';


    $id=$_GET['id'];

//molecular function query

$sqlfx= "AND Namespace='molecular_function'";
    

$sqlf = 'SELECT * FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID='.$id.')'.$sqlfx.' ';
    
 
$sqlfc= 'SELECT COUNT(*) FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID='.$id.')'.$sqlfx.' ';

$resultf = $conn->query($sqlfc);  

$rowf = mysqli_fetch_array($resultf);





    //cellular component query
    $sqlcx= "AND Namespace='cellular_component'";
    

    $sqlc = 'SELECT * FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID='.$id.')'.$sqlcx.' ';
        
     
    $sqlcc= 'SELECT COUNT(*) FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID='.$id.')'.$sqlcx.' ';

    $resultc = $conn->query($sqlcc);  

$rowc = mysqli_fetch_array($resultc);





    
//biological process query

    $sqlbx= "AND Namespace='biological_process'";
    

    $sqlb = 'SELECT * FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID='.$id.')'.$sqlbx.' ';
        
     
    $sqlbc= 'SELECT COUNT(*) FROM go WHERE GOId IN (SELECT GOId FROM `uniprot2go` WHERE GeneID='.$id.')'.$sqlbx.' ';

    $resultb = $conn->query($sqlbc);  

$rowb = mysqli_fetch_array($resultb);


 
    

echo"

<div class='accordion md-accordion accordion-blocks' id='accordionEx78' role='tablist'
aria-multiselectable='true'>


<div class='card'>

  
  <div class='card-header' role='tab' id='headingUnfiled'>

    


    
    <a data-toggle='collapse' data-parent='#accordionEx78' href='#collapseUnfiled' aria-expanded='true'
      aria-controls='collapseUnfiled'>
      <h5 class='mt-1 mb-0'>
        <span class='text-success'>Molecular Function &nbsp &nbsp <span class='badge badge-success text-dark'>  ".$rowf[0]."  </span>   </span>
      
      </h5>
    </a>

  </div>
  

  
  <div id='collapseUnfiled' class='collapse' role='tabpanel' aria-labelledby='headingUnfiled'
    data-parent='#accordionEx78'>
    <div class='card-body'>



      
      <div class='table-responsive mx-3'>
        
        <table class='table table-hover mb-0'>

          
          <thead>
            <tr>
            <th class='th-lg'>GoID</th>
            <th class='th-lg'>Name</th>
            <th class='th-lg'>Definition</th>
            <th></th>
              
            </tr>
          </thead> ";
          
          $resultfz = $conn->query($sqlf);



          if ($resultfz->num_rows > 0) {
              // output data of each row
              while($row = $resultfz->fetch_array(MYSQLI_ASSOC)) {
                

              echo"


          
          <tbody>
            <tr>
              <td> ".$row["GoID"]."   </td>
              <td>".$row["Name"]."    </td>
              <td> ".$row["Definition"]."   </td>
              
            </tr> ";

     
        }
    } else {
        echo "0 results";
    }


echo"
          
          </tbody>
          
        </table>
        
      </div>
      

    </div>
  </div>
</div>







<div class='card'>

  
  <div class='card-header' role='tab' id='heading80'>
    
    

    
    <a data-toggle='collapse' data-parent='#accordionEx78' href='#collapse80' aria-expanded='true'
      aria-controls='collapse80'>
      <h5 class='mt-1 mb-0'>
        <span class='text-warning'>Cellular Component &nbsp &nbsp  <span class='badge badge-warning text-dark'>   ".$rowc[0]." </span>    </span>
       
      </h5>
    </a>
  </div>

  
  <div id='collapse80' class='collapse' role='tabpanel' aria-labelledby='heading80'
    data-parent='#accordionEx78'>
    <div class='card-body'>

      <div class='table-responsive mx-3'>
        
        <table class='table table-hover mb-0'>

          
          <thead>
            <tr>
          
            <th class='th-lg'>GoID</th>
            <th class='th-lg'>Name</th>
            <th class='th-lg'>Definition</th>
            <th></th>
             
            </tr>
          </thead>  ";

         
          $resultcz = $conn->query($sqlc);



          if ($resultcz->num_rows > 0) {
              // output data of each row
              while($row = $resultcz->fetch_array(MYSQLI_ASSOC)) {
                

              echo"


          
          <tbody>
            <tr>
              <td> ".$row["GoID"]."   </td>
              <td>".$row["Name"]."    </td>
              <td> ".$row["Definition"]."   </td>
              
            </tr> ";

     
        }
    } else {
        echo "0 results";
    }
   // $conn->close();
          

          
        echo "
            
          </tbody>
          
        </table>
        
      </div>

    </div>
  </div>
</div>



<div class='card'>

  
  <div class='card-header' role='tab' id='heading'>
    
    

    
    <a data-toggle='collapse' data-parent='#accordionEx78' href='#collapse81' aria-expanded='true'
      aria-controls='collapse81'>
      <h5 class='mt-1 mb-0'>
      <span class='text-info'>Biological Process &nbsp &nbsp <span class='badge badge-info text-dark'>  ".$rowb[0]."  </span>   </span>
      </h5>
    </a>
  </div>

  
  <div id='collapse81' class='collapse' role='tabpanel' aria-labelledby='heading'
    data-parent='#accordionEx78'>
    <div class='card-body'>

     
        <table class='table table-hover mb-0'>

          
          <thead>
            <tr>
          
              <th class='th-lg'>GoID</th>
              <th class='th-lg'>Name</th>
              <th class='th-lg'>Definition</th>
              <th></th>
            </tr>
          </thead>
          ";

          $result = $conn->query($sqlb);  




          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                

              echo"


          
          <tbody>
            <tr>
              <td> ".$row["GoID"]."   </td>
              <td>".$row["Name"]."    </td>
              <td> ".$row["Definition"]."   </td>
              
            </tr> ";

     
        }
    } else {
        echo "0 results";
    }
    //$conn->close();

echo"
          </tbody>
          
        </table>
        
      </div>
      
      

      
     
      

    </div>
  </div>
</div>

</div>";




 


    ?>




                            
                                

<?php 
    include "blocks/footer.inc.php";
    include "blocks/closing.inc.php";
?>