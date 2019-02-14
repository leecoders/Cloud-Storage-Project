<?php
    $id = $_POST['id'];
    $password = $_POST['pw'];
    $password2 = $_POST['pw2'];
    $name = $_POST['name'];

    $host = 'localhost';
    $user = 'phpmyadmin';
    $pw = '123';
    $dbName = 'phpmyadmin';
    $mysqli = mysqli_connect($host, $user, $pw, $dbName);

    $sql = "INSERT INTO user (id, pw, name)
            VALUES ('$id', '$password', '$name')";
    if($password != $password2) {

      echo "<script> alert(\"비밀번호가 다릅니다.\"); </script>";
      echo "<script>
            document.location.href='http://49.173.169.2:10010/join.html';
            </script>";
    }

    else if ($mysqli->query($sql) === TRUE) {
      echo "<script>alert(\"가입 완료.\");</script>";
      echo "<script>
            document.location.href='http://49.173.169.2:10010';
            </script>";
    } else {
      echo "사용할 수 없는 아이디입니다.";
    }
?>
