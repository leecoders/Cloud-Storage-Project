<?php
session_start(); // 로그아웃 시에는 session_destroy(); 해주면 됨. 세션 파괴. unset()은 데이터 제거.
$is_logged = $_SESSION['is_logged'];
$authority = $_SESSION['authority'];
if($is_logged=='YES') {
  $id = $_SESSION['user_id'];
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Dae Bak Cloud</title>
  <meta charset="utf-8">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
  .logoutButton {
    padding: .5em .75em;
    color: white;
    font-size: inherit;
    line-height: normal;
    vertical-align: middle;
    background-color: #337AB7;
    cursor: pointer;
    border: 1px solid #ebebeb;
    border-bottom-color: #e2e2e2;
    border-radius: .25em;
  }
  .submitbutton {
    padding: .5em .75em;
    color: white;
    font-size: inherit;
    line-height: normal;
    vertical-align: middle;
    background-color: #5cb85c;
    cursor: pointer;
    border: 1px solid #ebebeb;
    border-bottom-color: #e2e2e2;
    border-radius: .25em;
  }

  .filebox input[type="file"] {
    /* 파일 필드 숨기기 */
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
  }
  .filebox label {
    display: inline-block;
    padding: .5em .75em;
    color: white;
    font-size: inherit;
    line-height: normal;
    vertical-align: middle;
    background-color: #337AB7;
    cursor: pointer;
    border: 1px solid #ebebeb;
    border-bottom-color: #e2e2e2;
    border-radius: .25em;
  }
  .filebox .upload-name {
    display: inline-block;
    padding: .5em .75em; /* label의 패딩값과 일치 */
    font-size: inherit;
    font-family: inherit;
    line-height: normal;
    vertical-align: middle;
    background-color: white;
    border: 1px solid;
    border-bottom-color: black;
    border-radius: .25em;
    -webkit-appearance: none; /* 네이티브 외형 감추기 */
    -moz-appearance: none;
    appearance: none;
  }
  iframe{
    position: absolute;
    border:none;
    left: 360px;
    top: 170px;
  }
  .underbar{
    text-decoration: none;
    color:#ffffff;
  }
  a:visited {
    text-decoration: none;
    color:#ffffff;
  }
  .filelisttitle{
    position: absolute;
    font-size:30px;
    font-weight: 400;
    left: 380px;
    top: 130px;
  }
  </style>
  <script>
  var filter = "win16|win32|win64|mac|macintel";
  if ( navigator.platform ) {
    if ( filter.indexOf( navigator.platform.toLowerCase() ) < 0 ) {
      //mobile
      document.location.href='http://49.173.169.2:10010/mobile.php';
    }
  }
  function _(el){
    return document.getElementById(el);
  }
  function uploadFile(){
    var file = _("file1").files[0];
    // alert(file.name+" | "+file.size+" | "+file.type);
    var formdata = new FormData();
    formdata.append("file1", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "file_upload_parser.php");
    ajax.send(formdata);

  }
  function progressHandler(event){
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";

    if(Math.round(percent) == 100){
      alert('파일이 업로드 되었습니다.');
      document.location.href='http://49.173.169.2:10010/login_ok.php';
    }
  }
  function completeHandler(event){
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0;
  }
  function errorHandler(event){
    _("status").innerHTML = "업로드 실패";
  }
  function abortHandler(event){
    _("status").innerHTML = "파일이 손상되었습니다.";
  }
</script>
</head>
<body bgcolor=#F5F6F7>
  <div style="overflow: auto; background-color:#729DD2; height:115px;">
    <h1 style="margin-top:15px; color:white; font-size:50px;">&nbsp;&nbsp;<a class="underbar" href="login_ok.php">Dae Bak Cloud</a></h1>
  </div>

  <script> // 로그아웃 처리
  function logout() {
    window.location.href='http://49.173.169.2:10010/index.php';
  }
  </script>

  <div align="right" style= "margin-top:4px;">
    <span>
      <?php
      if($is_logged=='YES')
      echo "로그인 계정 : ".$id." [".$authority."]";
      else
      echo "로그인이 필요한 페이지입니다.";
      ?>
    </span>
    <span>
      <input class="logoutButton" type="button" value="로그아웃" onclick="logout()">
    </span>
  </div>

  <script>
  $(document).ready(function(){
    var fileTarget = $('.filebox .upload-hidden');
    fileTarget.on('change', function(){ // 값이 변경되면
      if(window.FileReader){ // modern browser
        var filename = $(this)[0].files[0].name;
      }
      else { // old IE
        var filename = $(this).val().split('/').pop().split('\\').pop(); // 파일명만 추출
      }
      // 추출한 파일명 삽입
      $(this).siblings('.upload-name').val(filename);
    });
  });
  </script>

  <table>
    <td>
      <tr>
        <div style="position: absolute; left:20px; top:130px;">
          <div style= "font-size:30px; font-weight: 400;">
            File upload
          </div>
          <br>
          <div id="file_upload" class="filebox" style="display:none">
          <form id="upload_form" enctype="multipart/form-data" method="post">
            <input class="upload-name" value="파일선택" disabled="disabled">

            <label for="file1">탐색</label>
            <input type="file" id=file1 name="file1" class="upload-hidden">

            <input class="submitbutton" type="button" value="업로드" onclick="uploadFile()"><br>

            <progress id="progressBar" value="0" max="100" style="width:340px;"></progress>
            <h4 id="status"></h4>
            <p id="loaded_n_total"></p>
          </form>
        </div>
      </div>
    </tr>

    <tr>
      <div style="position: absolute; text-align:center; left:20px; top:400px;"><br>
        <span style="border:5px inset #48BAE4; float: left; height: auto; width: 280px;">
          <img src="b.PNG" width="260" height="200" /></span>
          <div>
            <h2>저장용량 확인</h2>
            <!-- <h2> 사용가능 : 1000GB </h2> -->
            <?php
            function Get_DirByteSize($dst_dir)
            {
              $dir_size = 0;
              $rdi = new RecursiveDirectoryIterator($dst_dir);
              try {
                foreach (new RecursiveIteratorIterator($rdi,
                RecursiveIteratorIterator::LEAVES_ONLY,
                RecursiveIteratorIterator::CATCH_GET_CHILD) as $path) {

                  if ($path->isFile()) {
                    $dir_size += $path->getSize();
                  }
                }
              } catch(Exception $e) {
                echo "Message: ".$e->getMessage();
              }

              return floor($dir_size/1000000);
            }

            $dir_size = Get_DirByteSize("/home/pi/ExtHDD/");

            echo "\n 사용량 : ";
            echo "<span style='font-size:15;color:blue'>" . $dir_size . "MB\n"."</span>";
            echo "/ 사용가능 : 1000GB";

            ?>
          </div>
        </div>
      </tr>
    </td>
  </table>

  <div class="filelisttitle">
    Drive
  </div>

  <div id="iframe" class="iframe">
    <iframe src="list.php" width="1000" height="550"></iframe>
  </div>

  <script> // 세션 값 체크해서 로그인 시에만 보여주도록 하는 부분.
  if("<?php echo $is_logged ?>"=="YES") {
    document.getElementById("iframe").style.display="block";
    document.getElementById("file_upload").style.display="block";
    document.getElementById("logoutButton").style.display="block";
  }
  </script>

</body>
</html>
