<?php
    include 'db-connect.inc.php';



   

    if (isset($_GET['helpformat'])) {


        $id = $_GET['helpformat'];

$sqlz="SELECT GeneID FROM protein_structures WHERE UniProtKB_ID LIKE'$id%' OR UniprotAC='$id'  ";

        $result = $conn->query($sqlz);  


        while ($row1 = mysqli_fetch_array($result)) {

            echo $row1['GeneID']; 

        }

   // $identifier =$_GET['helpformat'];

     //   $sqlz='SELECT GeneID FROM protein_structures WHERE UniProtKB_ID='.$identifier.' '; //OR UniprotAC='.$identifier.'  ';

        
    }

 
    ?>