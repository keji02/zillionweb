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
    <a href="#">Browse</a>
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
        <h3 class="display 4" id="welcometitle">Gene Details</h3>

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
    



 

    $sqlz = 'SELECT * FROM uniprot WHERE gene_ID='.$id.'';

//$sqlu='SELECT * FROM uniprot WHERE gene_ID IN (6416, 2318, 9043, 5871, 1326, 207, 23162, 4296, 4216, 409)';
      
    echo"  <div class='table-responsive m-b-20'>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Gene ID</th>
                <th>Uniprot AC</th>
                <th>Uniprot ID</th>
                <th>Name</th>
                <th>Function</th>
            </tr>
        </thead>
        <tbody>";




                    $result = $conn->query($sqlz);  




                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                           // echo "Symb: " . $row["Symbol"].  "<br>";
                           // echo "id1: " . $row["ID1"].  "<br>";

                        echo"
                                   <tr>
                                       <td>".$row["gene_ID"]."</td>
                                       <td>".$row["uniprot_AC"]."</td>
                                       <td>".$row["uniprot_ID"]."</td>
                                       <td>".$row["name"]."</td>
                                       <td>".$row["function"]."</td>
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
                <!-- END DATA TABLE-->
            </div>
        </div>
        </div>";

    ?>




                            
                                

<?php 
    include "blocks/footer.inc.php";
    include "blocks/closing.inc.php";
?>