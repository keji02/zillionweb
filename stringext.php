<?php include "blocks/head.inc.php"; ?>
<?php //include "blocks/menu.inc.php"; ?>

<!doctype html>
<html lang="en">
<head>
<style>
 


    .row{
      height:400px;
      
    }

p{
    font-size:18px;
   
}


#divcent{
    margin-left:200px;
}


</style>

<title>Zillion</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">

</head>
<body onload='javascript:send_request_to_string()'>
<div class="wrapper d-flex align-items-stretch">
<nav id="sidebar">
<div class="p-4 pt-5">
    <h4 id="title">🅩🅘🅛🅛🅘🅞🅝</h4>
<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(static/images/logoz.png);"></a>
<ul class="list-unstyled components mb-5">
<li>
    <a href="home.html">Home</a>
<li >
<a href="search.html"> Simple Search</a>
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
<li class="active">
<a href="#">String Extension</a>
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
        <h3 class="display 4" id="welcometitle">String Extension</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>


<div class="container-fluid">

<div class="col-12 col-md-10 col-lg-8" >
    
<p>Search a Ligand Identifier</p>


 <div id="divcent" class="card-body row no-gutters align-items-center">

 



 <div class="col">
 <input class="form-control form-control-md form-control-borderless" type="text" id='inputarea' placeholder='KITLG'>
</div>

<div class="col">
             <button class="btn btn-md btn-primary btn-search" onclick='javascript:send_request_to_string();' type="button">Search</button>
</div> 

             <div id="stringEmbedded"></div>


</div>

   </div>




</div>






<?php include "blocks/footer.inc.php"; ?>

<script type="text/javascript" src="https://string-db.org/javascript/combined_embedded_network_v2.0.2.js"></script>




<script>

function send_request_to_string() {

var inputField = document.getElementById('inputarea');

var text = inputField.value;

if (!text) {text = inputField.placeholder}; // placeholder

var proteins = text.split(' ');

/* the actual API query */

getSTRING('https://string-db.org', {
            'species':'9606',
            'identifiers':proteins,
            'network_flavor':'confidence', 
            'caller_identity': 'www.awesome_app.org'
})

}

</script>


 <?php   include "blocks/closing.inc.php"; ?>