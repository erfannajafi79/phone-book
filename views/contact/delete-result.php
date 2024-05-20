<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>

    
    <link rel="stylesheet" href="<?= asset_url(); ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= asset_url(); ?>css/all.min.css" />
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col m-5 p-5">
            <?php if($deleted_count): ?>
                <span class="text-warning">contact deleted successfully.</span>
            <?php else: ?> 
                    <span class="text-danger">contact not exists!</span>
            <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col mt-3 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243); display: block;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="50" cy="50" r="30" stroke="#667395" stroke-width="10" fill="none"></circle>
                <circle cx="50" cy="50" r="30" stroke="#292664" stroke-width="8" stroke-linecap="round" fill="none">
                <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;180 50 50;720 50 50" keyTimes="0;0.5;1"></animateTransform>
                <animate attributeName="stroke-dasharray" repeatCount="indefinite" dur="1s" values="18.84955592153876 169.64600329384882;94.2477796076938 94.24777960769377;18.84955592153876 169.64600329384882" keyTimes="0;0.5;1"></animate>
                </circle>
            </svg>
            Redirecting to Home.
            <script>
                setTimeout(() => {
                    location.href="<?=site_url() ?>"
                }, 1500);
            </script>

            </div>
        </div>
    </div>
    
</body>
</html>