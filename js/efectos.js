document.addEventListener('DOMContentLoaded', () => {

var player;
    
    // 1. SALUDADOR Y ESCRITURA
    const elemento = document.getElementById('typing-text');
    if (elemento) {
        const hora = new Date().getHours();
        const frase = (hora >= 18 || hora <= 6) 
            ? "Welcome to the Night City. Follow all the news: 'Songs', 'Shows', 'Merch'..." 
            : "Waiting for The Midnight... Follow all the news: 'Songs', 'Shows', 'Merch'...";

        elemento.innerText = ''; 
        let i = 0;
        function escribir() {
            if (i < frase.length) {
                elemento.innerHTML += frase.charAt(i);
                i++;
                setTimeout(escribir, 50);
            }
        }
        escribir();
    }

    // 2. APARICIÓN SUAVE (SCROLL REVEAL)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    document.querySelectorAll('.section, .card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s ease-out';
        observer.observe(el);
    });
});

// Función simple para el botón (sin memoria)
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}


// Variable para controlar si el video ya está listo
// var player;   ya colocado Arriba

function onYouTubeIframeAPIReady() {
    player = new YT.Player('videoShadows');
}

function toggleDarkMode() {
    // 1. Cambiar la clase del cuerpo
    document.body.classList.toggle('dark-mode');
    
    // 2. Controlar el sonido si el player existe
    if (player && typeof player.unMute === 'function') {
        if (document.body.classList.contains('dark-mode')) {
            // Activar sonido en modo noche
            player.unMute();
            player.setVolume(20); // Ajusta el porcentaje aquí (20%)
            document.getElementById('volume-msg').innerHTML = '<i class="material-icons tiny">volume_up</i> ¡Sonido activado al 40%! Disfruta la experiencia.';
        } else {
            // Mutear al volver al modo claro (opcional)
            player.mute();
            document.getElementById('volume-msg').innerHTML = '<i class="material-icons tiny">volume_off</i> Sonido desactivado.';
        }
    }
}

// Cargar la API de YouTube automáticamente
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
