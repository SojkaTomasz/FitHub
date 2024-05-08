const navLinks = document.querySelectorAll('.nav-link');

const options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.3
};

const handleIntersection = (entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && entry.intersectionRatio > 0.2) {
            const itemId = entry.target.id;
            const correspondingNavLink = document.querySelector(`.nav-link[href="#${itemId}"]`);
            if (correspondingNavLink) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                });
                correspondingNavLink.classList.add('active');
            }
        }
    });
};

const observer = new IntersectionObserver(handleIntersection, options);

document.querySelectorAll('.scrollspy-example-2 > div').forEach(div => {
    observer.observe(div);
});
