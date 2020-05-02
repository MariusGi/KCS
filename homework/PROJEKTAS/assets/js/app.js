const possibleOperations = ['+', '-'];

const startBtn           = document.getElementById('start-game');
const endTimeIndicator   = document.getElementById('end-time-indicator');
const firstOperand       = document.getElementById('math-problem-first-number');
const operation          = document.getElementById('math-problem-operation');
const secondOperand      = document.getElementById('math-problem-second-number');
const resultInput        = document.getElementById('math-problem-result');
const submitResultBtn    = document.getElementById('math-problem-submit');
const lastScoreVal       = document.getElementById('last-score-value');

const lastScoreheading   = document.querySelector('.last-score-heading');
const score              = document.querySelector('.game-score-value');
const gameClock          = document.querySelector('.game-clock-value');
const gameRulesWrapper   = document.querySelector('.game-rules-wrapper');
const gameClockWrapper   = document.querySelector('.game-clock-wrapper');
const exerciseWrapper    = document.querySelector('.exercise-content-wrapper');
const gameScoreWrapper   = document.querySelector('.game-score-wrapper');

const timeIncrement      = 3;
const stopWatchStartingTime = 30;

let stopWatchTime;
let scoreValue = 0;


startBtn.addEventListener('click', () => {
    stopWatchTime = stopWatchStartingTime;
    scoreValue = 0;
    generateMathProblem();
    startgameClock(stopWatchStartingTime);
});

submitResultBtn.addEventListener('click', () => {
    if(gameClock.innerHTML == '0') {
        return;
    }
        
    let isResultValid = validateResult();

    if(! isResultValid) {
        scoreValue--;
        elementStyleChangeAfterSubmit(score, 'color-red', 'font-size-40');
    } else {
        scoreValue++;
        elementStyleChangeAfterSubmit(score, 'color-green', 'font-size-40');
        incrementgameClock();
        elementStyleChangeAfterSubmit(gameClock, 'color-green', 'font-size-40');
    }

    score.innerHTML = scoreValue;
    generateMathProblem();
});

resultInput.addEventListener('keyup', (event) => {
    if (event.keyCode === 13) {
        // event.preventDefault();
        submitResultBtn.click();
    }
});

endTimeIndicator.addEventListener('click', () => {
    stopGame();
});


function generateMathProblem() {
    let randomFirstNumber  = Math.round(Math.random() * 100);
    let randomSecondNumber = Math.round(Math.random() * 100);
    let elementsToUnhide = [gameClockWrapper, exerciseWrapper, gameScoreWrapper];

        elementsToUnhide.forEach(element => {
            element.classList.remove('hidden');
        });

        gameRulesWrapper.classList.add('d-none');
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

function startgameClock() {
    decrementgameClock(stopWatchTime);
    
    let intervalgameClock = setInterval(() => {
        decrementgameClock(stopWatchTime);

        if(stopWatchTime < 0) {
            clearInterval(intervalgameClock);
            endTimeIndicator.click();
        }
    }, 1000);
}

function decrementgameClock() {
    gameClock.innerHTML = stopWatchTime;
    stopWatchTime--;
}

function incrementgameClock() {
    stopWatchTime += timeIncrement;
}

function elementStyleChangeAfterSubmit(element, colorToggleClass, sizeToggleClass) {
    element.classList.toggle(colorToggleClass);
    element.classList.toggle(sizeToggleClass);
    
    setTimeout(() => {
        element.classList.toggle(colorToggleClass);
        element.classList.toggle(sizeToggleClass);
    }, 1000);
}

function stopGame() {
    let elementsToHide = [gameClockWrapper, exerciseWrapper, gameScoreWrapper];

    elementsToHide.forEach(element => {
        element.classList.add('hidden');
    });

    firstOperand.innerHTML = ''
    operation.innerHTML = ''
    secondOperand.innerHTML = ''
    resultInput.value = '';
    gameRulesWrapper.classList.remove('d-none');
    lastScoreVal.innerHTML = scoreValue;
    lastScoreheading.classList.remove('d-none');
}