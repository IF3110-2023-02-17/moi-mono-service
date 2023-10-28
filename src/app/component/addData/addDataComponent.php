<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/addData/addData.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/tag.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/modal.css">
    
    <script type="text/javascript" src="/js/others/debounce.js" defer></script>
    <?php $isEdit = $this->data["isEdit"] ?>

    <script type="text/javascript" defer>
        const EDIT = "<?= $isEdit ?>";
    </script>

    <?php if ($this->data["datatype"] == 'movies') : ?>
        <?php $movie = ($isEdit ? $this->data['movie'] : '') ?>
        <?php $movie_actor = ($isEdit ? $this->data['movie_actor'] : '') ?>
        <?php $movie_director = ($isEdit ? $this->data['movie_director'] : '') ?>
        <link rel="stylesheet" type="text/css" href="/styles/addData/addMovie.css">
        <script type="text/javascript" src="/js/addData/addMovie.js" defer></script>
        <?php if($isEdit) : ?>
            <script type="text/javascript" defer>
                const movieID = "<?= $this->data['movie_id'] ?>"
                let currActors = [];
                <?php foreach($movie_actor as $idx => $value) : ?> 
                    currActors.push("<?= $value['actor_id'] ?>");
                <?php endforeach; ?>
                let currDirectors = [];
                <?php foreach($movie_director as $idx => $value) : ?> 
                    currDirectors.push("<?= $value['director_id'] ?>");
                <?php endforeach; ?>
            </script>
        <?php endif; ?>
    
    <?php elseif ($this->data["datatype"]== 'director' || $this->data["datatype"]== 'actor'): ?>
        <script type="text/javascript" src="/js/addData/addPeople.js" defer></script>
    
    <?php endif; ?>
    
</head>

<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="auth-container">
        
        <div class="addData-form-container">
            <!-- <? print_r($this->data) ?> -->
            <? if ($this->data["datatype"]== 'movies') {
                include(dirname(__DIR__) . '/addData/addMovieComponent.php');
                // print_r($this->data); 
            } else if ($this->data["datatype"]== 'director') {
                $director = $this->data['director'];
                include(dirname(__DIR__) . '/addData/addDirectorComponent.php');
            } else if ($this->data["datatype"]== 'actor') {
                $actor = $this->data['actor'];
                include(dirname(__DIR__) . '/addData/addActorComponent.php');
            } ?>
        </div>
        <dialog class="modal">
            <?php 
            if ($isEdit) {
                extract([
                    'titleInfo' => "Anda Akan Mengubah " . $this->data["datatype"], 
                    'descInfo' => "Pastikan data yang anda kirim sudah sesuai. Apakah anda ingin melanjutkan ?"
                ]);
            } else {
                extract([
                    'titleInfo' => "Anda Akan Menambahkan " . $this->data['datatype'],
                    'descInfo' => "Pastikan data yang anda kirim sudah sesuai. Apakah anda ingin melanjutkan ?"
                ]);
            }
            include(dirname(__DIR__) . '/modal/ModalComponent.php')?>
        </dialog>
    </div>
</body>

</html>