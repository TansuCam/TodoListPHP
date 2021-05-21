<?php 

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];
    
    if(empty($id)){
        echo 0;
    }else{
        $bgln = $conn->prepare("DELETE FROM todos WHERE id=?");
        $res = $bgln->execute([$id]);

        if($res){
            echo 1;
        }else{
            echo 0;
        }
        $conn = null;
        exit();
    }
}
?>