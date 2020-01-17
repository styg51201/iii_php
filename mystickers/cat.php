<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cat</title>
    <style>
        @keyframes walk {
            0% {
                background-position: left top;
            }

            100% {
                background-position: -3150px top;
            }
        }

        .cat {
            width: 350px;
            height: 380px;
            margin: 20px auto;
            background: url(./cat.png) left;
            animation: walk .6s Infinite;
            animation-timing-function: steps(9);
        }

        .cat:hover {
            animation-play-state: paused;
        }

        
    </style>
</head>

<body>
    <div class="cat"></div>
</body>

</html>