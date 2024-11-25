<?php
$con = new mysqli("localhost", "root", "", "smartnotes_db");

class Survey
{
    public $questions_answers;
    static function seenSurvey($user_id)
    {
        if ($user_id != "") {
            $sql = "SELECT 1 FROM user_survey_answers WHERE user_id = $user_id LIMIT 1";
            $result = $GLOBALS['con']->query($sql);
            return $result && $result->num_rows > 0;
        }
        return false;
    }

    static function submitSurveyAnswers($user_id, $question_id, $answer)
    {
        if (!empty($user_id) && !empty($question_id) && !empty($answer)) {
            $sql = "INSERT INTO user_survey_answers (user_id, question_id, answer) VALUES ($user_id, $question_id, $answer)";
            $result = mysqli_query($GLOBALS['con'], $sql);
            return $result;
        }
    }
}
?>