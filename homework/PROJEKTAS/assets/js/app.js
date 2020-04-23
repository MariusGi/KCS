const possibleOperations = ['+', '-'];
const startBtn           = document.getElementById('start-game');
const firstOperand       = document.getElementById('math-problem-first-number');
const operation          = document.getElementById('math-problem-operation');
const equalsSign         = document.getElementById('math-problem-equals-sign');
const secondOperand      = document.getElementById('math-problem-second-number');
const resultInput        = document.getElementById('math-problem-result');
const submitResultBtn    = document.getElementById('math-problem-submit');
const score              = document.getElementById('math-problem-score');

let scoreValue = 0;

startBtn.addEventListener('click', function () {
    generateMathProblem();
});

submitResultBtn.addEventListener('click', function () {
    let isResultValid = validateResult();

    if(! isResultValid) {
        
    } else {
        scoreValue++;
        score.innerHTML = scoreValue;
        generateMathProblem();
    }
});

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
