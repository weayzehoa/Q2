<?php
    $msg="";
    if (!empty($_POST['mail'])) {
        $sql = "SELECT * from user where u_mail = '".$_POST['mail']."'";
        $ro = mysqli_query($link,$sql);
        $check = mysqli_num_rows($ro);
        $row = mysqli_fetch_assoc($ro);
        if($check==1){
            $msg="你的密碼為:".$row['u_pw'];
        }else{
            $msg="查無此資料";
        }
    }
?>

<form method="post">
<table width="80%" align="center">
    <tr>
        <td>請輸入信箱以查詢密碼</td>
    </tr>
    <tr>
        <td><input name="mail"></td>
    </tr>
    <tr>
        <td><?=$msg?></td>
    </tr>
    <tr>
        <td><input type="submit" value="尋找"></td>
    </tr>
</table>
</form>