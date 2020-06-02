<?php
  // 1. Create a database connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $dbname = "smartfridge";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>

    <?php
    // grabs session of current user id 
    $user_id = $this->session->userdata('user_id'); 

    $query2 = "SELECT * "; 
    $query2 .= "FROM orders "; 
    $query2 .= "WHERE user_id = $user_id ";
    $Ordersresult = mysqli_query($connection, $query2);



?>


        <h3>Profile Information</h3>
        <table class="table table-bordered">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <tr>
                <td>
                    <?php echo $account->first_name; ?>
                </td>
                <td>
                    <?php echo $account->last_name; ?>
                </td>
                <td>
                    <?php echo $account->email; ?>
                </td>
                <td>
                    <?php echo $account->username; ?>
                </td>
                <td>
                    ******
                </td>
            </tr>
        </table>

        <h3>Recent Orders</h3>
        <table class="table table-bordered">
            <tr>
                <th>Item ID</th>
                <th>Order ID</th>
                <th>Price</th>
                <th>Shipped To</th>
                <th>Date Ordered Placed</th>
            </tr>

            <?php while($row2 = mysqli_fetch_assoc($Ordersresult)):?>

                <tr>
                    <td>
                        <?php echo $row2['product_id'];?>
                    </td>
                    <td>
                        <?php echo $row2['id'];?>
                    </td>
                    <td>
                        <?php echo $row2['price'];?>
                    </td>
                    <td>
                        <?php echo $row2['address'];?>
                    </td>
                    <td>
                        <?php echo date('y-m-d');?>
                    </td>
                </tr>
                <?php endwhile;?>
        </table>