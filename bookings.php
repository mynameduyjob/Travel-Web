<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - ĐẶT PHÒNG</title>
</head>
<body class="bg-light">

 <?php 

  require('inc/header.php'); 

  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
  }

 ?>



 <div class="container">
  <div class="row">

    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold">ĐẶT PHÒNG</h2>
      <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">ĐẶT PHÒNG</a>
      </div>
    </div>

    <?php

      $query = "SELECT bo.*, bd.* FROM booking_order bo
        INNER JOIN booking_details bd ON bo.booking_id = bd.booking_id
        WHERE ((bo.booking_status='booked')
        OR (bo.booking_status='cancelled')
        OR (bo.booking_status='payment failed'))
        AND (bo.user_id=?)
        ORDER BY bo.booking_id DESC";

      $result = select($query,[$_SESSION['uId']],'i');

      while($data = mysqli_fetch_assoc($result))
      {
        $date = date("d-m-Y",strtotime($data['datentime']));
        $checkin = date("d-m-Y",strtotime($data['check_in']));
        $checkout = date("d-m-Y",strtotime($data['check_out']));

        $status_bg ="";
        $btn = "";

        if($data['booking_status']=='booked')
        {
          $status_bg = "bg-success";
          if($data['arrival']==1)
          {
            $btn="<a class='btn btn-dark btn-sm shadow-none'>
              <i class='bi bi-file-earmark-arrow-down-fill'></i>
            </a>";
          }
        }
      }

    ?>

 

 

  </div>
 </div>




 <?php require('inc/footer.php'); ?>



</bodv>
</html>