document.addEventListener('DOMContentLoaded', function () {
    index = 2;
    // Array di frasi da visualizzare
    const phrases = [
        "Your voice, our platform.",
        "Share. Study. Grow.",
        "Your story, our community."
    ];

    // Elemento HTML in cui visualizzare le frasi che cambiano
    const changingTextElement = document.getElementById('changingText');

    // Funzione per cambiare la frase ogni 15 secondi
    function changePhrase() {
        //const randomIndex = Math.floor(Math.random() * phrases.length);
        index = ((index + 1) % 3);
        changingTextElement.textContent = phrases[index];
    }

    // Cambia la frase iniziale all'avvio e imposta l'intervallo di cambio
    changePhrase();
    setInterval(changePhrase, 8000);
});