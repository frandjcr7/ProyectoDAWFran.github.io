document.addEventListener("DOMContentLoaded", function () {
    // Alerta de formulario al enviarlo
    const form = document.querySelector("form");
    form.addEventListener("submit", function () {
        alert("Formulario enviado correctamente.");
    });

    // Scroll suave entre enlaces internos
    const links = document.querySelectorAll("a[href^='#']");
    links.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            // Desplazamiento suave a la sección correspondiente
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth"
            });
        });
    });

    // Animaciones al desplazarse (Intersection Observer)
    const sections = document.querySelectorAll("section");
    const options = {
        threshold: 0.3 // Cuando el 30% de la sección es visible
    };

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Añadimos una clase de visibilidad para animar la sección
                entry.target.classList.add("visible");
            }
        });
    }, options);

    // Observamos cada sección
    sections.forEach(section => {
        observer.observe(section);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let header = document.getElementById('header'); // Obtiene el elemento header
    let lastScrollTop = 0; // La posición del scroll anterior

    window.addEventListener("scroll", function() {
        let currentScroll = window.scrollY || document.documentElement.scrollTop; // Obtiene la posición actual del scroll

        // Si el scroll actual es mayor al anterior (está bajando)
        if (currentScroll > lastScrollTop) {
            // Ocultar el header moviéndolo fuera de la pantalla
            header.style.top = "-60px"; // Cambia el valor de "top" para ocultar el header (ajusta según el tamaño del header)
        } else {
            // Si el scroll actual es menor (está subiendo)
            header.style.top = "0"; // Vuelve a mostrar el header en la parte superior
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Evita que el scroll sea negativo
    });
});
