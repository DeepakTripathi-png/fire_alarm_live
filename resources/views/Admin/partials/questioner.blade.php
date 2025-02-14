<style>
    .quiz-popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        width: 400px;
    }

    .quiz-popup .progress-bar {
        background-color: #dc3545;
    }

    .quiz-popup h4 {
        text-align: center;
    }

    .quiz-popup .question {
        margin-top: 20px;
    }

    .quiz-popup .buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    #next-btn {
        margin-left: 0;
    }

    #previous-btn {
        margin-right: 0;
    }

    #next-btn {
        position: absolute;
        right: 10px;
        margin-top: -16px;
    }

    #previous-btn {
        position: absolute;
        left: 10px;
        margin-top: -16px;
    }
    #submit-btn {
        position: absolute;
        right: 10px;
        margin-top: -16px;
    }
</style>

<div class="quiz-popup" id="quiz-popup">
    <h4>Fire Alarm Acknowledgment Quiz</h4>
    <p>Answer the following questions to complete the acknowledgment process.</p>

    <div class="progress mb-3">
        <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>

    <div class="question" id="question-1">
        <h5>What should be your first action upon hearing a fire alarm?</h5>
        <input type="radio" name="question1" value="Acknowledge"> Acknowledge the alarm<br>
        <input type="radio" name="question1" value="Evacuate"> Evacuate the building<br>
        <input type="radio" name="question1" value="Ignore"> Ignore the alarm<br>
        <input type="radio" name="question1" value="Call"> Call emergency services<br>
    </div>

    <div class="question d-none" id="question-2">
        <h5>How do you acknowledge a fire alarm?</h5>
        <input type="radio" name="question2" value="Press"> Press the acknowledgment button<br>
        <input type="radio" name="question2" value="Call"> Call the fire department<br>
        <input type="radio" name="question2" value="Wait"> Wait for the alarm to stop<br>
        <input type="radio" name="question2" value="Evacuate"> Evacuate immediately<br>
    </div>

    <div class="question d-none" id="question-3">
        <h5>What steps must be taken after acknowledging the alarm?</h5>
        <input type="radio" name="question3" value="Check"> Check the alarm panel for details<br>
        <input type="radio" name="question3" value="Ignore"> Ignore further action<br>
        <input type="radio" name="question3" value="Evacuate"> Evacuate the building<br>
        <input type="radio" name="question3" value="Reset"> Reset the alarm system<br>
    </div>

    <div class="question d-none" id="question-4">
        <h5>How do you reset the fire alarm system?</h5>
        <input type="radio" name="question4" value="Press"> Press the reset button<br>
        <input type="radio" name="question4" value="Call"> Call the fire department<br>
        <input type="radio" name="question4" value="Wait"> Wait for an hour<br>
        <input type="radio" name="question4" value="Test"> Test the system<br>
    </div>

    <div class="question d-none" id="final-slide">
        <h5>Congratulations! You've completed the quiz.</h5>
        <p>Click Submit to finish the acknowledgment process.</p>
    </div>

    <div class="buttons">
        <button id="next-btn" class="btn btn-primary" disabled>Next</button>
        <button id="previous-btn" class="btn btn-secondary">Previous</button>
    </div>

    <button id="submit-btn" class="btn btn-success d-none">Submit</button>
</div>

<script>
$(document).on('click', '.acknowledge-btn', function(){
    const id = $(this).data('id'); 
    $('#quiz-popup').show(); 

    let currentQuestion = 0;
    const questions = $('#quiz-popup .question');
    const progressBar = $('#progress-bar');
    const nextBtn = $('#next-btn');
    const previousBtn = $('#previous-btn');
    const submitBtn = $('#submit-btn');

    function showQuestion(index) {
        questions.hide().eq(index).show();
        progressBar.css('width', `${((index + 1) / questions.length) * 100}%`);
    
        nextBtn.prop('disabled', index === questions.length - 1);
        
        previousBtn.toggle(index > 0);
        submitBtn.toggleClass('d-none', index !== questions.length - 1);
    }

 
    nextBtn.on('click', function() {
        if (currentQuestion < questions.length - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
        }
    });

    previousBtn.on('click', function() {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
        }
    });

    submitBtn.on('click', function() {
        $('#quiz-popup').hide(); 
    });
    showQuestion(currentQuestion); 
});
</script>


    

