# Track-Upload-Progress-using-Session-Upload-Progress-PHP-JavaScript-Ajax
This Project helps developers who wish to track their upload progress using Php's Inbuild upload Session.

Make sure you are using PHP 5.4 and higher.
Make the following changes to php.ini file:

1. session.upload_progress.cleanup -> set this to 'On'
2. session.upload_progress.enabled -> set this to 'On'
3. session.auto_start              -> set this to 'On'

- We will use ajax to send the selected file to our upload script and also to check for the upload progress.
- We will also use javascript to update the progress for file upload.

If you are on Linux make sure you have the right permissions for uploads folder in this project.

