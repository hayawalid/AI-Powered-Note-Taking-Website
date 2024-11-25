<?php
include_once 'survey_class.php';

if (!isset($_SESSION['UserID'])) {
    die('User not logged in.');
}

$seenSurvey = Survey::seenSurvey($_SESSION['UserID']);

if (isset($_POST['submitSurvey'])) {
    $user_id = $_SESSION['UserID'];
    error_log("Usage: " . $_POST['usage']);
    error_log("Age Group: " . $_POST['age-group']);
    error_log("Feature: " . $_POST['feature']);
    

    
    $answers = [
        1 => $_POST['usage'], // Question 1 answer
        2 => $_POST['age-group'], // Question 2 answer
        3 => $_POST['feature'] // Question 3 answer
    ];
    
    foreach ($answers as $question_id => $answer_value) {
        Survey::submitSurveyAnswers($user_id, $question_id, $answer_value);
    }
}

// Only display the survey if the user hasn't seen it yet
if (!$seenSurvey) {
    echo "<div id='survey-overlay' class='survey-overlay'>
    <div class='survey-popup'>
      <div class='progress-indicator' id='progress-indicator'>
        <span class='dot active'></span>
        <span class='dot'></span>
        <span class='dot'></span>
      </div>
      <form method='POST' action='' id = 'form'>
      <div class='survey-page img-div' id='page-0'>
        <div class='right-div'>
            <div class='column-text right'>
                <p>Welcome to SmartNotes</p>
                <h6>Empowering Your Productivity, One Note at a Time.</h6>
                <input class='btn-survey-primary' id='continue-btn' value='Continue' type='button'>
            </div>
        </div>
      </div>
      <div class='survey-page' id='page-1'>
        <div class='row'>
            <div class='column-text left'>
                <p class='title'>Customize Your SmartNotes Experience</p>
                <h6 class='question'>How do you primarily plan to use SmartNotes?</h6>
                <p class='message'>Pick the one that best describes your usage. <br> You can change your mind later.</p>
            </div>
            <div class='right-div choices'> 
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-buildings' style='color: #8eb0f0; font-size: 35px'></i>
                        <span>Work</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='usage' value='Work'>
                    </div>
                </div>
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-house-door' style='color: #f2e982; font-size: 35px'></i>
                        <span>Personal</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='usage' value='Personal'>
                    </div>
                </div>
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-backpack2' style='color: #c6408a; font-size: 35px'></i>
                        <span>School</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='usage' value='School'>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class='survey-page hidden' id='page-2'>
        <div class='row'>
            <div class='column-text left'>
                <p class='title'>Customize Your SmartNotes Experience</p>
                <h6 class='question'>What is your age-group?</h6>
                <p class='message'>Pick the one that best describes your usage. <br> You can change your mind later.</p>
            </div>
            <div class='right-div choices'> 
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-person-arms-up' style='color: #8eb0f0; font-size: 35px'></i>
                        <span>18 - 24</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='age-group' value='13 - 27'>
                    </div>
                </div>
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-person-walking' style='color: #f2e982; font-size: 35px'></i>
                        <span>27 - 42</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='age-group' value='27 - 42'>
                    </div>
                </div>
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-person-raised-hand' style='color: #c6408a; font-size: 35px'></i>
                        <span>43 +</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='age-group' value='43 +'>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class='survey-page hidden' id='page-3'>
        <div class='row'>
            <div class='column-text left'>
                <p class='title'>Customize Your SmartNotes Experience</p>
                <h6 class='question'>Which of our features are you most interested in?</h6>
                <p class='message'>Pick the one that best describes your usage. <br> You can change your mind later.</p>
            </div>
            <div class='right-div choices'> 
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-soundwave' style='color: #8eb0f0; font-size: 35px'></i>
                        <span>Speech to text transcription</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='feature' value='speech-to-text'>
                    </div>
                </div>
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-stickies' style='color: #f2e982; font-size: 35px'></i>
                        <span>AI note summarization</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='feature' value='summarization'>
                    </div>
                </div>
                <div class='choice'>
                    <div class='choice-radio-button'>
                        <i class='bi bi-card-checklist' style='color: #c6408a; font-size: 35px'></i>
                        <span>AI quiz generation</span>
                    </div>
                    <div class='radio-btn'>
                        <input type='radio' name='feature' value='Q&A'>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <input id='finish-button' class='hidden btn-survey-primary' value='Continue' type='submit' name='submitSurvey'>
     </form>
    </div>
</div>";
}
?>