<?php
require("../conn.php");
$sesion_key = $_COOKIE["student_hash"];
if($sesion_key==''){
  header("Location: ../login");
}else{
  $check_hashkey = mysqli_query($conn,"select * from studets where hashkey='$sesion_key';");
  if(mysqli_num_rows($check_hashkey)!=1){
    header("Location: ../login");
  }
  else{
   $id = mysqli_fetch_assoc($check_hashkey);
   $id = $id['id'];
   $main_data = $_POST['main_data'];
   $hashkey = $_POST['hashkey'];
   $result = 0;
   for($i=0;$i<count($main_data);$i++){
       $quesation = $main_data[$i]['quesation'];
       $answers = $main_data[$i]['answers'];
       $result = $result + check_answer($quesation,$answers);
   }
   mysqli_query($conn,"update result set marks='$result' where quiz_id='$hashkey' and id='$id';");
   echo "Ok";
  }
}

function check_answer($quesation,$answers){
    require("../conn.php");
    $get_answers = mysqli_query($conn,"select quesation_answer,quesation_marks from quesations where id='$quesation';");
    $answers1 = mysqli_fetch_assoc($get_answers);
    $get_answers = $answers1['quesation_answer'];
    $marks = $answers1['quesation_marks'];
    $get_answers = explode(",",$get_answers);
    $count = 0;
    for($i=0;$i<sizeof($answers);$i++){
        for($j=0;$j<sizeof($get_answers);$j++){
            if($answers[$i]==$get_answers[$j]){
                $count++;
            }
        }
    }
    if($count==sizeof($answers)){
        return $marks;
    }
    return 0;
}

?>