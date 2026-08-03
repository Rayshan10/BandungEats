document.addEventListener("click", function (e) {

    const button = e.target.closest(".btn");

    if (!button) return;

    const ripple = document.createElement("span");

    const diameter = Math.max(
        button.clientWidth,
        button.clientHeight
    );

    ripple.classList.add("ripple");

    ripple.style.width = diameter + "px";
    ripple.style.height = diameter + "px";

    const rect = button.getBoundingClientRect();

    ripple.style.left =
        (e.clientX - rect.left - diameter / 2) + "px";

    ripple.style.top =
        (e.clientY - rect.top - diameter / 2) + "px";

    const oldRipple = button.querySelector(".ripple");

    if (oldRipple) {

        oldRipple.remove();

    }

    button.appendChild(ripple);

    ripple.addEventListener("animationend", () => {

        ripple.remove();

    });

});