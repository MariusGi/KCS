const possibleOperations = ['+', '-'];
const startBtn           = document.getElementById('start-game');
// const endTimeIndicator   = document.getElementById('timer-end-indicator');
const firstOperand       = document.getElementById('math-problem-first-number');
const operation          = document.getElementById('math-problem-operation');
const equalsSign         = document.getElementById('math-problem-equals-sign');
const secondOperand      = document.getElementById('math-problem-second-number');
const resultInput        = document.getElementById('math-problem-result');
const submitResultBtn    = document.getElementById('math-problem-submit');
const score              = document.getElementById('math-problem-score');
const timer              = document.getElementById('timer');

let scoreValue = 0;

startBtn.addEventListener('click', function () {
    startTimer();
    generateMathProblem();

    // stopGame();
    // publishResult();
});

submitResultBtn.addEventListener('click', function () {
    if(timer.innerHTML == 'time 0')
        return;
    
    let isResultValid = validateResult();

    if(! isResultValid) {
        scoreValue--;
        score.innerHTML = scoreValue;
        scoreStyleChangeAfterSubmit('color-red', 'font-size-30');
        generateMathProblem();
    } else {
        scoreValue++;
        score.innerHTML = scoreValue;
        scoreStyleChangeAfterSubmit('color-green', 'font-size-30');
        generateMathProblem();
    }
});

resultInput.addEventListener('keyup', function (event) {
    if (event.keyCode === 13) {
        // event.preventDefault();
        submitResultBtn.click();
    }
});

// endTimeIndicator.addEventListener('change', function () {
//    alert('test'); 
// });

function generateMathProblem() {
    
    let randomFirstNumber  = Math.round(Math.random() * 100);
    let randomSecondNumber = Math.round(Math.random() * 100);
    
        startBtn.classList.add('d-none');
        firstOperand.innerHTML = randomFirstNumber;
        operation.innerHTML = returnRandomArrayElement(possibleOperations);
        secondOperand.innerHTML = randomSecondNumber;
        equalsSign.classList.remove('hidden');
        resultInput.value = '';
        resultInput.classList.remove('hidden');
        resultInput.focus();
        submitResultBtn.classList.remove('hidden');
        score.classList.remove('hidden');
}

function validateResult() {
    let firstOperandValue  = parseInt(firstOperand.innerHTML);
    let operationValue     = operation.innerHTML;
    let secondOperandValue = parseInt(secondOperand.innerHTML);
    let inputResult = resultInput.value;
    let correctResult = calculateMathProblem(firstOperandValue, operationValue, secondOperandValue);
    
    if(inputResult == correctResult) {
        return true;
    } else {
        return false;
    }
}

function calculateMathProblem(firstOperand, operation, secondOperand) {
    let result;
    
    switch(operation) {
        case '+':
            result = firstOperand + secondOperand;
            return result;
        case '-':
            result = firstOperand - secondOperand;
            return result;
        default:
            result = firstOperand + secondOperand;
            return result;
    }
}

function returnRandomArrayElement(arr) {
    let randomArrElement = arr[Math.floor(Math.random() * arr.length)];
    
    return randomArrElement;
}

function startTimer() {
    let time = 30;
    
    incrementTimer(time);
    
    let intervalTimer = setInterval(function() {
        time--;
        incrementTimer(time);
        if(time <= 0) {
            clearInterval(intervalTimer);
            // endTimeIndicator.value = '+';
        }
    }, 1000);
}

function incrementTimer(time) {
    timer.innerHTML = 'time ' + time;
}

function scoreStyleChangeAfterSubmit(colorToggleClass, sizeToggleClass) {
    score.classList.toggle(colorToggleClass);
    score.classList.toggle(sizeToggleClass);
    
    setTimeout(function () {
        score.classList.toggle(colorToggleClass);
        score.classList.toggle(sizeToggleClass);
    }, 1000);
}

function stopGame() {
    firstOperand.innerHTML = ''
    operation.innerHTML = ''
    secondOperand.innerHTML = ''
    equalsSign.classList.add('hidden');
    resultInput.value = '';
    resultInput.classList.add('hidden');
    submitResultBtn.classList.add('hidden');
    score.classList.add('hidden');
    startBtn.classList.remove('d-none');
}
