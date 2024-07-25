document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('calculator__operation').addEventListener('click', function() {
        var num1 = document.getElementById('calculator__num1').value;
        var num2 = document.getElementById('calculator__num2').value;
        var operation = document.getElementById('calculator__operation').value;

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
                    document.getElementById('calculator-result').textContent = 'Result: ' + data.result;
                } else if (data.code) {
                    document.getElementById('calculator-result').textContent = 'Error: ' + data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('calculator-result').textContent = 'Error: an error has occurred';
            });
    });
});

// Устанавливаем URL API динамически
var calculatorApi = {
    apiUrl: document.getElementById('calculator__operation').dataset.apiUrl
};