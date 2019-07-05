<?php
// 전송받은 데이터를 비동기적으로 검증한다.
// DB엔 ajax로 php에 요청해 접근한다
// 검증에 실패하면 Fail 했다는 표시를 만들어 띄우자

require_once('MySQLConection.php');

$connect_object = MySQLConnection::DB_Connect('userdb') or die("Error Occured in Connection to DB");

$UserName = $_GET["UserName"];
$PageIdentifier = $_GET["PageIdentifier"];
$SiteURL = $_GET["SiteURL"];
$URL_ID = Hashing("sha256", $SiteURL);

// DB에서 등록된 Site 인지 찾음
$searchSite = "
  SELECT * FROM usersurltbl WHERE URL = '$SiteURL'
";

$ret = mysqli_query($connect_object, $searchSite);

// 등록되지 않은 요청은 거절
if(mysqli_num_rows($ret) < 1){
  echo ("등록되지 않은 URL 입니다.");
  exit ();
}

// 등록된 요청이라면 해당 URL의 DB가 존재.
// PageID의 테이블이 존재하는지 확인
// 존재한다면 해당 테이블의 댓글 데이터를 반환
if(MySQLConnection::isExist($URL_ID, $PageIdentifier)){
  echo "<iframe id='EV-Iframe' style='width:100%; border:none;' scrolling='no' src='http://evcommentservice.ga/Comment.php?db=$URL_ID&pageID=$PageIdentifier'></iframe>";
}
// 존재하지 않는다면 새 테이블을 생성한 후 컴포넌트만 반환
else {

  $connect_url = MySQLConnection::DB_Connect($URL_ID) or die("Error Occured in Connection to DB");

  $createNewTable = "
    CREATE TABLE `$URL_ID`.`$PageIdentifier`(
    	`CommentUserId` VARCHAR(20) NOT NULL,
      `Content` MEDIUMTEXT NOT NULL,
      `DateTime` DATETIME NOT NULL,
      `ProfileImageFileName` VARCHAR(25),
      `CommentIndex` INT(11) NOT NULL AUTO_INCREMENT,
      PRIMARY KEY(`CommentIndex`)
  )";

  $ret = mysqli_query($connect_url, $createNewTable);

  echo "<iframe id='EV-Iframe' style='width:100%; border:none;' scrolling='no' src='http://evcommentservice.ga/Comment.php?db=$URL_ID&pageID=$PageIdentifier'></iframe>";
}


function Hashing($Algorithm, $URL){
  return hash($Algorithm, $URL);
}
