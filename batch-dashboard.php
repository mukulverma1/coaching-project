<?php 

include 'connection.php';
session_start();

$full_name = $_SESSION['username'];

    $sql = "SELECT * FROM `teacher_data` WHERE `full_name` = '$full_name'";
    $result = mysqli_query($conn, $sql);

    if($result){
       
        $row = mysqli_fetch_array($result);
        $teacher = $row['full_name'];
        $id = $row['id'];

        if(isset($_POST["submit"])){

            $batch_name = $_POST['group'];
            $discription = $_POST['discription'];


            if(empty($batch_name)){
                exit();
            }
            else
            {
                
            $insert = "INSERT INTO `batches`(`batch_name`,`discription`, `teacher_id`) VALUES ('$batch_name','$discription','$id')";

           $result = mysqli_query($conn, $insert);
           if($result){
            // Redirect after successful submission
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
           }else{
            echo "falied";
           }
        }
           }
    }
    else {
        echo "Failed to update batch. Error: " . mysqli_error($conn);
    }


    // display batch name
    $display = "SELECT * FROM `batches` WHERE `teacher_id` = '$id'";
    $batch_name_display = mysqli_query($conn, $display);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    background-color: #f7f7f7;
}



.content-section {
    width: 170vh;
    /* margin-top: 80px; */
    margin-top: 50px;
    margin-left: 350px;
    
}

.student-batch{
 display: flex;
justify-content: center;
height: 70px;
width: 200px;
border: 1px solid black;
border-radius: 5px;
}


.btn{
    padding: 10px 60px;
    /* background: #fff; */
    border: 0;
    outline: none;
    cursor: pointer;
    font-size: 22px;
    font-weight: 500;
    border-radius: 10px;
    transition: transform 0.2s;
    /* background-color: #fab169; */
    color: #1a1947;
    background-color: #ffff;
}

.btn:active{
    transform: scale(0.95);
}

.popup{
    width: 400px;
    background: #fff;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.1);
    text-align: center;
    padding: 0 30px 60px;
    color: #333;
    visibility: hidden;
    transition: all 0.4s ease-in-out;
}

.open-popup{
    visibility: visible;
    top: 50%;
    transform: translate(-50%, -50%) scale(1);
}


.popup h2{
    font-size: 38px;
    font-weight: 500;
    margin: 30px 0 10px;
}

.popup button{
    width: 100%;
    margin-top: 20px;
    padding: 10px 0;
    /* background-color: #e02189; */
    background-color: #333;
    color: #fff;
    border: 0;
    outline: none;
    font-size: 18px;
    border-radius: 4px;
    box-shadow: 0 5px 5px rgba(0,0,0,0.2);
}

.input-field , .input-discription{
    height: 40px;
    width: 55%;
    border: 1px solid black;
    padding: 0px 20px;
}

.batchdata:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
}

.container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            /* margin-bottom: 300px; */
        }
        .card {
            /* flex: 3 3 calc(33.333% - 15px); */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            gap: 30px;
            height: 10rem;
            width: 300px;
            overflow: hidden;
            background-color: #ffff;
            
        }
        .card-section {
            margin-bottom: 20px;
            
        }

        .card:hover{
         border: .5px solid black;
        }

.batchlink{
    text-decoration: none;
    color: #1a1947;

} 

.batch{
    /* background-color: aqua; */
    font-weight: 800;
    text-decoration: underline;
}

.input-discription{
height: 120px;
resize: none;
padding-top: 5px;

}

.view-more{
    display: flex;
    justify-content: center;
    
}

/* background-color: #333; */

        @media (max-width: 768px) {
            .card {
                margin-left: 10px;
               
                height: 12rem;
                width: 40%;
            }
            .content-section{
             margin-left: 40px;
            }

            .content-section{
                margin-top: 80px;
            }
            

        }
        @media (max-width: 480px) {
            .card {
                height: 12rem;
                width: 40%;
            }

            .content-section{
             margin-left: 40px;
            }

            .content-section{
                margin-top: 80px;
            }
        }




    </style>

</head>
<body>

    <?php include 'new-dash.php'; ?>

    <!-- student section start -->
    <section id="users" class="content-section">
    <h2>Student Management</h2>

    <br>

    <?php if($teacher == "No")
         echo '<p>You are not Registered as Teacher</p> <br> <br>'
             
         ;

         else {  echo '   

    <div class="student-batch">
        <button type="register" class="btn" onclick="openPopup()">Create Batch</button>  
    </div>

        '; }
    ?>
    <div class="container">
        <div class="popup" id="popup">
            <h2>Batch Name </h2>
            <form action="batch-dashboard.php" method="POST">
                <input name="group" class="input-field" type="text" placeholder="Please Enter Your Batch Name">
                <br>
                <br>
                <textarea name="discription" class="input-discription" placeholder="Batch Discription"></textarea>
                <button value="submit" name="submit" type="submit" onclick="closePopup()">Create</button>
                <button onclick="closePopup()">Cancle</button>
            </form>
        </div>

        <br>


        <div class="container">
       <?php while($row= mysqli_fetch_assoc($batch_name_display)) {?>
        <div class="card">
      
        <a class="batchlink" href="batch-table.php?batch_name=<?php echo urlencode($row['batch_name']); ?>">
            <div class="card-section"><div class="batch"><?php echo $row['batch_name'] ?></div></div>
            <div class="card-section"><?php echo $row['discription'] ?></div>
        </a>
          
        </div>
        <?php } ?>

            <?php  ?>
                <!-- <p>No batches found.</p> -->
            <?php  ?>

       </div>

     

        
    </div>
</section>

     <script>
        let popup = document.getElementById('popup')

function openPopup(){
  popup.classList.add('open-popup')
}

function closePopup(){
  popup.classList.remove('open-popup')
}
     </script>

</body>
</html>

