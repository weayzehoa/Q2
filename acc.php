<?php
    if(!empty($_POST['id'])){
        if(empty($_POST['pw']) || empty($_POST['pw2']) || empty($_POST['mail'])){
            echo "<script>alert('不可空白')</script>";
        }else{
            $sql = "SELECT * from user where u_id ='".$_POST['id']."'";
            $ro = mysqli_query($link,$sql);
            $checkid = mysqli_num_rows($ro);
            if($checkid==1){
                echo "<script>alert('帳號重複')</script>";
            }else{
                $sql = "INSERT into user value(null,'".$_POST['id']."','".$_POST['pw']."','".$_POST['mail']."')";
                mysqli_query($link,$sql);
                header("location:?admin=1&do=acc");
            }
        }
    }

    if(!empty($_POST['del'])){
        for($i=0; $i<count($_POST['del']); $i++){
            $sql = "DELETE from user where u_seq ='".$_POST['del'][$i]."'";
            mysqli_query($link,$sql);
            header("location:?admin=1&do=acc");
        }
    }

    $sql = "SELECT * from user";
    $ro1 = mysqli_query($link,$sql);
    $row1 = mysqli_fetch_assoc($ro1);
?>


<form method="post">
<fieldset>

<legend>帳號管理</legend>
	<table width="80%" border="0" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    <tr>
        <td align="center">帳號</td>
        <td align="center">密碼</td>
        <td align="center">刪除</td>
    </tr>
    <?php do {
        ?>
    <tr>
        <td align="center"><?=$row1['u_id']?></td>
        <td align="center"><?=$row1['u_pw']?></td>
        <td align="center"><input type="checkbox" name="del[]" value="<?=$row1['u_seq']?>"></td>
    </tr>
    <?php
    }while($row1 = mysqli_fetch_assoc($ro1))?>
    <tr>
        <td align="center" colspan="3">
            <input type="submit" name="submit" id="submit" value="確定刪除">
            <input type="reset" name="reset" id="reset" value="清空選取">
        </td>
    </tr>
  </tbody>
</table>

<h3>新增會員</h3>
<table width="80%" border="1" cellspacing="0" cellpadding="5" align="center">
  <tbody>
    <tr>
        <td colspan="2" style="color:red">＊請設定您要註冊的帳號及密碼(最長12個字元)</td>
    </tr>
    <tr>
        <td align="center" width="50%">Step1:登入帳號</td>
        <td><input name="id" maxlength="12"></td>
    </tr>
    <tr>
        <td align="center" >Step2:登入密碼</td>
        <td><input name="pw" maxlength="12"></td>
    </tr>
    <tr>
        <td align="center" >Step3:再次確認密碼</td>
        <td><input name="pw2" maxlength="12"></td>
    </tr>
    <tr>
        <td align="center" >Step4:信箱（忘記密碼時使用）</td>
        <td><input name="mail"></td>
    </tr>
    <tr>
        <td align="center" colspan="2"><input type="submit" value="註冊"><input type="reset" value="清除"></td>
    </tr>
  </tbody>
</table>
</fieldset>
</form>