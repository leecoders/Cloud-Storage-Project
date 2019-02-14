<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      // 폴더명 지정
      $dir = "/home/pi/ExtHDD/";

      // 핸들 획득
      $handle  = opendir($dir);

      $files = array();

      // 디렉터리에 포함된 파일을 저장한다.
      while (false !== ($filename = readdir($handle))) {
          if($filename == "." || $filename == ".."){
              continue;
          }

          // 파일인 경우만 목록에 추가한다.
          if(is_file($dir . "/" . $filename)){
              $files[] = $filename;
          }
      }

      // 핸들 해제
      closedir($handle);

      // 정렬, 역순으로 정렬하려면 rsort 사용
      sort($files);

      $index = $_POST['hidden1'];
      unlink("/home/pi/ExtHDD/".$files[$index]);
      echo "<script>
              alert(\"파일이 삭제되었습니다.\");
              document.location.href='http://49.173.169.2:10010/list.php';
            </script>"
    ?>

  </body>
</html>
