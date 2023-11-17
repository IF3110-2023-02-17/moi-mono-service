<!DOCTYPE html>
<html lang="en">

<head>
    <title>Menfess Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/menfess/menfess.css">
    <?php 
        $menfess = $this->data 
    ?>
    <script type="text/javascript" src="/js/menfess/menfess.js" defer></script>
    <script type="text/javascript" defer>
        const studioID = "<?= $menfess['studio_id'] ?>";
    </script>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="menfess-container">
        <div class="menfess-form-container">

            <div class="menfess-header">
                <h2>Kirim Menfess ke <?=  $menfess['studio_name'] ?></h2>
            </div>
            <div class="menfess-container-field">
                <div class="menfess-field">
                    <label for="name">Sender (Anonymous)</label>
                    <input id="name-input" class="form-input" name="name" type="text" placeholder="Nama Anonymous" />
                </div>
                <div class="menfess-field">
                    <label for="message">Message</label>
                    <textarea id="message-input" class="form-input" name="comment" type="text" placeholder="Kirim surat untuk studio"></textarea>
                </div>

                <div class="submit-btn">
                    <button class="btn btn-primary">Submit</button>
                </div>

            </div>
        </div>
    </div>
</body>
</html>