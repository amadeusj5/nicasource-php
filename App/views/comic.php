<?php

require_once dirname(__DIR__) . '/services/ComicService.php';

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

    <!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2 py-5">
                <h1 class="h3">XKCD</h1>

                <div>
                    <h4><?php echo $comic["title"] ?></h4>
                    <div class="mb-1">
                        <img src="<?php echo $comic['img'] ?>" class="img-fluid" alt="<?php echo $comic['safe_title'] ?>">
                    </div>
                    <p class="mt-3">
                        <small><?php echo $comic['alt'] ?></small>
                    </p>
                </div>
                <div>
                    <div class="wizard-footer clearfix">
                        <?php if ($previous) : ?>
                            <a href="<?php echo $previous ?>" class="btn btn-previous btn-fill btn-primary btn-wd btn-sm" title="previous">
                                <span class="mr-2">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </span>
                                Previous
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($next) : ?>
                            <a href="<?php echo $next ?>" class="btn btn-next btn-fill btn-primary btn-wd btn-sm" title="next">
                                Next
                                <span class="ml-2">
                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
