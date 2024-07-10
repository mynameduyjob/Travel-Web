<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php'); ?>
  <title><?php echo $settings_r['site_title'] ?> - HỒ SƠ</title>
</head>
<body class="bg-light">

 <?php 

  require('inc/header.php'); 

  if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
    redirect('index.php');
  }

  $u_exist = select("SELECT * FROM user_cred WHERE id=? LIMIT 1",[$_SESSION['uId']],'s');

  if(mysqli_num_rows($u_exist)==0){
    redirect('index.php');
  }

  $u_fetch = mysqli_fetch_assoc($u_exist);

 ?>



 <div class="container">
  <div class="row">

    <div class="col-12 my-5 px-4">
      <h2 class="fw-bold">HỒ SƠ</h2>
      <div style="font-size: 14px;">
        <a href="index.php" class="text-secondary text-decoration-none">TRANG CHỦ</a>
        <span class="text-secondary"> > </span>
        <a href="#" class="text-secondary text-decoration-none">HỒ SƠ</a>
      </div>
    </div>

    <div class="col-12 mb-5 px-4">
      <div class="bg-white p-3 p-md-4 rounded shadow-sm">
        <form id="info-form">
          <h5 class="mb-3 fw-bold">Thông tin cơ bản</h5>
          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label">Tên</label>
              <input name="name" type="text" value="<?php echo $u_fetch['name'] ?>" class="form-control shadow-none" required>
            </div>
             <div class="col-md-4 mb-3">
              <label class="form-label">Số Điện Thoại</label>
              <input name="phonenum" type="number" value="<?php echo $u_fetch['phonenum'] ?>" class="form-control shadow-none" required>
             </div>
             <div class="col-md-4 mb-3">
              <label class="form-label">Ngày sinh</label>
              <input name="dob" type="date" value="<?php echo $u_fetch['dob'] ?>"  class="form-control shadow-none" required>
             </div>
             <div class="col-md-4 mb-3">
              <label class="form-label">Pincode</label>
              <input name="pincode" type="number" value="<?php echo $u_fetch['pincode'] ?>" class="form-control shadow-none" required>
             </div>
             <div class="col-md-8 mb-4">
              <label class="form-label">Địa chỉ</label>
              <textarea name="address" class="form-control shadow-none" rows="1" required><?php echo $u_fetch['address'] ?></textarea>
             </div>
          </div>
          <button type="submit" class="btn text-white custom-bg shadow-none">Lưu thay đổi</button>
        </form>
      </div>
    </div>

    

 

 

  </div>
 </div>




 <?php require('inc/footer.php'); ?>
 <script>

  let info_form = document.getElementById('info-form');

  info_form.addEventListener('submit',function(e){
    e.preventDefault();

    let data = new FormData();
    data.append('info_form','');
    data.append('name',info_form.elements ['name'].value);
    data.append('phonenum',info_form.elements['phonenum'].value);
    data.append('address',info_form.elements['address'].value);
    data.append('pincode',info_form.elements ['pincode'].value);
    data.append('dob',info_form.elements['dob'].value);

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/profile.php",true);

    xhr.onload = function(){
      if(this.responseText == 'phone_already'){
        alert('Lỗi', "Số điện thoại đã được đăng ký!");
      }
      else if(this.responseText == 0){
        alert('error', "Không có thay đổi nào được thực hiện!");
      }
      else{
        alert('success','Đã lưu các thay đổi!');
      }
    }

    xhr.send(data);

  }) 
 </script>


</bodv>
</html>