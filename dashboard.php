<?php include "blocks/head.inc.php"; ?>

<?php //include "blocks/menu.inc.php"; ?>
  
  
<!doctype html>
<html lang="en">
<head>
<style>
   #helpformat {
   padding:5px;
   width:250px;
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
<li class="active">
    <a href="dashboard.php">Home</a>
<li>
<a href="tableresultz.php?id=1&type=gene">Simple Search</a>
</li>
<li>
<a href="BrowseStats.php">Browse</a>
<li>
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
        <h3 class="display 4" id="welcometitle">Home</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>


<?php


if(isset($_POST['id'])){

    $idz=$_POST['id'];

    $type = $_POST['type'];

   $url="tableresultz.php?id=".$idz."&type=".$type;
   header('Location:'.$url);

  // echo $idz;
    exit();
}


?>


        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        
      
      <div class="container">
    <br/>
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form action="dashboard.php" method="post" class="card card-sm">
                                <div class="card-body row no-gutters align-items-center">
 
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" name="id" placeholder="Search a Gene ID"  pattern="[0-9]{0,10}" title="Invalid Gene ID"   id="genetxtbox" required >
                                        <input type="hidden" name="type" value="gene">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-primary btn-search" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>

                            <a class="btn-sm btn-primary" data-toggle="collapse" href="#clp" role="button">
                            Other identifiers
                            </a>
                            <div class="collapse" id="clp">
                         
<form  action="" method="post">

                            <div class="input-group-prepend">
                            <input type="text" placeholder="Input gene Symbol or UniprotAc" name="helpformat" id="helpformat" onkeyup="GetDetail(this.value)">

                            </div>

</form>





                        </div>
                        <!--end of col-->
                    </div>
                </div>
            </div>
		</div>




        <script type="text/javascript">

function GetDetail(str){

if(str.length==0){
document.getElementById("genetxtbox").value="";
return;
}

else{
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    	
    var data = JSON.parse(this.responseText);

    console.log(data);
    document.getElementById("genetxtbox").value=data;
    }
};






    xmlhttp.open("GET","fetch_data.php?helpformat="+str,true);
    xmlhttp.send();
}
}

</script>








<?php 
    include "blocks/footer.inc.php";
    include "blocks/closing.inc.php";
?>
