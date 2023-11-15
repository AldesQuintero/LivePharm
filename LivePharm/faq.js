// Expandir y contraer preguntas
function toggleAnswer(event) {
    var answer = event.target.nextElementSibling;
    if (answer.style.display == "none") {
        answer.style.display = "block";
    } else {
        answer.style.display = "none";
    }
}
