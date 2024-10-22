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
document.addEventListener('click', function (event) {
    const ellipsisIcons = document.querySelectorAll('.ellipsis');
    let isEllipsis = false;
    let isPopover = false;

    ellipsisIcons.forEach(ellipsis => {
        const popover = ellipsis.nextElementSibling;
        if (event.target === ellipsis || popover.contains(event.target)) {
            isEllipsis = true;
            isPopover = true;
            // Toggle the current popover
            if (popover.style.display === 'block') {
                popover.style.display = 'none';
            } else {
                popover.style.display = 'block';
            }
        } else {
            popover.style.display = 'none';
        }
    });
    if (!isEllipsis && !isPopover) {
        ellipsisIcons.forEach(ellipsis => {
            ellipsis.nextElementSibling.style.display = 'none';
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.popover-btn.delete').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const folderId = this.getAttribute('data-folder-id');
            document.getElementById('folder_id').value = folderId;
            document.getElementById('deleteModal').style.display = 'flex';
        });
    });
});

function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

window.addEventListener('click', function(event) {
    const modal = document.getElementById('deleteModal');
    if (modal.style.display === 'flex' && !modal.contains(event.target)) {
        closeModal();
    }
});
