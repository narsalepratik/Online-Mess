<?php
    require("header.php");
    require('database.php');

    if(!(isset($_SESSION['IS_LOGIN'])))
    {
        redirect('login.php');
    }
    
    $user = $_SESSION['USERNAME'];
    $email = $_SESSION['EMAIL'] ;

    if(isset($_REQUEST['id']) && $_REQUEST['type']=='delete')
    {
        $mess_name = mysqli_real_escape_string($con,$_REQUEST['id']);
        $query = "delete from favourite where email='$email' and mess_name='$mess_name' and user='$user'";
        // echo $query;
        $res = mysqli_query($con,$query);
        // $messdetails = mysqli_fetch_assoc($res);
        // prx($messdetails);
        
    }


    //getting New users & customers
        $query = "SELECT * from favourite f WHERE f.email='$email' and user='$user'";
        // echo $query;
        $result = mysqli_query($con,$query);
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // prx($data); 
        
    
    $i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My favourite messes |online mess</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <script src="https://use.fontawesome.com/c94c407848.js"></script>
    
</head>

<body>

    <section id="main">
        <div class="container">
            <!-- //handle mess  -->
            <div class="panel panel-default">
                <div class="panel-heading main-color-bg text-center">
                    <h1 class="panel-title"><h1>My Favourite messes</h1></h1>
                </div>
                <div class="panel-body text-capitalize table-responsive ">
                    <table class="table  table-striped table-hover table-font">
                        <thead>
                            <tr>
                            <th scope="col">Sr.no</th>
                              <th scope="col">Mess name</th>
                              <!-- <th scope="col"><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;City</th> -->
                              <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result)>0): 
                                 foreach($data as $key => $value): ?>
                            <tr>
                                <th scope="row"><?php echo $i;?></th>
                                <td><?php echo $value['mess_name'];?></td>
                                <!-- actions -->
                                <td>
                                    <a href="my_fav.php?id=<?php echo $value['mess_name']; ?>&type=delete" class="btn btn-danger btn-sm"><i class="fa fa-chain-broken" aria-hidden="true"></i>&nbsp;Unmark</a>
                                    &nbsp;
                                    <a href="detailsview.php?name=<?php echo $value['mess_name']; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details</a>
                                </td>
                            </tr>
                            <?php 
                            $i++;
                                 endforeach;
                                else: ?>
                                <tr>
                                    <td colspan="3" class="text-center text-danger"><h3>No any favourite mess added!! </h3></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>



    <script src="../bootstrap/bootstrap.min.js"></script>

    <!-- side bar toggle menu  -->
    <script>
        function openNav() {
            document.getElementById("mySidepanel").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidepanel").style.width = "0";
        }
    </script>
</body>
</html>