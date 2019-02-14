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

      $file_name = basename($files[$index]);
      $file_path = '/home/pi/ExtHDD/'.$files[$index];
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Pragma: public');
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$file_name");
      header("Content-Type: application/zip");
      header("Content-Transfer-Encoding: binary");
      header('Connection: Keep-Alive');
      header('Expires: 0');

      ob_clean();
      flush();
      readfile($file_path);

      // unlink("/home/pi/ExtHDD/".$files[$index]);
    
    ?>

  </body>
</html>
