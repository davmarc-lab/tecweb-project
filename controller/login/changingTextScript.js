document.addEventListener('DOMContentLoaded', function () {
    const phrases = [
        "Your voice, our platform.",
        "Share. Study. Grow.",
        "Your story, our community.",
        "Ideas unleashed, knowledge shared.",
        "Empower your learning journey.",
        "Notes that spark brilliance.",
        "Collaborate, learn, achieve.",
        "Wisdom captured, connections made.",
        "Elevate your mind, share your notes.",
        "Inspiration in every annotation.",
        "Together we learn, together we grow.",
        "Notes that resonate, ideas that inspire.",
        "Unleash the power of shared knowledge."
    ];
    const changingTextElement = document.getElementById('changing-text');
    function changePhrase() {
        const randomIndex = Math.floor(Math.random() * phrases.length);
        changingTextElement.textContent = phrases[randomIndex];
    }
    changePhrase();
    setInterval(changePhrase, 4000);
});