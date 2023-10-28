<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/search/search.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">

    <script type="text/javascript" src="/js/others/debounce.js" defer></script>
    <script type="text/javascript" src="/js/search/search.js" defer></script>
</head>

<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <section class="search-section">
        <div class="search-group">
            <div class="search-box">
                <label for="search" class="search-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </label>
                <input type="text" id="search" placeholder="Cari disini ges, untuk menampilkan semua ketik '~all'" name="q">
            </div>
            <div class="container-filter">
                <div class="filter sort-box">
                    <label for="sort">Sort By</label>
                    <div class="select-box">
                        <select name="sort" id="sort">
                            <option value="m.title">Title (A-Z)</option>
                            <option value="m.title desc">Title (Z-A)</option>
                            <option value="m.year desc">Release Date (Newest)</option>
                            <option value="m.year">Release Date (Oldest)</option>
                        </select>
                    </div>
                </div>
                <div class="filter cat-box">
                    <label for="cat">Filter Category</label>
                    <div class="select-box">
                        <select name="cat" id="cat">
                            <option value="none">None</option>
                            <?php foreach ($this->data["category"] as $index => $category) : ?>
                                <option value="<?= $category['name'] ?>">
                                    <?= ucfirst($category['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="filter year-box">
                    <label for="year">Filter Year</label>
                    <div class="select-box">
                        <select name="year" id="year">
                            <option value="none">None</option>
                            <?php foreach ($this->data["years"] as $index => $year) : ?>
                                <option value="<?= $year['year'] ?>">
                                    <?= $year['year'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="result-container">
        <div class="movie-container">
            <h1 class="no-result">
                <i>Kamu Belum Nyari :_(</i>
            </h1>
        </div>

        <?php include(dirname(__DIR__) . '/others/PaginationGroup.php') ?>

    </section>
    </body>

</html>
