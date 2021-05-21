<?php
    require 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  
  <title>ToDo List</title>
  <link rel="stylesheet" href="css/style.css">
 
</head>
<body>
    <img src="./img/todolist.png">
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
            <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text"
                       name="title" 
                       style="border-color: red;"
                       placeholder="Bu alan boş bırakılamaz">
                <button type="submit"> EKLE <i class="fas fa-plus-circle"></i></button>
                <?php }else{ ?>
                    <input type="text"
                       name="title" 
                       placeholder="Yapılacak iş">
                       <button type="submit"> EKLE <i class="fas fa-plus-circle"></i></button>
                <?php } ?>
                
            </form>
        </div> 
        <?php $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC"); ?>  
        <?php if($todos->rowCount() < 0){ ?>
        <div class="show-todo-section">
            <div class="todo-item">
                <input type="checkbox">
                    <h2>-------</h2>
                    <small>------</small>

            </div>
        </div> <?php } ?>
        <div class="show-todo-section">
        <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) {?>
            
            <div class="todo-item">
                <span id="<?php echo $todo['id'] ?>" class="remove-to-do"><i class="fas fa-trash"></i></span>

                <?php if($todo['checked']){?>
                    <input type="checkbox" 
                           class="check-box" 
                           checked
                           data-todo-id ="<?php echo $todo['id'] ?>" />
                    <h2 class="checked"><?php echo $todo['title']; ?></h2>
                <?php } else {?>
                    <input type="checkbox"
                           class="check-box"
                           data-todo-id ="<?php echo $todo['id'] ?>" />
                    <h2><?php echo $todo['title']; ?></h2>
                <?php } ?>               

                
                    <small>Oluşturuldu: <?php echo $todo['date_time']; ?></small>

            
        </div><?php } ?></div>
    
    </div>
    <script src="./js/jquery-3.2.1.min.js"></script>
   
    <script>
                        
                    $(document).ready(function(){
                        $('.remove-to-do').click(function(){
                            const id = $(this).attr('id');
                            $.post("app/remove.php",
                            {
                                id : id
                            },
                            (data) => {
                                if(data){
                                    $(this).parent().hide(600);
                                }
                            }
                            );
                        })
                        $(".check-box").click(function(e){
                            const id = $(this).attr('data-todo-id');

                            $.post('app/check.php',
                            {
                                id : id
                            },
                            (data) =>{
                                if(data != 'error'){
                                    const h2 = $(this).next();
                                    if(data == '1'){
                                        h2.removeClass('checked');
                                    }else{
                                        h2.addClass('checked');
                                    }
                                }
                            }
                            );
                        })
                    });
    </script>

</body>
</html>