<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/uploads.css">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <div class="container">
        <?php include '../includes/user_sidebar.php'; ?>


        <div class="containers">
            <div class="card">
                <h3>Upload Files</h3>
                <div class="drop_box">
                    <header>
                        <h4>Select File here</h4>
                    </header>
                    <p>Files Supported: PDF, TEXT, DOC , DOCX</p>
                    <input type="file" hidden accept=".doc,.docx,.pdf" id="fileID" style="display:none;">
                    <button class="btn">Choose File</button>
                </div>

            </div>
        </div>


    </div>
    <script>
        const dropArea = document.querySelector(".drop_box"),
            button = dropArea.querySelector("button"),
            dragText = dropArea.querySelector("header"),
            input = dropArea.querySelector("input");
        let file;
        var filename;

        button.onclick = () => {
            input.click();
        };

        input.addEventListener("change", function (e) {
            var fileName = e.target.files[0].name;
            let filedata = `
    <form action="" method="post">
    <div class="form">
    <h4>${fileName}</h4>
    <input type="text" placeholder="Rename file">
    <button class="btn">Upload</button>
    </div>
    </form>`;
            dropArea.innerHTML = filedata;
        });

    </script>
</body>

</html>