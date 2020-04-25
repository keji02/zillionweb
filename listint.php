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
        <h3 class="display 4" id="welcometitle">List of interactors</h3>

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
    



  //  $sql = 'SELECT interactor_one.symbol as Symbol, interactor_one.id as ID1, interactor_two.id as ID2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id ='.$id;

    $sqlz = 'SELECT DISTINCT interactor_one.symbol as Symbol, interactor_one.id as ID1, interactor_two.id as ID2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id = ' .$id .' UNION SELECT DISTINCT interactor_one.symbol, interactor_one.id as ID1, interactor_two.id as ID2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id_interaction INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id WHERE interactor_two.id = ' .$id;




  //  $sqlx =  'SELECT DISTINCT id, id_interaction FROM interactions  WHERE id IN ('.$id.') OR id_interaction IN ('.$id.')';

//$sqlu='SELECT uniprot.uniprot_AC,interactors.id,interactors.symbol FROM interactors,uniprot WHERE uniprot.gene_ID=interactors.id AND gene_ID IN ('.$id.')';

   // $sqlz= 'SELECT DISTINCT id, id_interaction FROM interactions  WHERE id IN ('. htmlspecialchars(implode($id, ','),ENT_QUOTES, "UTF-8") .')
     //AND id_interaction IN ('. htmlspecialchars(implode($id, ','),ENT_QUOTES, "UTF-8") .')';
      
    echo"  <div class='table-responsive m-b-20'>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Symbol</th>
                <th>Interactors Id</th>
                <th> </th>
            </tr>
        </thead>
        <tbody>";


//$data=array();

                    $result = $conn->query($sqlz);  

           

                 
                    
            


                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                           // echo "Symb: " . $row["Symbol"].  "<br>";
                           // echo "id1: " . $row["ID1"].  "<br>";

                        echo"
                                   <tr>
                                       <td>".$row["Symbol"]."</td>
                                       <td>".$row["ID1"]."</td>
                                   </tr>
                                   ";
                      




                            
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();

echo"
                    </tbody>
                    </table>
                </div>
";
            
  echo"              <!-- END DATA TABLE-->
            </div>
        </div>
        </div>";




    ?>




                                <!-- DATA TABLE-->
                                

<?php 
    include "blocks/footer.inc.php";
    include "blocks/closing.inc.php";
?>
