<?php

namespace Dreamcraft\WordCloudBundle\Tests;

use Dreamcraft\WordCloudBundle\WordCloud;
use Dreamcraft\WordCloudBundle\Lib\Palette;

class WordCloudTest extends \PHPUnit_Framework_TestCase
{
    function testConstructor()
    {
        $font = \realpath(__DIR__ . '/../Resources/fonts/') . '/Arial.ttf';
        $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec felis augue. Cras aliquet quam condimentum libero varius posuere.';
        $cloud = new WordCloud(123, 321, $font, $text);
        $palette = Palette::getPaletteFromHex($cloud->getImage(), array('FFA700', 'FFDF00', 'FF4F00', 'FFEE73'));
        $cloud->render($palette);
        imagedestroy($cloud->getImage());
    }
}