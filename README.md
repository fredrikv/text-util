# text-util
[![Build Status](https://travis-ci.org/fredrikv/text-util.svg?branch=master)](https://travis-ci.org/fredrikv/text-util)

Utilities for measuring and wrapping text.

# Installation
Add the following lines to your composer.json:

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/fredrikv/text-util"
        }
    ],
    "require": {
        "fredrikv/text-util": "dev-master"
    }

and run `composer install`.



# Examples

## TextAtom
Split a string into its smallest atoms according to some rules.

    $textAtomSplitter = new SpaceTextAtomSplitter();
    $textAtomSplitter->split($text);


## TextMeter
    $textMeter = new FreeTypeTextMeter(12, '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf');
    $textMeter->getWidth($text);


## TextWrapper

    $textWrapper = new TextWrapper(
        $textAtomSplitter,
        $textMeter,
        100
    );

    $textWrapper->wrap($text);

## Print wrapped text on the bottom of an image

    use FredrikV\TextUtil\TextAtom\SpaceTextAtomSplitter;
    use FredrikV\TextUtil\TextMeter\FreeTypeTextMeter;
    use FredrikV\TextUtil\TextWrapper\TextWrapper;

    // Initialize variables
    $originalText = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
    $imageWidth       = 500;
    $imageHeight      = 500;
    $fontFile         = '/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf';
    $fontSize         = 12;
    $textAtomSplitter = new SpaceTextAtomSplitter();
    $textMeter        = new FreeTypeTextMeter($fontSize, $fontFile);
    $textWrapper      = new TextWrapper(
        $textAtomSplitter,
        $textMeter,
        $imageWidth
    );


    // Wrap text
    $lines = [];
    foreach ($textWrapper->wrap($originalText) as $line) {
        $lines[] = implode('', $line);
    }

    $wrappedText = implode(PHP_EOL, $lines);
    $textHeight = $textMeter->getHeight($wrappedText);


    // Generate image
    $im = imagecreatetruecolor($imageWidth, $imageHeight);
    $textColor = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
    imagefttext($im, $fontSize, 0, 0, $imageHeight - $textHeight, $textColor, $fontFile, $wrappedText);


    // Output image to the browser
    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);


# Open questions
* Does the provided interface really make sense? What about:
    * `TextWrapper::wrapFreeTypeText(12, '.../DejaVuSans.ttf', 'Lorem ipsum')`
    * `TextWrapperFactory::createFreeTypeWrapper(12, '.../DejaVuSans.ttf')->wrap('Lorem ipsum')` or similar?
* Should the TextAtomSplitter really be injected into TextWrapper or should the
  TextWrapper::wrap take an array of text atoms as an argument instead?
* Should the TextWrapper really return an array of arrays instead of a string?
  The reason for this desicions was to simplify the implementation of
  "text-align: justify;".
* phpunit.xml.dist:beStrictAboutCoversAnnotation forces the programmer to
  specify all covered methods. As a result, the used TextAtomSplitter* and
  TextMeter* had to either be mocked or explicitly stated to be covered by the
  tests. Is it worth the effort?
