<?php

use App\Services\ComicService;

$comic_object = (new ComicService())->get(COMIC_ID);

$comic = $comic_object['comic'];
$previous = $comic_object['previous'];
$next = $comic_object['next'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XKCD - <?php echo $comic['title'] ?></title>
    <link rel="shortcut icon" href="/xkcd.ico" type="image/x-icon">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <div class="container-fluid">
        <div class="justify-content-center row">
            <div class="col-md-7">
                <div class="card my-5 rounded-lg shadow-lg">
                    <div class="bg-white border-0 card-header pt-4 text-center">
                        <h3 class="font-weight-bold mb-0">XKCD</h3>
                        <p class="mb-0 text-muted">
                            A webcomic of romance, sarcasm, math, and language.
                        </p>
                    </div>

                    <hr class="bg-secondary mt-0 py-3" />

                    <div class="card-body">
                        <h5 class="text-center"><?php echo $comic["title"] ?></h5>

                        <figure class="mb-1">
                            <img src="<?php echo $comic['img'] ?>" class="d-block img-fluid m-auto" alt="<?php echo $comic['safe_title'] ?>">
                            <figcaption class="mt-3 text-center text-muted">
                                <small><?php echo $comic['alt'] ?></small>
                            </figcaption>
                        </figure>
                    </div>

                    <div class="bg-white border-0 card-footer d-flex justify-content-between">
                        <div>
                            <?php if ($previous) : ?>
                                <a href="<?php echo $previous ?>" class="btn btn-secondary btn-sm px-3 px-sm-4 text-white" role="button">
                                    PREVIOUS
                                </a>
                            <?php endif; ?>
                        </div>

                        <div>
                            <?php if ($next) : ?>
                                <a href="<?php echo $next ?>" class="btn btn-warning btn-sm px-4 px-sm-5 text-white" role="button">
                                    NEXT
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
