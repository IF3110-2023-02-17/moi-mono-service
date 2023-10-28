<form 
<?php if($isEdit) : ?>
    action="update"
<?php else : ?>    
    action="insert" 
<?php endif; ?> 
method="post" class="addPeople" enctype="multipart/form-data" novalidate>
    <h1 class="auth-title">
        <?php if($isEdit) : ?>
            Edit Director        
        <?php else : ?>    
            Tambahkan Director Baru
        <?php endif; ?>
    </h1>

    <!-- Name -->
    <?php if($isEdit) : ?>
        <input type="hidden" id="director_id" name="director_id" value="<?= $director["director_id"] ?>"/>  
    <?php endif; ?>
    <div class="form-group">
        <label for="name">Name</label>
        <input id ="name" class="form-input" name="name" type="text" placeholder="Nama Director" 
            <?php if($isEdit) : ?>
                value = "<?= $director['name'] ?>"
            <?php endif; ?>
        />
        <i>
            <p id="name-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Description</label>
        <input id = "description" class="form-input" name="description" type="text" placeholder="Sebuah Deskripsi"
            <?php if($isEdit) : ?>
                value = "<?= $director['description'] ?>"
            <?php endif; ?>
        />
        <i>
            <p id="description-warn" class="hide alert-text">isi desc dulu!</p>
        </i>
    </div>

    <!-- Birthdate -->
    <div class="form-group">
        <label for="birthdate">Birthdate</label>
        <input id = "birthdate" class="form-input" name="birthdate" type="date" placeholder="Sebuah Deskripsi"
            <?php if($isEdit) : ?>
                value = "<?= $director['birth_date'] ?>"
            <?php endif; ?>
        />
        <i>
            <p id="birthdate-warn" class="hide alert-text">isi desc dulu!</p>
        </i>
    </div>

    <!-- Image -->
    <div class="form-group">
        <label for="photo">Photo</label>
        <input id = "photo" class="form-input" name="photo" type="file" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="photo-warn" class="hide alert-text">isi desc dulu!</p>
        </i>
    </div>

    <button class="btn btn-primary">Submit</button>
</form>

<!-- <div class="register-btn">
    <a href="/auth/register" class="btn alt-btn">tombol lain</a>
</div> -->
