<?php
session_start();
$authority = $_SESSION['authority'];
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dae Bak Cloud : 파일리스트</title>
  </head>
  <body>


    <?php
    // 폴더명 지정
    $dir = "/home/pi/ExtHDD/";

    // 핸들 획득
    $handle  = opendir($dir);

    $files = array();
    // $filebs = array();

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
    sort($filebs);
    ?>

    <script>
      function clickRemove(jb) {

        if('<?php echo $authority ?>' != 'GOLD') { // 'gold'등급이 아니면 삭제 못하도록 함.
          alert("GOLD 회원만 가능한 기능입니다.");
          exit();
        }
        if(confirm("정말 삭제하시겠습니까? ")) {
        var form = document.createElement("form");
        form.name = "file_name";
        form.method = "POST";
        form.action = "remove.php";

        var hiddenField = document.createElement("input");
        hiddenField.type = "HIDDEN";
        hiddenField.name = "hidden1";
        hiddenField.value = jb;

        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
      }
    }

      function clickDownload(jb) {
        var form = document.createElement("form");
        form.name = "file_name";
        form.method = "POST";
        form.action = "download.php";

        var hiddenField = document.createElement("input");
        hiddenField.type = "HIDDEN";
        hiddenField.name = "hidden1";
        hiddenField.value = jb;

        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();


      }

    </script>
    <?php
      $len = count($files);
      $i = 0;
      $count = 10;
      echo "<table>";
      echo "<style>
      table {
          border-collapse: separate;
          border-spacing: 1px;
          text-align: center;
          line-height: 1.5;
          margin: 20px 10px;
      }
      th {
          width: 220px;
          padding: 10px;
          font-weight: bold;
          vertical-align: top;
          color: #fff;
          background: #729DD2;
      }
      td {
          width: 100px;
          padding: 10px;
          vertical-align: top;
          border-bottom: 1px solid #ccc;
          background: #eee;
      }
      </style>";
      echo  "<tr>
        <th> 파일이름 </th>
        <th> 크기 </th>
        <th> 다운로드 </th>
        <th> 삭제  </th>

    </tr>";

      while($i<$len) {

        // $down_id = 'down'.$i;
        // $remove_id = 'remove'.$i;
      echo "<tr> <td> $files[$i] </td>";
      echo "<td>";

      $filebs[] = floor(filesize("/home/pi/ExtHDD/$files[$i]")/1000);
      if($filebs[$i] < 1000) {
          echo $filebs[$i];
          echo "KB";
      }
      else {
        echo floor($filebs[$i]/1000);
        echo "MB";
      }
    // echo  floor(filesize("/home/pi/ExtHDD/$files[$i]")/1000000)."MB";
      echo "</td>";
      echo "<td> <input type='button' value='다운로드' onclick='clickDownload($i)'/></td>
            <td> <input type='button'  value='삭제' onclick='clickRemove($i)'/> </td> </tr>";
        $i++;
      }
        echo  "</table>";
    ?>


</body>
</html>
