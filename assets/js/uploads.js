const dropBox = document.querySelector(".drop_box"),
      button = dropBox.querySelector("button"),
      input = dropBox.querySelector("input"),
      statusDisplay = document.getElementById("upload-status");

let selectedFile;

// Open file selection dialog when the button is clicked
button.onclick = () => input.click();

// Handle file selection
input.addEventListener("change", function (e) {
    selectedFile = e.target.files[0];
    if (!selectedFile) return;

    const fileName = selectedFile.name;

    // Preserve the form structure but prepare it for submission
    const fileData = `
        <form id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="form">
                <h4>${fileName}</h4>
                <input type="text" name="rename" placeholder="Rename file" />
                <button class="btn" type="submit">Upload</button>
            </div>
        </form>
    `;
    dropBox.innerHTML = fileData;

    // Attach event listener to the form for upload
    const uploadForm = document.getElementById("uploadForm");
    uploadForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        const renameInput = uploadForm.querySelector("input[name='rename']").value;
        const formData = new FormData();
        formData.append("file", selectedFile);
        formData.append("rename", renameInput);

        extractTextFromPDF(selectedFile).then(extractedText => {
            formData.append("content", extractedText); // Append extracted text
            // Perform the upload
            uploadFile(formData);
        }).catch(err => {
            console.error("Error extracting text:", err);
            statusDisplay.textContent = "Failed to extract text from PDF.";
        });
    });
});

// Function to extract text from PDF using PDF.js
async function extractTextFromPDF(file) {
    const pdf = await pdfjsLib.getDocument(URL.createObjectURL(file)).promise;
    let extractedText = '';
    
    for (let i = 1; i <= pdf.numPages; i++) {
        const page = await pdf.getPage(i);
        const textContent = await page.getTextContent();
        extractedText += textContent.items.map(item => item.str).join(' ');
    }

    return extractedText;
}

// Function to handle file upload via AJAX
function uploadFile(formData) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../includes/upload_handler.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Log the response for debugging
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.status) {
                    statusDisplay.textContent = response.message;
                    dropBox.innerHTML = `<h4>Upload Complete!</h4>`;
                } else {
                    statusDisplay.textContent = `Error: ${response.message}`;
                }
            } catch (e) {
                console.error("Error parsing response:", e);
                statusDisplay.textContent = "Server returned invalid response.";
            }
        } else {
            statusDisplay.textContent = "Server error. Please try again.";
        }
    };

    xhr.onerror = function () {
        statusDisplay.textContent = "Network error. Please try again.";
    };

    xhr.send(formData);
}
