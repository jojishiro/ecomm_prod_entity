<?php 

include 'config.php';

$request_method = $_SERVER['REQUEST_METHOD'];


if ($request_method == 'GET'){
    if (isset($_GET['products']) && $_GET['products'] == 'all'){ 
        // get all products using api.php?products=all
        $statement = $conn->prepare('select * from ecomm_products');
        $statement->execute();
        $result = $statement->fetchAll();
        $ret_arr = array();
        foreach($result as $res) {
            $ret_arr[] = array(
                'id' => $res['id'], 
                'stock' => $res['stock'], 
                'title' => $res['title'], 
                'subtitle' => $res['subtitle'],
                'image' => $res['img'],
                'created_at' => $res['created_at'],
                'updated_at' => $res['updated_at'],
                'price' => $res['price'], 
                'discount' => $res['discount']
            );
        }
        //echo '<pre>'; print_r($ret_arr); //debug
        echo json($ret_arr);
    } else if (isset($_GET['id']) && $_GET['id'] != ''){  
        // fetch specific product based on id using api.php?id=3
        $statement = $conn->prepare('select * from ecomm_products where id = :pid');
        $statement->execute(array(':pid' => $_GET['id']));
        $row = $statement->fetch();
        if ($row == null) {
            echo json(array('status'=>200, 'message'=>'could not locate product with id #'.$_GET['id']));
        } else {
            $ret_arr = array();
            $ret_arr[] = array(
                'id' => $row['id'],
                'stock' => $row['stock'],
                'title' => $row['title'], 
                'subtitle' => $row['subtitle'],
                'image' => $row['img'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'price' => $row['price'], 
                'discount' => $row['discount']
            );
            echo json($ret_arr);
        }
    } else if (isset($_GET['remid']) && $_GET['remid'] != ''){  
        // delete specific product based on id using api.php?remid=3
        $statement = $conn->prepare('select * from ecomm_products where id = :pid');
        $statement->execute(array(':pid' => $_GET['remid']));
        $row = $statement->fetch();
        if ($row == null) {
            echo json(array('status'=>200, 'message'=>'product with id #'.$_GET['remid'].' is not present.'));
        } else {
            $statement = $conn->prepare('delete from ecomm_products where id = :pid');
            $statement->execute(array(':pid' => $_GET['remid']));
            echo json(array('status'=>200, 'message' => 'product with id #'.$_GET['remid'].' was deleted successfully'));
        }
    } else {
        echo json(array('status'=>405, 'message'=>'query parameters error'));
    }

}



if ($request_method == 'POST') {
        $_POST = json_decode(file_get_contents('php://input'));
        /* print_r($_POST); */
        if (isset($_POST->upd) && $_POST->upd == 'upd-prod') {
            // update specific product
            $statement = $conn->prepare(
                'update ecomm_products set 
                stock = :stockval, 
                title = :titleval, 
                subtitle = :subtitleval, 
                img = :imageval, 
                updated_at = :updatedval, 
                price = :priceval, 
                discount = :discval
                where id = :pid'
            );
            $statement->execute(
                array(
                    ':stockval' => $_POST->stock, 
                    ':titleval' => $_POST->title, 
                    ':subtitleval' => $_POST->subtitle,
                    ':imageval' => $_POST->img, 
                    ':updatedval' => date('Y-m-d'), 
                    ':priceval' => $_POST->price, 
                    ':discval' => $_POST->discount,
                    ':pid' => $_POST->id
                )
            );
            echo json(array('status'=>200, 'message' => 'product with id #'.$_POST->id.' was updated successfully'));


        } else if (isset($_POST->inp) && $_POST->inp == 'in-prod') {
                // insert new product  
                $statement = $conn->prepare(
                    'insert into ecomm_products values (
                        null,
                        :stockval,
                        :titleval, 
                        :subtitleval, 
                        :imageval, 
                        :createdval,
                        :updatedval, 
                        :priceval, 
                        :discval
                    )'    
                );
                $statement->execute(
                    array(
                        ':stockval' => $_POST->stock, 
                        ':titleval' => $_POST->title, 
                        ':subtitleval' => $_POST->subtitle,
                        ':imageval' => $_POST->img, 
                        ':createdval' => date('Y-m-d H:i:s'),
                        ':updatedval' => date('Y-m-d H:i:s'),
                        ':priceval' => $_POST->price, 
                        ':discval' => $_POST->discount,
                    )
                );
                echo json(array('status'=>200, 'message' => 'a new product was inserted successfully'));

        } else {
            echo json(array('status'=>405, 'message'=>'request body parameters error'));
        }
}
