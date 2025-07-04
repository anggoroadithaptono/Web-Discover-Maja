// Animasi teks ketik
const typingText = document.querySelector('.typing-text');
const words = ['Web Developer', 'UI Designer', 'Mahasiswa SI', 'Linux Enthusiast'];
let wordIndex = 0;
let charIndex = 0;

function typeEffect() {
    if (charIndex < words[wordIndex].length) {
        typingText.textContent += words[wordIndex].charAt(charIndex);
        charIndex++;
        setTimeout(typeEffect, 100);
    } else {
        setTimeout(eraseEffect, 1500);
    }
}

function eraseEffect() {
    if (charIndex > 0) {
        typingText.textContent = words[wordIndex].substring(0, charIndex - 1);
        charIndex--;
        setTimeout(eraseEffect, 50);
    } else {
        wordIndex = (wordIndex + 1) % words.length;
        setTimeout(typeEffect, 500);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (typingText) typeEffect();
});

// GSAP efek muncul saat scroll
gsap.registerPlugin(ScrollTrigger);

gsap.utils.toArray('.project-card').forEach((card) => {
    gsap.from(card, {
        scrollTrigger: {
            trigger: card,
            start: 'top 80%',
            toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 50,
        duration: 1,
        ease: 'power2.out'
    });
});
