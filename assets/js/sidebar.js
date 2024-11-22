document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('add-new').addEventListener('click', function () {
        document.querySelector('.overlay').classList.add('open');
        document.querySelector('.pop-up').classList.add('open');
    });
    
    // document.querySelector('.new-note').addEventListener('click', function () {
    //     document.querySelector('.pop-up').classList.add('open');
    //     document.body.classList.add('body-blur');
    // });

    document.querySelector('.pop-up .close').addEventListener('click', function () {
        document.querySelector('.pop-up').classList.remove('open');
        document.querySelector('.overlay').classList.remove('open');
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
    // Open the trash modal when ".popover-btn.delete" is clicked
    document.querySelectorAll('.popover-btn.delete').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const folderId = this.getAttribute('data-folder-id');
            document.getElementById('folder_id').value = folderId;
            document.getElementById('trashModal').style.display = 'flex';
        });
    });

    // Open the delete modal when ".fa-solid.fa-trash" is clicked
    document.querySelectorAll('.fa-solid.fa-trash').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const folderId = this.getAttribute('data-folder-id');
            document.getElementById('folder_id').value = folderId;
            document.getElementById('deleteModal').style.display = 'flex';
        });
    });
});

// Close modal function for both modals
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    ['deleteModal', 'trashModal'].forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal.style.display === 'flex' && !modal.contains(event.target)) {
            closeModal(modalId);
        }
    });
});

document.getElementById('deleteForm').addEventListener('submit', function() {
    const folderId = document.getElementById('folder_id').value;
    console.log("Folder ID being submitted: ", folderId);
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.popover-btn.rename').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.stopPropagation();
            const folderElement = button.closest('.folder');
            const folderNameElement = folderElement.querySelector('p');
            const currentName = folderNameElement.textContent;

            // Replace folder name with an input field
            const inputField = document.createElement('input');
            inputField.type = 'text';
            inputField.value = currentName;
            inputField.classList.add('rename-input');
            folderNameElement.replaceWith(inputField);

            // Focus on the input field
            inputField.focus();

            // Handle blur event to save changes
            inputField.addEventListener('blur', function() {
                const newName = inputField.value;

                // Send AJAX request to update the folder name
                const folderId = button.getAttribute('data-folder-id');
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '../includes/update_folder.php', true); // Correct path here
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200 && xhr.responseText.trim() === 'success') {
                            const newFolderNameElement = document.createElement('p');
                            newFolderNameElement.textContent = newName;
                            inputField.replaceWith(newFolderNameElement);
                        } else {
                            alert(`Error: ${xhr.responseText}`);
                        }
                    }
                };
                xhr.send(`id=${folderId}&name=${newName}`);
            });
        });
    });
});
