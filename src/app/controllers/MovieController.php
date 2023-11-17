<?php

class MovieController
{
    public function index()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;

                    $isAdmin = false;
                    try {
                        $auth->isAdminLogin();
                        $isAdmin = true;
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $movieModel = Utils::model("Movie");
                    if ($isAdmin) {
                        $movies = $movieModel->getAllMovies();
                        $count = $movieModel->getCountAll();
                    } else {
                        $movies = $movieModel->getAllMovies();
                        $count = $movieModel->getCountAll();
                    }

                    $data['isAdmin'] = $isAdmin;
                    $data['data'] = $movies;
                    $data['page'] = $count;
                    $data['isLogin'] = true;

                    $movieView = Utils::view("lists", "MovieListView", $data);
                    $movieView->render();

                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }

    public function search()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    // Authentication
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;

                    $categoryModel = Utils::model('Category');
                    $movieModel = Utils::model('Movie');
                    $category = $categoryModel->getAllCategory();
                    $year = $movieModel->getYear();

                    $result = null;

                    $data['category'] = $category;
                    $data['movies'] = $result;
                    $data['years'] = $year;
                    $data['isLogin'] = true;


                    $searchView = Utils::view("search", "SearchView", $data);
                    $searchView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        }
    }

    public function fetch($page)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;
                    $movieModel = Utils::model("Movie");

                    $movies = $movieModel->getByArgs($_GET['q'], $_GET['sort'], $_GET['category'], $_GET['year'], $page);
                    $count = $movieModel->getCountPage($_GET['q'], $_GET['category']);

                    header('Content-Type: application/json');
                    echo json_encode(['movies' => $movies, 'page' => $count]);
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }


    // need refactor
    public function ids()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $movieModel = Utils::model("Movie");
                    $ids = $_GET['ids'] ?? "";
                    if ($ids) {
                        $ids = explode(',', $ids);
                        // check if all ids are numeric
                        foreach ($ids as $id) {
                            if (!is_numeric($id)) {
                                throw new Exception('Bad Request', 400);
                            }
                        }
                        $movies = $movieModel->getInIds($ids);
                    } else {
                        throw new Exception('Bad Request', 400);
                    }

                    header('Content-Type: application/json');
                    echo json_encode(['movies' => $movies]);
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function notIds()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $movieModel = Utils::model("Movie");
                    $ids = $_GET['ids'] ?? "";
                    if ($ids) {
                        $ids = explode(',', $ids);
                        // check if all ids are numeric
                        foreach ($ids as $id) {
                            if (!is_numeric($id)) {
                                throw new Exception('Bad Request', 400);
                            }
                        }
                        $movies = $movieModel->getNotInIds($ids);
                    } else {
                        $movies = $movieModel->getAllMovies();
                    }

                    header('Content-Type: application/json');
                    echo json_encode(['movies' => $movies]);
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function catalog()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();
                    $data['isLogin'] = true;

                    $isAdmin = false;
                    try {
                        $auth->isAdminLogin();
                        $isAdmin = true;
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $movieModel = Utils::model('Movie');
                    // $data["movies"] = $movieModel->getPaginate($page);
                    $data['isAdmin'] = $isAdmin;
                    $data["datatype"] = "movies";

                    $movieView = Utils::view("lists", "MovieListView", $data);

                    $movieView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function insert()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isAdminLogin();
                    $data['isLogin'] = true;

                    $movieModel = Utils::model('Movie');
                    $data["movies"] = $movieModel->getAllMovies();
                    $data["datatype"] = "movies";

                    $actorModel = Utils::model('Actor');
                    $data["actors"] = $actorModel->getAllActor();

                    $directorModel = Utils::model('Director');
                    $data["directors"] = $directorModel->getAllDirectors();

                    $categoryModel = Utils::model('Category');
                    $data["categorys"] = $categoryModel->getAllCategory();

                    $data["isEdit"] = false;

                    $addMovieView = Utils::view("addData", "AddDataView", $data);
                    $addMovieView->render();
                    break;
                case 'POST':
                    $movieModel = Utils::model('Movie');

                    if (isset($_FILES["poster"]) && isset($_FILES["trailer"])) {
                        $poster = $_FILES["poster"];
                        $trailer = $_FILES["trailer"];

                        if ($poster["error"] == UPLOAD_ERR_OK && $trailer["error"] == UPLOAD_ERR_OK) {
                            $uploadPosterDir = "media/img/movie";
                            $posterName = basename($poster["name"]);
                            $uploadPoster = $uploadPosterDir . '/' . $posterName;
                            // var_dump($uploadPoster);

                            $uploadTrailerDir = "media/img/trailer";
                            $trailerName = basename($trailer["name"]);
                            $uploadTrailer = $uploadTrailerDir . '/' . $trailerName;
                            // var_dump($uploadPoster);

                            if (move_uploaded_file($poster["tmp_name"], $uploadPoster) && move_uploaded_file($trailer["tmp_name"], $uploadTrailer)) {
                                // echo "File is valid and was successfully uploaded.";

                                // Add mvooe
                                if ($movieModel->addMovie($_POST, $posterName, $trailerName) > 0) {
                                    // var_dump($_POST);
                                    header('Content-Type: application/json');
                                    http_response_code(STATUS_OK);
                                    echo json_encode(['error' => null]);
                                    break;
                                    exit;
                                }
                            } else {
                                echo "Error uploading the file.";
                            }
                        } else {
                            echo "Upload error: " . $poster["error"];
                        }
                    }

                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function update()
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isAdminLogin();
                    $data['isLogin'] = true;

                    $movieModel = Utils::model('Movie');
                    $data["movies"] = $movieModel->getAllMovies();
                    $data["datatype"] = "movies";
                    $data["movie"] = $movieModel->getMovieByID($_GET['movie_id']);

                    $movie_actor = $movieModel->getActorByMovieID($_GET['movie_id']);
                    $movie_director = $movieModel->getDirectorByMovieID($_GET['movie_id']);

                    $actorModel = Utils::model('Actor');
                    $data["actors"] = $actorModel->getAllActor();
                    $data["movie_actor"] = $actorModel->getMovieActorByMovieID($_GET['movie_id']);

                    $directorModel = Utils::model('Director');
                    $data["directors"] = $directorModel->getAllDirectors();
                    $data["movie_director"] = $directorModel->getMovieDirectorByMovieID($_GET['movie_id']);

                    $data["isEdit"] = true;
                    $data["movie_id"] = $_GET['movie_id'];

                    $addMovieView = Utils::view("addData", "AddDataView", $data);
                    $addMovieView->render();
                    break;
                case 'POST':
                    $movieModel = Utils::model('Movie');

                    $posterName = "";
                    $trailerName = "";

                    if (isset($_FILES['poster'])) {
                        $poster = $_FILES["poster"];
                        if ($poster["error"] == UPLOAD_ERR_OK) {
                            $uploadPosterDir = "media/img/movie";
                            $posterName = basename($poster["name"]);
                            $uploadPoster = $uploadPosterDir . '/' . $posterName;

                            if (!move_uploaded_file($poster["tmp_name"], $uploadPoster)) {
                                throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
                            }
                        } else {
                            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
                        }
                    }

                    if (isset($_FILES['trailer'])) {
                        $trailer = $_FILES["trailer"];
                        if ($trailer["error"] == UPLOAD_ERR_OK) {
                            $uploadTrailerDir = "media/img/movie";
                            $trailerName = basename($trailer["name"]);
                            $uploadTrailer = $uploadTrailerDir . '/' . $trailerName;

                            if (!move_uploaded_file($trailer["tmp_name"], $uploadTrailer)) {
                                throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
                            }
                        } else {
                            throw new Exception('Internal Server Error', STATUS_INTERNAL_SERVER_ERROR);
                        }
                    }

                    // Add mvooe
                    if ($movieModel->updateMovie($_POST, $posterName, $trailerName) > 0) {
                        // var_dump($_POST);
                        header('Content-Type: application/json');
                        http_response_code(STATUS_OK);
                        echo json_encode(['error' => null]);
                        break;
                        exit;
                    }
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }

    public function delete()
    {
        try {
            // var_dump($_SERVER['REQUEST_METHOD']);
            switch ($_SERVER['REQUEST_METHOD']) {
                case "DELETE":
                    $auth = Utils::middleware("Authentication");
                    $auth->isAdminLogin();
                    $data['isLogin'] = true;

                    $movieModel = Utils::model('Movie');
                    if ($movieModel->deleteMovie($_GET['movie_id']) > 0) {
                        // var_dump($_POST);
                        // header('Location: ' ."http://$_SERVER[HTTP_HOST]".  '/movie/catalog');
                        header('Content-Type: application/json');
                        echo json_encode(['error' => null]);
                    }
                    exit;
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }


    public function detail($movieID)
    {
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $auth = Utils::middleware("Authentication");
                    $auth->isUserLogin();

                    $isAdmin = false;
                    try {
                        $auth->isAdminLogin();
                        $isAdmin = true;
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }

                    $data["isAdmin"] = $isAdmin;
                    $data['isLogin'] = true;

                    // Admin Checking
                    $isAdmin = false;
                    try {
                        $auth->isAdminLogin();
                        $isAdmin = true;
                    } catch (Exception $e) {
                        if ($e->getCode() !== STATUS_UNAUTHORIZED) {
                            throw new Exception($e->getMessage(), $e->getCode());
                        }
                    }
                    $data["isAdmin"] = $isAdmin;

                    // $movieChosen = $_GET['title'];
                    $data['movie'] = Utils::model("Movie")->getMovieByID($movieID);

                    // var_dump($_GET);
                    // $movieID = $data['movie']['movie_id'];

                    // TODO: Kayaknya ada yg salah disini
                    $data['directorID'] = Utils::model("Movie")->getDirectorByMovieID($movieID);
                    foreach ($data['directorID'] as $directorID) {
                        $directorID = $directorID['director_id'];
                        $data['director'][] = Utils::model("Director")->getDirectorByID("$directorID");
                    };

                    $data['actorID'] = Utils::model("Movie")->getActorByMovieID("$movieID");
                    foreach ($data['actorID'] as $actorID) {
                        $actorID = $actorID['actor_id'];
                        $data['actor'][] = Utils::model("Actor")->getActorByID("$actorID");
                    };


                    //pagination for reviews
                    $reviewPerPage = 10;
                    $data['totalPage'] = ceil(Utils::model("Movie")->getCountReviewByMovieID($movieID) / $reviewPerPage);
                    $currentPage = $_GET['page'] ?? 1;
                    $data['page'] = $currentPage;
                    $initialReview = ($reviewPerPage * $currentPage) - $reviewPerPage;

                    $data['reviewID'] = Utils::model("Movie")->getReviewByMovieIDWithLimit("$movieID", $initialReview, $reviewPerPage);
                    foreach ($data['reviewID'] as $reviewID) {
                        $reviewID = $reviewID['review_id'];
                        $data['reviews'][] = Utils::model("Review")->getReviewByReviewID("$reviewID");
                    };

                    $movieView = Utils::view("about", "AboutMovieView", $data);
                    $movieView->render();
                    break;
                default:
                    throw new Exception('Method Not Allowed', STATUS_METHOD_NOT_ALLOWED);
            }
        } catch (Exception $e) {
            if ($e->getCode() === STATUS_UNAUTHORIZED) {
                header("Location: http://localhost:8001/user/login");
            } else {
                http_response_code($e->getCode());
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
        }
    }
}
