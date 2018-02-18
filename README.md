# text-util
Utilities for measuring and wrapping text.

[![Travis][travis-shield]][travis]

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
        $textSplitter,
        $textMeter
    );

    $textWrapper->wrap($text);



# Open questions
* Does the provided interface really make sense? What about:
    * `TextWrapper::wrapFreeTypeText(12, '.../DejaVuSans.ttf', 'Lorem ipsum')`
    * `TextWrapperFactory::createFreeTypeWrapper(12, '.../DejaVuSans.ttf')->wrap('Lorem ipsum')` or similar?
* Should the TextAtomSplitter really be injected into TextWrapper or should the
  TextWrapper::wrap take an array of text atoms as an argument instead?
* phpunit.xml.dist:beStrictAboutCoversAnnotation forces the programmer to
  specify all covered methods. As a result, the used TextAtomSplitter* and
  TextMeter* had to either be mocked or explicitly stated to be covered by the
  tests. Is it worth the effort?
