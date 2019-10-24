<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<form action="upload.php" method="POST" enctype="multipart/form-data" id="upload_form">
    <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="upload_progress"/>
    <input type="file" name="file1"/>
    <input type="submit"/>
</form>

<div id="progress-bar-container" style="border: thin solid gray;">
    <div id="progress-bar"
         style="height: 30px; width: 0%; background: cornflowerblue; color: white; text-align: right; line-height: 30px;">

    </div>
</div>


<script>
    $(document).ready(function () {
        $("#upload_form").on('submit', function (event) {
            event.preventDefault();
            // lets do ajax...
            let formData = new FormData();
            let file = $('input[type=file]')[0].files[0];
            let other_data = $("#upload_form").serializeArray();

            $.each(other_data, function (key, input) {
                formData.append(input.name, input.value);
            });
            formData.append('uploaded_file', file);
            $.ajax({
                type: 'POST',
                url: 'upload.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function (msg) {
                    console.log(msg);
                },
                error: function (err) {
                    console.log(err);
                }
            });
            // now query for upload progress...
            uploadProgress();

        });
    });
    function uploadProgress() {
        let timer = setInterval(function () {
            $.ajax({
                type: 'POST',
                url: 'progress.php',
                success: function (msg) {
                    if (msg === 'null') {
                        clearInterval(timer);
                        document.getElementById('progress-bar').style.width = "100%";
                        document.getElementById('progress-bar').innerHTML = "100%";
                    } else {
                        let progress = JSON.parse(msg);
                        let processed_bytes = progress['bytes_processed'];
                        let total_bytes = progress['content_length'];
                        // lets do math now
                        let total_percent = Math.floor(processed_bytes * 100 / total_bytes);
                        document.getElementById('progress-bar').style.width = total_percent + "%";
                        document.getElementById('progress-bar').innerHTML = total_percent + "%";
                        if (total_percent >= 100) {
                            document.getElementById('progress-bar').style.width = "100%";
                            document.getElementById('progress-bar').innerHTML = "100%";
                        }

                    }
                }
            });
        }, 500);
    }
</script>