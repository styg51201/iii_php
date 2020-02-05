



<!doctype html>

<head>
    <title>Bootstrap-1</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .container-fluid {
            padding: 0;
        }

        .carousel-item>img {
            width: 100%;
            height: 500px;
            object-fit: cover;

        }

        .card {
            border: none;
            padding: 15px;
        }

        .card>img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            background: rgb(85, 85, 85);

        }

        .media>img {
            width: 445px;
            height: 445px;
            background: rgb(85, 85, 85);
        }

        .img-fluid {
            height: 100%;
            object-fit: cover;
        }

        .figure {
            width: 445px;
            height: 445px;

        }

        @media screen and (min-width:992px) and (max-width:1200px) {
            .figure {
                width: 370px;
                height: 370px;
            }
        }

        @media screen and (min-width:769px) and (max-width:991px) {
            .figure {
                width: 270px;
                height: 270px;
            }
        }

        @media screen and (max-width:768px) {
            .media {
                flex-direction: column;
            }

            .figure {
                order: 2
            }
        }
    </style>
</head>

<body>
    <!-- 選單 -->
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
    <!-- 幻燈片 -->
    <div id="carouselExampleCaptions" class="carousel slide mb-5" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0"   class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
           
        </ol>
        <div class="carousel-inner">
            <!-- 以下 -->
            <div class="carousel-item active">
                <img src="https://cdn.pixabay.com/photo/2019/10/14/20/09/nature-4549913_1280.jpg" class="d-block w-100"
                    alt="...">
                <div class="carousel-caption">
                    <h3>Second slide label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <button type="button" class="btn btn-info">Button</button>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://cdn.pixabay.com/photo/2019/10/19/20/39/nature-4562221_1280.jpg" class="d-block w-100"
                    alt="...">
                <div class="carousel-caption">
                    <h3>Third slide label</h3>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    <button type="button" class="btn btn-info">Button</button>
                </div>

            </div>
            <div class="carousel-item">
                <img src="https://cdn.pixabay.com/photo/2017/01/14/12/59/iceland-1979445_1280.jpg" class="d-block w-100"
                    alt="...">
                <div class="carousel-caption">
                    <h3>Example headline.</h3>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    <button type="button" class="btn btn-info">Button</button>
                </div>
            </div>
            
            
            <!-- 以上 -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- card -->
    <div class="container">
        <div class="card_container d-flex flex-lg-row flex-column justify-content-between py-5">
            <div class="card text-center">
                <img class="card-img-top rounded-circle mx-auto"
                    src="https://cdn.pixabay.com/photo/2016/11/18/21/10/wolf-1836875_1280.jpg" alt="">
                <div class="card-body">
                    <h3 class="card-title">Heading</h3>
                    <p class="card-text">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id
                        dolor
                        id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at
                        eros.
                        Praesent commodo cursus magna.</p>
                    <button class="btn btn-primary">details</button>
                </div>
            </div>
            <div class="card text-center">
                <img class="card-img-top rounded-circle  mx-auto"
                    src="https://cdn.pixabay.com/photo/2016/11/20/11/09/winter-1842508_1280.jpg" alt="">
                <div class="card-body">
                    <h3 class="card-title">Heading</h3>
                    <p class="card-text">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id
                        dolor
                        id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at
                        eros.
                        Praesent commodo cursus magna.</p>
                    <button class="btn btn-primary">details</button>

                </div>
            </div>
            <div class="card text-center">
                <img class="card-img-top rounded-circle  mx-auto"
                    src="https://cdn.pixabay.com/photo/2017/07/25/01/22/cat-2536662_1280.jpg" alt="">
                <div class="card-body">
                    <h3 class="card-title">Heading</h3>
                    <p class="card-text">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id
                        dolor
                        id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at
                        eros.
                        Praesent commodo cursus magna.</p>
                    <button class="btn btn-primary">details</button>
                </div>
            </div>
        </div>
        <hr class="my-6">
    </div>
    <!-- main -->
    <div class="container">
        <div class="media py-5 align-items-center">
            <div class="media-body text-center col-md-7 align-self-center mr-md-5 mr-sm-0 px-0">
                <h1>First featurette heading.</h1>
                <h1>It’ll blow your mind.</h1 class="display-4">
                <p>Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.
                    Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
                    commodo.</p>
            </div>
            <figure class="figure col-md-5 p-0 mt-sm-3">
                <img class="img-fluid" src="https://cdn.pixabay.com/photo/2019/12/06/17/44/japanese-4677848_1280.jpg"
                    alt="">
            </figure>
        </div>
        <hr>
        <div class="media py-5 align-items-center">
            <figure class="figure col-md-5 p-0 mt-sm-3">
                <img class="img-fluid" src="https://cdn.pixabay.com/photo/2019/12/10/07/18/ice-4685227_1280.jpg" alt="">
            </figure>
            <div class="media-body text-center col-md-7 align-self-center ml-md-5 ml-sm-0 px-0">
                <h1>First featurette heading.</h1>
                <h1>It’ll blow your mind.</h1 class="display-4">
                <p>Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.
                    Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
                    commodo.</p>
            </div>
        </div>
        <hr>
        <div class="media py-5 align-items-center">
            <div class="media-body text-center col-md-7 align-self-center mr-md-5 mr-sm-0 px-0">
                <h1>First featurette heading.</h1>
                <h1>It’ll blow your mind.</h1 class="display-4">
                <p>Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.
                    Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus
                    commodo.</p>
            </div>
            <figure class="figure col-md-5 p-0 mt-sm-3">
                <img class="img-fluid" src="https://cdn.pixabay.com/photo/2019/12/08/01/08/winter-4680354_1280.jpg"
                    alt="">
            </figure>
        </div>
        <hr>
    </div>
    <!-- footer -->
    <div class="container footer d-flex justify-content-between py-5">
        <span>© 2017-2018 Company, Inc. ·<a href=""> Privacy </a>· <a href="">Terms</a></span><span><a href="">Back to
                top</a></span>
    </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>