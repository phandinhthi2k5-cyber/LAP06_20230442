document.addEventListener("DOMContentLoaded", () => {
    const petals = document.querySelector(".petals");
    if (!petals) return;

    const COUNT = 25;

    for (let i = 0; i < COUNT; i++) {
        const s = document.createElement("span");
        s.style.left = Math.random() * 100 + "vw";
        s.style. height = (15 + Math.random() * 20) + "px";
        s.style.width = s.style.height;
        s.style.animationDuration =
            (10 + Math.random() * 10) + "s, " +
            (5 + Math.random() * 6) + "s";
        petals.appendChild(s);
    }
});
