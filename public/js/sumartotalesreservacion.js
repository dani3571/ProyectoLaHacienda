const num1Input = document.getElementById("tranporte");
    const num2Input = document.getElementById("comida");
    const num3Input = document.getElementById("banioYCorte");
    const num4Input = document.getElementById("tratamiento");
    const num5Input = document.getElementById("extras");
    const resultInput = document.getElementById("total");

    num1Input.addEventListener("input", calculateSum);
    num2Input.addEventListener("input", calculateSum);
    num3Input.addEventListener("input", calculateSum);
    num4Input.addEventListener("input", calculateSum);
    num5Input.addEventListener("input", calculateSum);

    function calculateSum() {
    const num1 = parseFloat(num1Input.value) || 0;
    const num2 = parseFloat(num2Input.value) || 0;
    const num3 = parseFloat(num3Input.value) || 0;
    const num4 = parseFloat(num4Input.value) || 0;
    const num5 = parseFloat(num5Input.value) || 0;

    const sum = num1 + num2 + num3 + num4 + num5;

    resultInput.value = sum;
    }