<?php
	include_once 'connect.php';
	session_start();
  if(!isset($_SESSION['id'])){
      header("location:login.php");
      die();
  }
	//Retreive userID from session
	$userID = $_SESSION['id'];
	//Retreiving information related to the user
	$Quary= "SELECT u.user_id,u.user_firstName,u.user_lastName,u.user_mobile,COUNT(c.claim_id) as claim_count FROM users u INNER JOIN claims c ON u.user_id = c.user_id WHERE u.user_id = '$userID' GROUP BY u.user_id";
	$result = mysqli_query($db, $Quary);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Life Insurance Account</title>
  <link rel="stylesheet"type="text/css" href="css/dashstyle.css">
</head>
<body>
  <div class="container">
    <div class="profile-details">
      <h2>Profile Details</h2>
      <div class="username-container">
      <?php
        if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
      ?>
      <h3>Customer Name - <?php echo $row["user_firstName"]. " " . $row["user_lastName"];?></h3>
      </div>
      <table>
        <tr>
          <th>Customer ID</th>
          <td><?php echo $row["user_id"];?></td>
        </tr>
        <tr>
          <th>Mobile Number</th>
          <td><?php echo $row["user_mobile"];?></td>
        </tr>
        <tr>
          <th>Total Claims</th>
          <td><?php echo $row["claim_count"];?></td>
        </tr>
      </table>
      <?php
        }
        else{
          echo "<script>alert('Hmmm we could not find your account, Contact customer support or register as a new customer!');
          window.location.href='login.php';
          </script>";
        }
      ?>
    </div>
    
    <div class="claim-details">
      <h2>Claim Details</h2>
      <table>
        <tr>
          <th>Claim ID</th>
          <th>Date</th>
          <th>Amount</th>
          <th>Status</th>
        </tr>
        <?php
            $claimQuary= "SELECT * FROM claims WHERE user_id = '$userID'";
            $claimResult = mysqli_query($db, $claimQuary);
            if(mysqli_num_rows($claimResult) > 0){
              while($claimRow = mysqli_fetch_assoc($claimResult)) {
        ?>
        <tr>
          <td><?php echo $claimRow["claim_id"];?></td>
          <td><?php echo $claimRow["claim_date"];?></td>
          <td><?php echo $claimRow["claim_amount"];?></td>  
          <td><?php echo $claimRow["claim_status"];?></td>  
        </tr>
        <?php
              }
            } else { ?>
              <tr>
                <td colspan="4">No claim information found</td>
              </tr>  
        <?php }  
        ?>	        
      </table>
    </div>
    <div class="payment-details">
        <h2>Payment History</h2>
        <table>
          <tr>
            <th>Date</th>
            <th>Amount</th>
          </tr>
          <?php
              $PaymentQuary= "SELECT * FROM payments WHERE user_id = '$userID'";
              $paymentResult = mysqli_query($db, $PaymentQuary);
              if(mysqli_num_rows($paymentResult) > 0){
                while($paymentRow = mysqli_fetch_assoc($paymentResult)) {
          ?>
          <tr>  
            <td><?php echo $paymentRow["payment_date"];?></td>
            <td><?php echo $paymentRow["payment_amount"];?></td>
          </tr>
          <?php
                }
              } else { ?>
                <tr>
                  <td colspan="2">No payment information found</td>
                </tr>  
          <?php }  
            //Closing DB connection
            mysqli_close($db);
          ?>	   
        </table>
      </div>
      <div>
        <button class="button" >New Claim</button>
      </div>
  </div>
  </body>
  </html>

  

  