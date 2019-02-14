<?
 include "/var/www/html/db_info.php";

 $id=$_GET['userid'];

 $host = 'localhost';
 $user = 'phpmyadmin';
 $pw = '123';
 $dbName = 'phpmyadmin';
 $mysqli = mysqli_connect($host, $user, $pw, $dbName);

 $result = mysqli_query($mysqli, "SELECT count(*) FROM user WHERE id = '$id'");
 $row = mysqli_fetch_array($result);



 mysql_close($conn);

?>
<script>
 var row="<?=$row[0]?>";
 if(row==1){
 parent.document.getElementById("chk_id2").value="0";
 parent.alert("이미 사용중인 아이디입니다.");
 }
 else{
 parent.document.getElementById("chk_id2").value="1";
 parent.alert("사용 가능합니다.");
 }
</script>
