<?php
  var_dump($_FILES);
  //元ファイル名の先頭にアップロード日時を加える
  $newfilename = date("YmdHis")."-".$_FILES['file_upload']['name'];
  //ファイルの保存先
  $upload = './image/'.$newfilename;
  //アップロードが正しく完了したかチェック
  if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $upload)){
    echo 'アップロード完了';
  }else{
    echo 'アップロード失敗';
  }
?>