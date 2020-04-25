<?php include "blocks/head.inc.php"; ?>
<?php //include "blocks/menu.inc.php"; ?>

<!doctype html>
<html lang="en">
<head>
<style>
    #cy {
        height: 100%;
      width: 100%;
      position: absolute;
      left: 0;
      top: 10;
      right: 0;
      margin-left: auto; 
      margin-right: auto;
      
    }

    .row{
      height:400px;
      
    }


#uniprot-panel{
   
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
<li>
    <a href="home.html">Home</a>
<li >
<a href="search.html"> Simple Search</a>
</li>
<li class="active">
    <a href="#BrowseSub" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">Browse</a>
    <ul class="list-unstyled collapse" id="BrowseSub" style>
    <li>
    <a href="#BrowseStats">Statistics</a>
    </li>
    <li class="active">
    <a href="#BrowseNet">Network</a>
    </li>
    </ul>
<li >
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
        <h3 class="display 4" id="welcometitle">Multiple Genes Interactive Network</h3>

    </div>
    
<br>
   
<button type="button" id="sidebarCollapse" class="btn btn-primary">
<i class="fa fa-bars"></i>
</button>

<br>
<br>


<div class="container-fluid">
<div class="row">

 <div class="col-sm-9">

<p>Click on a node to display its information summary and 3D structure.</p>
<div id="cy"> </div>
 
 </div>

  <div id="uniprot-panel" class="col-sm-3" >
 

        <div class="btn btn-success" role="alert">
					  	Protein Information Summary
		</div>
						   
            <div class="alert alert-dark" role="alert">
   						   <div class="protein-code"> </div>
						   <div class="protein-name"> </div>
						   <div class="protein-function"> </div>	   
		     </div>

<button id="saveJPG" type="button" class="btn btn-outline-info">Export network image </button>
<p></p>
<button id="saveJSON" type="button" class="btn btn-outline-warning">Export network data </button>

   </div>


</div>

</div>



<?php
  include 'db-connect.inc.php';


 
$goid=$_GET['goid'];


  $sqln="SELECT * FROM interactors WHERE id IN (SELECT GeneID FROM uniprot2go WHERE GoID='$goid')";


  $resultn = $conn->query($sqln);  
  

$nodes=array();

if ($resultn->num_rows > 0) {
    // output data of each row
 
    while($row = $resultn->fetch_assoc()) {

		$symb=$row['symbol'];
		$id=$row['id'];


$nodes[]=array($symb,$id);

    }

} else {
    echo "0 results";
}






$sqle="SELECT * FROM interactions WHERE id IN (SELECT GeneID FROM uniprot2go WHERE GoID='$goid') AND id_interaction IN (SELECT GeneID FROM uniprot2go WHERE GoID='$goid') ";

$resulte = $conn->query($sqle);

$edges=array();


if ($resulte->num_rows > 0) {
    // output data of each row
 
    while($row = $resulte->fetch_assoc()) {

$source=$row["id"];
$target=$row["id_interaction"];

$edges[]=array($source,$target);

		
    }

 // echo json_encode($edges);


} else {
    echo "0 results";
}

$conn->close();

?>


<?php include "blocks/footer.inc.php"; ?>

<script>

$(function() { // on dom ready



let interactors =  <?php    echo json_encode($nodes); ?> ;
let interactions =  <?php    echo json_encode($edges); ?> ;
console.log(interactors);

console.log(interactions);



 var var_nodes = [];
 var var_edges = [];
	  for(var x = 0; x < interactors.length; x++) {
		  var_nodes.push({data:{ id    : interactors[x][1], 
								 symbol  : interactors[x][0]
								}});
	  }
	  
  	  for(var x = 0; x < interactions.length; x++) {
		  var_edges.push({data:{ source  : interactions[x][1], 
								 target  : interactions[x][0]
								}});
	  }

console.log(var_nodes);
console.log(var_edges);


var stylesheet = cytoscape.stylesheet() // creates the stylesheet of the ppi
				.selector('node')
				.css({
				'content': 'data(symbol)',
					'text-valign': 'center',
					'color': 'white',
					'background-color': 'red',
					'text-outline-width': 2,
					'text-outline-color': 'blue',
					'min-zoomed-font-size':5
			}) 
				.selector('edge')
				.css({
				'line-color':'#00b300',
				'curve-style':'haystack',
				'haystack-radius': 0,
				'display': '#00b300',
				
				'width': 1
			})
				.selector(':selected')
				.css({
				'background-color': 'black',
				'line-color': 'black',
				'target-arrow-color': 'black',
				'source-arrow-color': 'black'
			})

        $('#cy').cytoscape({

            style: stylesheet,

            elements: {
                nodes: var_nodes,
                edges: var_edges
            },
			layout: getOptions('concentric'),	
            ready: function() {
                window.cy = this;
				cy.boxSelectionEnabled(true);
				cy.userZoomingEnabled(false);
                cy.elements().unselectify();

				
				window.cy = this;
            
            cy.zoomingEnabled(true);

            cy.on('click', 'node', function (evt) {
                var node = evt.cyTarget;
                nodeSelect(this.data('id'));
            });

            var current_zoom = cy.zoom();
            
            $("#zoom").change(function() {
                if($(this).val() == '50' || $(this).val() == '75' || $(this).val() == '100' || $(this).val() == '125' || $(this).val() == '150' || $(this).val() == '175' || $(this).val() == '200') {
                    cy.zoom({
                      level: current_zoom * (parseInt($(this).val())/100.0), // the zoom level
                      position: { x: cy.width() / 2, y: cy.height()/2 }
                    });					cy.center();					
                }
            });
                
            $("#saveJPG").click(function() {
                console.log('save was clicked2');
                var jpg64 = cy.jpg();
                var element = document.createElement('a');
                  element.setAttribute('href', jpg64 );
                  element.setAttribute('download', 'PPINetwork');

                  element.style.display = 'none';
                  document.body.appendChild(element);

                  element.click();

                  document.body.removeChild(element);						
                
            });

            $("#saveJSON").click(function() {
                console.log('json was clicked2');
                console.log(cy.json());

                var jsn85 = cy.json();
                var fjsn85 = "data:text/json;charset=utf-8 ,"+encodeURIComponent(JSON.stringify(jsn85));

                var element = document.createElement('a');
                  element.setAttribute('href', fjsn85 );
                  element.setAttribute('download', 'PPIData.json');

                  element.style.display = 'none';
                  document.body.appendChild(element);

                  element.click();

                  document.body.removeChild(element);						
                
            });



            }

        });


    

    }); // on dom ready
    
    
	function getOptions(layoutName) {
		var options;
		
		switch(layoutName) {
			case 'cola':
				options = {
					name: 'cola',
					textureOnViewport:true,
					// hideEdgesOnViewport:true,
					hideLabelsOnViewport:true,
					animate: false
				};
				break;
			case 'cose':
				options = {
					name: 'cose',

					// ready               : function() {},
					// stop                : function() {},
					refresh             : 0,
					fit                 : true, 
					padding             : 30, 
					randomize           : true,
					debug               : false,
					nodeRepulsion       : 10000,
					nodeOverlap         : 10,
					idealEdgeLength     : 10,
					edgeElasticity      : 100,
					nestingFactor       : 5, 
					gravity             : 250, 
					numIter             : 100,
					initialTemp         : 200,
					coolingFactor       : 0.95, 
					minTemp             : 1
				};			
				break;
			case 'concentric':
			default:
				options	 = {
				  name: 'concentric',

				  fit: true, // whether to fit the viewport to the graph
				  padding: 30, // the padding on fit
				  startAngle: 3/2 * Math.PI, // where nodes start in radians
				  // sweep: undefined, // how many radians should be between the first and last node (defaults to full circle)
				  equidistant: false, // whether levels have an equal radial distance betwen them, may cause bounding box overflow
				  minNodeSpacing: 40, // min spacing between outside of nodes (used for radius adjustment)
				  boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
				  avoidOverlap: true, // prevents node overlap, may overflow boundingBox if not enough space
				  maxNodes: undefined,
				  incNodesPerCircle: undefined,
				  numNodes: 0,
				  nodesCircle: 0,
				  thing: 1,
				  concentric: function(node){ // returns numeric value for each node, placing higher nodes in levels towards the centre
				  
					 return node.degree();
					
				  },
				  levelWidth: function (nodes) { return nodes.maxDegree() / 2;},
				  animate: false, // whether to transition the node positions
				  animationDuration: 500, // duration of animation in ms if enabled
				  animationEasing: undefined, // easing of animation if enabled
				  ready: undefined, // callback on layoutready
				  stop: undefined // callback on layoutstop
				};
				break;
		}
		return options;
	}



	function nodeSelect(id) {
    console.log('I am the id ' + id);
    var pdbId;
    var pdbArray;
    var proteinName;
    var proteinFunction;
    var proteinAccessCode;
    $.ajax({
        type: 'POST',
        url: 'protein-structure.php',
        dataType: 'json',
        data: {         
            'id': id,
            'action': "proteininfo"
        },
        success: function (data) {

            for (var i = 0; i < data['proteininfo'].length; i++) {

                var pdbList = data['proteininfo'][i].PDB;

                pdbArray = pdbList.split(';');
                proteinName = data['proteininfo'][i].name;
                proteinFunction = data['proteininfo'][i].function;
                proteinAccessCode = data['proteininfo'][i].uniprot_AC;
            }
            
            $('.protein-code').html('<b> Protein Access Code: </b>' + proteinAccessCode);
            $('.protein-name').html('<b> Protein Name: </b>' + proteinName);
            $('.protein-function').html('<b> Protein Function: </b>' + proteinFunction);

            pdbId = pdbArray[0].substring(0, pdbArray[0].length - 2);

            window.open('jsmol.php?pid=' + pdbId,'popUpWindow','height=700,width=600,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');

        },
        error: function (data) {
            console.log(data);
        }
    });
    
}

function setPDB(data) {
		
    if(data !== undefined && data.length !== 0) {
        Jmol._isAsync = false;
        var jmolApplet0;
        var s = document.location.search;
        Jmol._debugCode = (s.indexOf("debugcode") >= 0);
        
        jmol_isReady = function(applet) {
            // document.title = (applet._id + " - Jmol " + Jmol.___JmolVersion);
            jmolApplet0 = applet;
            

            var colors = 'select carbon; color gray;select nitrogen; color blue;select oxygen; color red;select sulfur; color yellow;';
                
            $("#jsmol_dropdown").change(function() {
                Jmol.script(applet,"set frank off; select all; hbonds off; spin off; wireframe off; spacefill off; trace off; set ambient 40; set specpower 40; slab off; ribbons off; cartoons off; label off; monitor off");
                Jmol.script(applet,'Select all; ;ribbon only;'+colors);
                
                switch($(this).val()) {
                    case '1': // bal and stick
                        Jmol.script(applet,'select all; spacefill 23%; wireframe 0.15;');
                        break;
                    case '2': // spacefill
                        Jmol.script(applet,'select all;spacefill only;');
                        break;
                    case '3': // wirefram
                        Jmol.script(applet,'select all;Wireframe only');
                        break;
                    case '4': // ribbon
                        Jmol.script(applet,'Select all; ;ribbon only; color group;');
                        break;
                    case '5': // Backbone
                        Jmol.script(applet,'Select all; Backbone only;');
                        break;
                    case '6': // Trace
                        Jmol.script(applet,'Select all; Trace only;');
                        break;				
                }
            });
            
            
            
            var a = sessionStorage.getItem("sent");

            $.ajax({
                url:'static/pdb/pdb3aln.ent',
                // url:'static/pdb/pdb4tkh.ent',
                type:'HEAD',
                error: function()
                {
                    //file not exists
                    console.log('pdb file does not exist');
                    $("#jsmol_dropdown").css("display","none");
                    $("#jsmol_panel").html('<p>PDB file "3aln.ent" does not exist</p>');
        
                },
                success: function()
                {
                    var colors = 'select carbon; color gray;select nitrogen; color blue;select oxygen; color red;select sulfur; color yellow;';
                    
                    console.log('pdb file exists');
                    $("#jsmol_dropdown").css("display","block");
                    $("#jsmol_description").text("");
                    Jmol.script(jmolApplet0,'load static/pdb/pdb3aln.ent; Select all; ;ribbon only; color group;');
                    // Jmol.script(applet,'Select all; ;ribbon only;'+colors);
                    // Jmol.script(jmolApplet0,'load static/pdb/pdb4tkh.ent');
                }
            });			
        }
        var Info = {
            width: $('#jsmol_panel').width(),
            height: $('#jsmol_panel').width(),
            debug: false,
            color: "0xE5E5E5",
            addSelectionOptions: false,
            use: "HTML5",   // JAVA HTML5 WEBGL are all options
            j2sPath: "static/js/jsmol/j2s", // this needs to point to where the j2s directory is.
            script: "set antialiasDisplay;",
            serverURL: "http://chemapps.stolaf.edu/jmol/jsmol/php/jsmol.php",
            readyFunction: jmol_isReady,
            disableJ2SLoadMonitor: true,
            disableInitialConsole: true,
            allowJavaScript: true
            //defaultModel: "$dopamine",
            //console: "none", // default will be jmolApplet0_infodiv, but you can designate another div here or "none"
        }

        
        $("#jsmol_panel").html(Jmol.getAppletHtml("jmolApplet0", Info));
            
    }	
    // } $('#PDB_tag').attr('data-pdbcode',data[0].pdb_code);
    else {
        $("#jsmol_panel").html('<p>No structure found...</p>');
        
    }
    // $('#PDB_tag').attr('data-pdbcode', false);
    
    
    
    
}








</script>


 <?php   include "blocks/closing.inc.php"; ?>