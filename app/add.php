<?php 

if(isset($_POST['title'])){
    require '../db_conn.php';

    $title = $_POST['title'];
    
    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else{
        $bgln = $conn->prepare("INSERT INTO todos(title) VALUE(?)");
        $res = $bgln->execute([$title]);

        if($res){
            header("Location: ../index.php?mess=success");
        }else{
            header("Location : ../index.php?mess=error");
        }
        $conn = null;
        exit();
    }
}else{
    header("Location: ../index.php?mess=error");
}
?>