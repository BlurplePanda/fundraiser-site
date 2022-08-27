<?php
/* This code was originally sourced from https://php.happycodings.com/graphics/code62.html
   It created a vertical "thermometer" style completion graph.
   I have altered it significantly, for code clarity (ie replacing variable names) and to be horizontal. */

function thermGraph( $current, $goal, $width, $height, $font ) {
    $bar = 0.5;

    // create the image
    $image = ImageCreate($width, $height);
    $bg    = ImageColorAllocate($image,255,255,255 );
    $fg    = ImageColorAllocate($image,0,75,200);
    $tx    = ImageColorAllocate($image,0,0,0);

    $bulbright = $height;
    $bulbcenterx = $height/2;
    $bulbcentery = $height/2;
    $bulbwidth = $height;
    $bulbheight = $height;

    $bartop = $bulbcentery-($bulbcentery*$bar);
    $barbottom = $bulbcentery+($bulbcentery*$bar);
    $barleft = $bulbright;
    $barwidth = $width - $barleft;

    //  Build background
    ImageFilledRectangle($image,0,0,$width,$height,$bg);

    //  Build bottom bulb
    imagearc($image, $bulbcenterx, $bulbcentery, $bulbwidth, $bulbheight, 0, 360, $fg);
    ImageFillToBorder($image, $bulbcenterx, $bulbcentery, $fg, $fg);

    //  Build Bottom level
    ImageFilledRectangle($image,
        $bulbcenterx,
        $bartop,
        $barleft,
        $barbottom,
        $fg );

    //  Draw Top Border
    ImageRectangle( $image,
        $barleft,
        $bartop,
        $width-0.0000000000001, // to make the "top"(right) line actually visible
        $barbottom,
        $fg);

    //  Fill to %
    ImageFilledRectangle( $image,
        $barleft,
        $bartop,
        $barleft + ($barwidth * ($current/$goal)),
        $barbottom,
        $fg );

    //  Add tic's
    for( $k=25; $k<100; $k+=25 ) {

        ImageFilledRectangle( $image,
            ($barleft + ($barwidth)*($k/100) -0.5),
            $barbottom -6,
            ($barleft + ($barwidth)*($k/100) +0.5),
            $barbottom -1,
            $tx);

        $tick = sprintf( "$%2d", $k*$goal*0.01);

        ImageString($image, $font,
            ($barleft + ($barwidth)*($k/100) -0.5) - (strlen($tick)/2)*ImageFontWidth($font),
            $barbottom+2,
            $tick,$tx);
    }

    // Add % or "Complete" over BULB
    if($current/$goal >= 1) {
        $pct = "100%";
    }
    else {
        $pct = sprintf( "%d%%", ($current/$goal)*100 );
    }

    $pct_font = $font +3;
    ImageString( $image, $pct_font, ($bulbcenterx)-((strlen($pct)/2)*ImageFontWidth($pct_font)),
        ($bulbcentery)-(ImageFontHeight($pct_font) / 2),
        $pct, $bg);


    // send the image
    header("content-type: image/png");
    imagepng($image);
}

thermGraph(
    $_GET["Current"],
    $_GET["Goal"],
    $_GET["Width"],
    $_GET["Height"],
    $_GET["Font"] );
?>