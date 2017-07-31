<?php
	$conn =  mysql_connect('localhost','skipperhoa','0975595084') or die("kết nối không thành công!");
  //select database
  mysql_select_db('basic_nodejs',$conn);
  mysql_query("set names 'utf8'");
  $data = json_decode(file_get_contents("php://input"));//láy tất cả các thông tin chuyển về kểu json 
  $ketqua = array();//tạo mảng lưu thông tin kiểm tra
  if($data->username!="" && $data->password!=""){
  	 $sql = "SELECT * FROM users WHERE USERNAME ='".$data->username."' and PASSWORD='".md5($data->password)."'";
     $result = mysql_query($sql,$conn);
     if(mysql_num_rows($result)>0){//kiểm tra nếu tồn tại có trong CSDL
        $rows = mysql_fetch_array($result);

        if($rows['USERNAME']==$data->username && $rows['PASSWORD']==md5($data->password)){

            $ketqua['success']=1;///đăng nhập thành công!
            echo json_encode($ketqua);
        }
        else{
          $ketqua['success']=2;// Bạn đang cố gắng đăng nhập
          echo json_encode($ketqua);

        }

     }
     else{
        $ketqua['success']=0;// Bạn đăng nhập không thành công
        echo json_encode($ketqua);

     }

  }
  else{

     $ketqua['success']=0;// Bạn đăng nhập không thành công
     echo json_encode($ketqua);
  }
?>