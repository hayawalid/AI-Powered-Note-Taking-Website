document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.querySelector('.toggle-sidebar');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        if (sidebar.classList.contains('open')) {
            hamburgerIcon.style.display = 'none';
            closeIcon.style.display = 'inline';
        } else {
            hamburgerIcon.style.display = 'inline';
            closeIcon.style.display = 'none';
        }
    });

    document.querySelector('.add-new').addEventListener('click', function () {
        if (sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
            hamburgerIcon.style.display = 'inline';
            closeIcon.style.display = 'none';
        }
        document.querySelector('.pop-up').classList.add('open');
        document.body.classList.add('body-blur');
    });
    document.querySelector('.new-note').addEventListener('click', function () {
        if (sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
            hamburgerIcon.style.display = 'inline';
            closeIcon.style.display = 'none';
        }
        document.querySelector('.pop-up').classList.add('open');
        document.body.classList.add('body-blur');
    });

    document.querySelector('.pop-up .close').addEventListener('click', function () {
        document.querySelector('.pop-up').classList.remove('open');
        document.body.classList.remove('body-blur');
    });

    document.querySelector('.add-item form').addEventListener('submit', function (event) {
        // event.preventDefault();
        const type = document.getElementById('type').value;
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        document.querySelector('.pop-up').classList.remove('open');
        document.body.classList.remove('body-blur');
    });
});
