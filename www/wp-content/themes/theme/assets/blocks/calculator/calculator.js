jQuery(document).ready(function($) {
    // Ваш JS код для слайдера
    console.log('calc init');
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('calculate-button').addEventListener('click', function() {
        var num1 = document.getElementById('num1').value;
        var num2 = document.getElementById('num2').value;
        var operation = document.getElementById('operation').value;

        fetch(calculatorApi.apiUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                num1: num1,
                num2: num2,
                operation: operation
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.result !== undefined) {
                    document.getElementById('calculator-result').textContent = 'Результат: ' + data.result;
                } else if (data.code) {
                    document.getElementById('calculator-result').textContent = 'Ошибка: ' + data.message;
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                document.getElementById('calculator-result').textContent = 'Ошибка: Произошла ошибка';
            });
    });
});

// Устанавливаем URL API динамически
var calculatorApi = {
    apiUrl: document.getElementById('calculate-button').dataset.apiUrl
};