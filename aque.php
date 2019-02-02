<?php
    if(!empty($_POST['name'])){
        $sql = "INSERT into que value(null,'".$_POST['name']."')";
        mysqli_query($link,$sql);

        $sql = "SELECT * from que where q_name = '".$_POST['name']."'";
        $ro = mysqli_query($link,$sql);
        $row = mysqli_fetch_assoc($ro);

        for($i=0;$i<count($_POST['option']);$i++){
            $sql = "INSERT into que_option value(null,'".$row['q_seq']."','".$_POST['option'][$i]."',0)";
            mysqli_query($link,$sql);
        }
        header("location:?admin=1&do=aque");
    }
?>

<fieldset>
    <legend>新增問卷</legend>
    <form method="post">
    問卷名稱<input name="name"><br>
    <span id="a">選項<input name="option[]"></span><input type="button" id="b" value="更多"><br>
    <input type="submit" value="新增"><input type="reset" value="清空">
    </form>
</fieldset>


<script>
    $("#b").click(function(){
        $("#a").append('<br>選項<input name="option[]">');
    });

</script>