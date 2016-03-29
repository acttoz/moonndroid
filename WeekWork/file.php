<?php
    include_once ('./config.php');
    ?>

<html>
    <meta charset="utf-8"/>
    <title>File Manager</title>
</html>
<body>
    <form action="./upload.php" method="POST" enctype="multipart/form-data" />
        <input type="file" id="file" name="file" required />
        <input type="submit" value="UPLOAD" />
    </form>
</body>
</html>