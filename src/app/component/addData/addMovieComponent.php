<!-- <form action = "insert" method="post" class="addMovie" novalidate> -->
<form class="addMovie" novalidate>
    <h1 class="auth-title">
        <?php if($isEdit) : ?>
            Edit Film        
        <?php else : ?>    
            Tambahkan Film Baru
        <?php endif; ?>
    </h1>
    <!-- Title -->
    <div class="form-group">
        <label for="title">Title</label>
        <input id="title" class="form-input" name="title" type="text" placeholder="Nama Film" 
            <?php if($isEdit) : ?>
                value = "<?= $movie['title'] ?>"
            <?php endif; ?>
        />
        <i>
            <p id="title-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>
    <!-- Deskripsi -->
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <input id="description" class="form-input" name="description" type="text" placeholder="Sebuah Deskripsi"
            <?php if($isEdit) : ?>
                value = "<?= $movie['description'] ?>"
            <?php endif; ?>
        />
        <i>
            <p id="description-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Release Date -->
    <div class="form-group">
        <label for="year">Release Year</label>
        <input id="year" class="form-input" name="release-year" type="text" placeholder="1996"
            <?php if($isEdit) : ?>
                value = "<?php echo $movie['year'] ?>"
            <?php endif; ?>
        />
        <i>
            <p id="year-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Duration -->
    <div class="form-group">
        <label for="duration">Duration (minutes)</label>
        <input id="duration" class="form-input" name="duration" type="text" placeholder="230"
            <?php if($isEdit) : ?>
                value = "<?php
                        list($h, $m, $s) = explode(":", $movie['duration']);
                        echo (($h * 60) + $m);
                    ?>"
            <?php endif; ?>
        />
        <i>
            <p id="duration-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!--  Categroy -->
    <div class="form-group">
        <label for="categorys">Category</label>
        <div class="select-category">
            <select name="categorys" id="categorys">
                <?php foreach ($this->data["categorys"] as $index => $category) : ?>
                    <option value="<?= htmlspecialchars(json_encode(array('id' => $category['category_id'], 'name' => $category['name']))) ?>" >
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <i>
            <p id="category-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
        <div class="selected-category-container">

            <?php if($isEdit) : ?>
                <?php 
                    foreach ($movie_director as $index => $value){
                        extract(["type" => "director", "movie_director" => $value ]);
                        include(dirname(__DIR__) . '/others/TagComponent.php'); 
                    }
                ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="actors">Actor</label>
        <div class="select-actor">
            <select name="actors" id="actors">
                <?php foreach ($this->data["actors"] as $index => $actor) : ?>
                    <option value="<?= htmlspecialchars(json_encode(array('id' => $actor['actor_id'], 'name' => $actor['name']))) ?>" >
                        <?= $actor['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <i>
            <p id="actors-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
        <div class="selected-actor-container">
            <?php if($isEdit) : ?>
                <?php 
                    foreach ($movie_actor as $index => $value){
                        extract(["type" => 'actor', "movie_actor" => $value]);
                        include(dirname(__DIR__) . '/others/TagComponent.php'); 
                    }
                ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="directors">Director</label>
        <div class="select-director">
            <select name="directors" id="directors">
                <?php foreach ($this->data["directors"] as $index => $director) : ?>
                    <option value="<?= htmlspecialchars(json_encode(array('id' => $director['director_id'], 'name' => $director['name']))) ?>" >
                        <?= $director['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <i>
            <p id="directors-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
        <div class="selected-director-container">

            <?php if($isEdit) : ?>
                <?php 
                    foreach ($movie_director as $index => $value){
                        extract(["type" => "director", "movie_director" => $value ]);
                        include(dirname(__DIR__) . '/others/TagComponent.php'); 
                    }
                ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Image -->
    <div class="form-group">
        <label for="poster">Poster Film</label>
        <input id="poster" class="form-input" name="poster" type="file" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="poster-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Trailer -->
    <div class="form-group">
        <label for="trailer">Trailer</label>
        <input id="trailer" class="form-input" name="trailer" type="file" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="trailer-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>
    <div class="form-panel">
        <button id="discard-btn" class="btn btn-primary">Discard</button>
        <button id="submit-btn" class="btn btn-primary">Submit</button>
    </div>
</form>