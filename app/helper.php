<?php 

use App\ResultDetail;

    function is_correct_mcq($result_id,$ques_id,$answer_id){
        $a = ResultDetail::where([['result_id',$result_id],['question_id',$ques_id],['answer_id',$answer_id]])->get();
       return  count($a) > 0 ? true:false;
        
    }


?>