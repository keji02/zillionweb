<?php include "blocks/head.inc.php"; ?>
<?php include "blocks/menu.inc.php"; ?>



<div class="container">



   
<br>
<br>

   
                            



                 <?php
    include 'db-connect.inc.php';

 if(!isset($_GET['id'])){
     header("location:dashboard.php");
     exit();
 }


   $id=$_GET['id'];

   $type = $_GET['type'];

    $url="listint.php?id=".$id;

    $urln="results.php?id=".$id."&type=".$type;

  //  $sql = 'SELECT COUNT(*) FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id ='.$id;

    $sqlz= 'SELECT ( (SELECT COUNT(*) as C1 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id = '.$id.') + (SELECT COUNT(*) as C2 FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id_interaction INNER JOIN interactors interactor_two ON interactor_two.id = interactions.id WHERE interactor_two.id = '.$id.') ) as SumCount';
      
    echo"  <div class='table-responsive m-b-20'>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Type </th>
                <th>Content</th>
                <th></th>
            </tr>
        </thead>
        <tbody>";

                    $result = $conn->query($sqlz);  

                    $row = mysqli_fetch_array($result);

                        echo"
                                   <tr>
                                   <td>Number of interactors</td>
                                       <td>".$row[0]."</td>
                                       <td><a href='$url'>List</a></td>
                                       <td><a href='$urln'>Network</a></td>
                                   </tr>
                                   ";
                      


echo"
                    </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
            </div>
        </div>
        </div>";

    ?>




                                <!-- DATA TABLE-->
                                

<?php 
    include "blocks/footer.inc.php";
    include "blocks/closing.inc.php";
?>
