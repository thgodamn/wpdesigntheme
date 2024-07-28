document.addEventListener('DOMContentLoaded', function() {

    function handleClick(event) {

        console.log(event);

        var parent_inputs = event.target.parentElement;
        var parent_block = parent_inputs.parentElement;

        console.log(parent);

        var num1 = parent_inputs.querySelector('.calculator__input-num1').value;
        var num2 = parent_inputs.querySelector('.calculator__input-num2').value;
        var operation = parent_inputs.querySelector('.calculator__operation').value;

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
                    parent_block.querySelector('.calculator__result-value').textContent = data.result;
                } else if (data.code) {
                    parent_block.querySelector('.calculator__result-value').textContent = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                parent_block.querySelector('.calculator__result-value').textContent = 'Error: an error has occurred';
            });
    }

    var clickInputs = document.querySelectorAll('.calculator__input , .calculator__operation');

    clickInputs.forEach(function(element) {
        // console.log(element);
        element.addEventListener('click', handleClick);
    });

    var calculatorApi = {
        apiUrl: document.querySelector('.calculator__operation').dataset.apiUrl
    };
});