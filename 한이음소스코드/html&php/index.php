<?php
session_start();
session_destroy();
?>
<!-- 세션 만료 시키고 시작. why? 로그아웃 시에 세션 초기화하려고..
서버 사이드 언어는 문맥 상관없이 문서 받았을 때 서버가 순차적으로 읽어버림.. -->
<html>
<head>
  <title>
    Dae Bak Cloud : 로그인
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=640, user-scalable=yes">
  <style>
  .nonclick{
    text-decoration: none;
  }
  .loginbutton{
  display: block;
  width: 100%;
  height: 61px;
  margin: 10px 0 13px;
  padding-top: 1px;
  border: none;
  border-radius: 0;
  background-color: #729DD2;
  cursor: pointer;
  text-align: center;
  color: #fff;
  font-size: 18px;
  font-weight: 700;
  line-height: 61px;
  -webkit-appearance: none;
}
  </style>
</head>
<body bgcolor=#F5F6F7>
  <center>
    <br><br><br><br>
    <div>
      <font color=#729DD2 size=6><h1>Dae Bak Cloud</h1>
      </div>
      <div>
        <form name=frm1 action="login_check.php" method=post>
        </div>
        <table cellpadding=5>
          <tr>
            <td>
              <input type="text" id="userid" name="id" accesskey="L" placeholder="아이디" class="int" maxlength="41" style="width:300px; height:40px;">
            </td>
          </tr>
          <tr>
            <td>
              <input type="password" id="userpw" name="pw" placeholder="비밀번호" class="int" maxlength="16" onkeypress="capslockevt(event);getKeysv2();" onkeyup="checkShiftUp(event);" onkeydown="checkShiftDown(event);" style="width:300px; height:40px;">
            </td>
          </tr>
          <tr>
            <td colspan=2 align=center><input class="loginbutton" type=submit value="로그인">&nbsp;&nbsp;
              <a class="nonclick" href="join.html">회원이 아니신가요?</a>
            </td>
          </tr>
        </table>
      </form>
    </center>
  </body>
  </html>
