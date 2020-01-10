<?php


$pattern = '/https?:\/\/stickershop\.line\-scdn\.net\/stickershop\/v1\/sticker\/[0-9]+\/[a-z]+\/sticker\.png/m';
$str='<span class="mdCMN09Image FnPreview" style="background-image:url(https://stickershop.line-scdn.net/stickershop/v1/sticker/98064814/android/sticker.png;compress=true);';
preg_match_all($pattern, $str, $matches);

// echo "<pre>";
// print_r($matches);
// echo "</pre>";

echo "<a href='{$matches[0][0]}'>link</a>";