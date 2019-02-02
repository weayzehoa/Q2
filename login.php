<?php
    if(!empty($_POST['id']) && !empty($_POST['pw'])){
        $sql = "SELECT * from user where u_id = '".$_POST['id']."'";
        $ro = mysqli_query($link,$sql);
        $checkid = mysqli_num_rows($ro);
        $row = mysqli_fetch_assoc($ro);
        if($checkid == 1){
            if($row['u_pw'] == $_POST['pw']){
                $_SESSION['id']=$row['u_id'];
                    header("location:index.php");
            }else{
                echo "<script>alert('密碼錯誤');</script>";
            }
        }else{
            echo "<script>alert('查無帳號');</script>";
        }
    }

?>
<form method="post">
<fieldset style="width:500px; margin:0 auto;">

<legend>會員登入</legend>
	<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <th align="center" scope="col">帳號</th>
      <th align="center" scope="col">
        <input type="text" name="id"></th>
    </tr>
    <tr>
      <th align="center" scope="row">密碼</th>
      <td align="center">
        <input type="text" name="pw"></td>
    </tr>
    <tr>
      <th align="center" scope="row"><input type="submit" name="submit" id="submit" value="登入">
        <input type="reset" name="reset" id="reset" value="清除"></th>
      <th align="center" scope="row"><a href="?do=forget">忘記密碼</a>｜<a href="?do=reg">尚未註冊</a></th>
      </tr>
  </tbody>
</table>
</fieldset>
</form>