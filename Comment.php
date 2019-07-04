<?php
  require_once('php-Action\MySQLConection.php');

  $URL = $_GET['db'];
  $PageID = $_GET['pageID'];

  $connect_object = MySQLConnection::DB_Connect($URL);

  

?>

<!DOCTYPE html>
<html lang="kr" dir="ltr">
  <head>
    <title>EV Comments</title>
    <meta charset="utf-8">
    <!-- 반응형 웹페이지를 위한 viewport 설정 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- Bootstrap 스타일 시트를 적용. min이 붙은 것은 난독화 파일이기 때문.-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/comment.css">
  </head>
  <body>
    <div id="EV-Container" class="container">
      <!-- 현재 댓글의 갯수, 로그인 되어 있는 ID를 나타내는 NavBar -->
      <header id="EV-nav">
        <ul>
          <li id="EV-CommentNumber" class="nav-tab">Comments</li>
          <li id="EV-UserID" class="nav-tab"></li>
          <li id="EV-Feedback" class="nav-tab"></li>
          <li style="float:right;"><img id="connectedUser-Avatar" class="comment-avatar" width="25px" height="25px" class="img-fluid rounded-circle" src="img/userDefaultProfile.svg" alt="Image For User Profile"></li>
        </ul>
      </header>
      <!-- 댓글 창들의 모음 컨테이너 -->
      <div>
        <div id="EV-UserInputArea">
          <!-- Avatar (셋팅된 프로필 사진) -->
            <!-- 댓글 입력 창 -->
            <div class="textarea-outer col-sm-12">
              <span id="Textarea-placeholder">여기에 텍스트를 입력하세요..</span>
              <div id="CommentArea" class="alignLeft" width="100%" tabindex="0" role="textbox" aria-multiline="true" contenteditable="PLAINTEXT-ONLY" data-role="editable" class="text-right" title="Join the discussion..."></div>
            </div>
          <div id="EV-Buttons">
            <ul>
              <li><b>B</b></li>
              <li><i>I</i></li>
              <li><u>U</u></li>
              <li><s>S</s></li>
              <li id="post-button">제출</li>
            </ul>
          </div>
        </div>
        <hr>
        <!-- 댓글 -->
        <div id="EV-comment">
          <ul>

          </ul>
        </div>
      </div>
      <hr>
      <footer id="EV-Footer">
        <p style="padding-top: 7px;">&copy; 2019 Team EV</p>
      </footer>
    </div>
  </body>

  <!-- 제이쿼리 자바스크립트 추가하기 -->
  <script src="./lib/jquery-3.2.1.min.js"></script>
  <!-- Popper 자바스크립트 추가하기 -->
  <script src="./lib/popper.min.js"></script>
  <!-- 부트스트랩 자바스크립트 추가하기 -->
  <script src="./lib/bootstrap.min.js"></script>
  <!-- MDB 라이브러리 추가하기 -->
  <script src="./lib/mdb.min.js"></script>
  <!-- 커스텀 자바스크립트 추가하기 -->
  <script src="./js/comment.js"></script>

</html>
