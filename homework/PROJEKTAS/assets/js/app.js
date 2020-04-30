const possibleOperations = ['+', '-'];
const startBtn           = document.getElementById('start-game');
const endTimeIndicator   = document.getElementById('end-time-indicator');
const firstOperand       = document.getElementById('math-problem-first-number');
const operation          = document.getElementById('math-problem-operation');
const equalsSign         = document.getElementById('math-problem-equals-sign');
const secondOperand      = document.getElementById('math-problem-second-number');
const resultInput        = document.getElementById('math-problem-result');
const submitResultBtn    = document.getElementById('math-problem-submit');
const score              = document.getElementById('math-problem-score');
const timer              = document.getElementById('timer');
const timeIncrement      = 3;
const stopWatchStartingTime = 5;

let stopWatchTime;
let scoreValue = 0;


startBtn.addEventListener('click', function () {
    stopWatchTime = stopWatchStartingTime;
    scoreValue = 0;
    generateMathProblem();
    startTimer(stopWatchStartingTime);
});

submitResultBtn.addEventListener('click', function () {

    if(timer.innerHTML == '0') {
        return;
    }
        
    let isResultValid = validateResult();

    if(! isResultValid) {
        scoreValue--;
        elementStyleChangeAfterSubmit(score, 'color-red', 'font-size-30');
    } else {
        scoreValue++;
        elementStyleChangeAfterSubmit(score, 'color-green', 'font-size-30');
        incrementTimer();
        elementStyleChangeAfterSubmit(timer, 'color-green', 'font-size-30');
    }

    score.innerHTML = scoreValue;
    generateMathProblem();

});

resultInput.addEventListener('keyup', function (event) {
    if (event.keyCode === 13) {
        // event.preventDefault();
        submitResultBtn.click();
    }
});

endTimeIndicator.addEventListener('click', function () {
    stopGame();
});


function generateMathProblem() {
    
    let randomFirstNumber  = Math.round(Math.random() * 100);
    let randomSecondNumber = Math.round(Math.random() * 100);
    let elementsToUnhide = [equalsSign, resultInput, submitResultBtn, score, timer];

        elementsToUnhide.forEach(element => {
            element.classList.remove('hidden');
        });

        startBtn.classList.add('d-none');
        firstOperand.innerHTML = randomFirstNumber;
        operation.innerHTML = returnRandomArrayElement(possibleOperations);
        secondOperand.innerHTML = randomSecondNumber;
        resultInput.value = '';
        resultInput.focus();
        score.innerHTML = scoreValue;

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
    
    decrementTimer(stopWatchTime);
    
    let intervalTimer = setInterval(function() {
        decrementTimer(stopWatchTime);

        if(stopWatchTime < 0) {
            clearInterval(intervalTimer);
            endTimeIndicator.click();
        }
    }, 1000);
}

function decrementTimer() {
    timer.innerHTML = stopWatchTime;
    stopWatchTime--;
}

function incrementTimer() {
    stopWatchTime += timeIncrement;
}

function elementStyleChangeAfterSubmit(element, colorToggleClass, sizeToggleClass) {
    element.classList.toggle(colorToggleClass);
    element.classList.toggle(sizeToggleClass);
    
    setTimeout(function () {
        element.classList.toggle(colorToggleClass);
        element.classList.toggle(sizeToggleClass);
    }, 1000);
}

function stopGame() {

    let elementsToHide = [equalsSign, resultInput, submitResultBtn, timer];

    elementsToHide.forEach(element => {
        element.classList.add('hidden');
    });

    firstOperand.innerHTML = ''
    operation.innerHTML = ''
    secondOperand.innerHTML = ''
    resultInput.value = '';
    startBtn.classList.remove('d-none');

}