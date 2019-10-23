<?php
require("../conn.php");
$sesion_key = $_COOKIE["tech_hash"];
if($sesion_key==''){
  header("Location: ../login");
}else{
  $check_hashkey = mysqli_query($conn,"select * from users where hashkey='$sesion_key';");
  if(mysqli_num_rows($check_hashkey)!=1){
    header("Location: ../login");
  }else{
    $hash=md5(rand());
    $quesations_list = $_POST['quesations_list'];
    $quiz_data = $_POST['quiz_data'];
    for($i=0;$i<count($quesations_list);$i++)
        {
        $quesation = $quesations_list[$i]['quesation'];
        $a_option = $quesations_list[$i]['a_option'];
        $b_option = $quesations_list[$i]['b_option'];
        $c_option = $quesations_list[$i]['c_option'];
        $d_option = $quesations_list[$i]['d_option'];
        $quesation_marks = $quesations_list[$i]['quesation_marks'];
        $quesation_answer = $quesations_list[$i]['quesation_answer'];
        $answer_type = $quesations_list[$i]['answer_type'];
        mysqli_query($conn,"insert into quesations (quesation,a_option,b_option,c_option,d_option,quesation_marks,quesation_answer,answer_type,hashkey) values ('$quesation','$a_option','$b_option','$c_option','$d_option','$quesation_marks','$quesation_answer','$answer_type','$hash');");
        }
        $quiz_name = $quiz_data['quiz_name'];
        $course_name = $quiz_data['course_name'];
        $start_time = $quiz_data['start_time'];
        $start_date = $quiz_data['start_date'];
        $end_date = $quiz_data['end_date'];
        $end_time = $quiz_data['end_time'];
        $max_quesation = $quiz_data['max_quesation'];
        $duration = $quiz_data['duration'];
        mysqli_query($conn,"insert into quiz_name (hash,quiz_name,course_name,start_time,start_date,end_date,end_time,max_quesation,duration) 
        values ('$hash','$quiz_name','$course_name','$start_time','$start_date','$end_date','$end_time','$max_quesation','$duration');");
    }
  }

?>