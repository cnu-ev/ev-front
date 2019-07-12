var DeletingURLID;

function AddURLButtonClicked(){
  if(checkUrlForm($('#URL').val())){
    return true;
  }
  alert('올바른 URL 입력이 아닙니다. URL 입력을 확인해주세요.');
  return false;
}

// url 형식인지를 체크( http, https 를 포함하는 형식 )
function checkUrlForm(strUrl) {
    var expUrl = /^http[s]?\:\/\//i;
    return expUrl.test(strUrl);
}

function DeleteService(){

  $.ajax({
    type: "POST",
    url : "../php-Action/DeleteService.php",
    data : {
      URLID : DeletingURLID,
    },

    success : function(response) {
      console.log(response);
      $('#' + DeletingURLID).hide();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log("Ajax 수신에 실패했습니다!" + jqXHR.responseText);
    }
  })
}

function setIndexToDeleteRoom(urlID){
  DeletingURLID = urlID;
}
