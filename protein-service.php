<?php
    include 'db-connect.inc.php';


    //header('Content-Type: application/json');
    $id = $_POST['id'];
    $action = $_POST['action'];
    $result;
    switch ($action) {
        case 'gene':
            $result['gene']['main'] = queryGene($conn, $id);
            $result['gene']['interactors'] = queryInteractors($conn, $id);
        break;
        case 'interactions':
            $result['interactions'] = queryInteractions($conn, $id);
            //var_dump($result['interactions']);
        break;
        //var_dump($result['interactions']);
        
    }


    echo json_encode($result);



mysqli_close($conn);

function queryGene($conn, $id) {
    
    $select = 'SELECT interactor.symbol as Symbol, interactor.Id as Id ';

    $query = $select. '
             FROM interactors interactor WHERE interactor.Id =' . $id;
    
    $rows = query($conn, $query);

    return $rows;
}

function queryInteractors($conn, $id) {

    $select = 'SELECT interactor_one.symbol as Symbol, interactor_one.id as Id, interactor_two.id as Id2';

    $query = $select.' FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = interactions.id INNER JOIN interactors 
    interactor_two ON interactor_two.id = interactions.id_interaction WHERE interactor_two.id = '. $id .' UNION ALL '.$select. ' FROM interactors interactor_one INNER JOIN interactions ON interactor_one.id = 
    interactions.id_interaction INNER JOIN interactors interactor_two ON interactor_two.id = 
    interactions.id WHERE interactor_two.id ='. $id;

    $rows = query($conn, $query);

    return $rows;
}

function queryInteractions($conn, $id) {

    //$query = 'SELECT DISTINCT id, id_interaction FROM interactions WHERE id IN (6416, 2318, 9043, 5871, 1326, 207, 23162, 4296, 4216, 409)
      //        AND id_interaction IN (6416, 2318, 9043, 5871, 1326, 207, 23162, 4296, 4216, 409)';

     $queryx = 'SELECT DISTINCT id, id_interaction FROM interactions  WHERE id IN ('. htmlspecialchars(implode($id, ','),ENT_QUOTES, "UTF-8") .')
        AND id_interaction IN ('. htmlspecialchars(implode($id, ','),ENT_QUOTES, "UTF-8") .')';

    $rows = query($conn, $queryx);

    return $rows;
}

function query($conn, $query) {
    $rows = [];

    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $rows = $row;
        }
    }
    return $rows;
}


?>