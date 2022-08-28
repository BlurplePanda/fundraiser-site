<?php
/*<!-- https://php.happycodings.com/graphics/code62.html
Replaced some parameters with new variable names for clarity

Thermometer  Goal Graph

The solution was to write a small PHP script that could be called to build the graphic on the fly.  The script is called as the source of an image tag.  It expects the following parameters:

Current - Current Amount Raised  (eg. 3000)
Goal - Goal Amount (eg. 10000)
Width - Width of the chart in pixels (60 is a good start)
Height - Height of the chart in pixels (150 is a good start)
Font - The font used (1=small, 2=bigger...)

To generate the graph at the right using the above example setting, the script would be called from your html as follows (assuming you have named the script thermometer.php and it's in the same directory as the html file):

<img border="0" src="thermometer.php?Current=3000&Goal=10000&Width=60&Height=150&Font=1">
This script requires access to a web server that supports PHP and that has the "GD" graphic library installed.
-------- Script Starts Here ------->*/

function thermGraph( $current, $goal, $width, $height, $font ) {

    $bar = 0.50;

    // create the image
    $image = ImageCreate($width, $height);
    $bg    = ImageColorAllocate($image,255,255,255 );
    $fg    = ImageColorAllocate($image,255,0,0);
    $tx    = ImageColorAllocate($image,0,0,0);

    $bulbtop = $height-$width;
    $bulbcenterx = $width/2;
    $bulbcentery = $height-($width/2);
    $bulbwidth = $width;
    $bulbheight = $width;

    $barleft = $bulbcenterx-($bulbcenterx*$bar);
    $barright = $bulbcenterx+($bulbcenterx*$bar);
    $barbottom = $bulbtop;

    //  Build background
    ImageFilledRectangle($image,0,0,$width,$height,$bg);

    //  Build bottom bulb
    imagearc($image, $bulbcenterx, $bulbcentery, $bulbwidth, $bulbheight, 0, 360, $fg);
    ImageFillToBorder($image, $bulbcenterx, $bulbcentery, $fg, $fg);

    //  Build "Bottom level" - the very start of the bar (so that it is not weirdly circular and gappy)
    ImageFilledRectangle($image,
        $barleft,
        $barbottom,
        $barright,
        $bulbcentery,
        $fg );

    //  Draw Top Border
    ImageRectangle( $image,
        $barleft,
        0,
        $barright,
        $barbottom,
        $fg);

    //  Fill to %
    ImageFilledRectangle( $image,
        $barleft,
        $barbottom * (1-($current/$goal)),
        $barright,
        $barbottom,
        $fg );

    //  Add tic's
    for( $k=25; $k<100; $k+=25 ) {

        ImageFilledRectangle( $image,
            $barright -5,
            $barbottom - ($barbottom)*($k/100) -0.5,
            $barright -1,
            ($barbottom) - ($barbottom)*($k/100)+0.5,
            $tx );


        ImageString($image, $font,
            $barright +2,
            (($barbottom) - ($barbottom)*($k/100)) - (ImageFontHeight($font)/2),
            sprintf( "%2d", $k),$tx);
    }

    // Add % over BULB
    $pct = sprintf( "%d%%", ($current/$goal)*100 );
    $pct_font = $font+2;
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