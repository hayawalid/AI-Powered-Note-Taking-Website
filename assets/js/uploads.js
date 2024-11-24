document.addEventListener('DOMContentLoaded', function () {
    // Select DOM elements
    const dropArea = document.querySelector(".drop_box"),
          button = dropArea.querySelector("button"),
          input = dropArea.querySelector("input"),
          contentDisplay = document.getElementById('contentDisplay');

    // Open file input dialog when the button is clicked
    button.onclick = () => {
        input.click();
    };

    // Handle file selection
    input.addEventListener("change", function (e) {
        const file = e.target.files[0];

        // Check if the uploaded file is a PDF
        if (file && file.type === 'application/pdf') {
            const fileReader = new FileReader();

            // On file read complete
            fileReader.onload = function () {
                const typedArray = new Uint8Array(this.result);

                // Initialize PDF.js
                pdfjsLib.getDocument(typedArray).promise.then((pdf) => {
                    let content = ''; // This will store the extracted content

                    const numPages = pdf.numPages;

                    // Loop through all pages of the PDF and extract text
                    for (let pageNumber = 1; pageNumber <= numPages; pageNumber++) {
                        pdf.getPage(pageNumber).then((page) => {
                            page.getTextContent().then((textContent) => {
                                textContent.items.forEach((item) => {
                                    content += item.str + ' '; // Append text from PDF
                                });

                                // Once the last page is processed, display the content
                                if (pageNumber === numPages) {
                                    displayContent(content); // Function to display the content
                                }
                            });
                        });
                    }
                }).catch((error) => {
                    console.error('Error extracting PDF content:', error);
                    contentDisplay.innerHTML = '<p>Error extracting PDF content. Please try again.</p>';
                });
            };

            // Read the PDF file as ArrayBuffer
            fileReader.readAsArrayBuffer(file);
        } else {
            alert("Please upload a valid PDF file.");
        }
    });

    // Function to display the extracted content
    function displayContent(content) {
        contentDisplay.innerHTML = `<pre>${content}</pre>`;
    }
});
