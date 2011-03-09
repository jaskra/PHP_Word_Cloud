<?php

namespace Dreamcraft\WordCloudBundle\Tests;

use Dreamcraft\WordCloudBundle\Lib\Palette;

class PaletteTest extends \PHPUnit_Framework_TestCase
{
    protected $image;

    public function setUp()
    {
        $this->image = imagecreatetruecolor(100, 100);
    }

    public function tearDown()
    {
        imagedestroy($this->image);
    }

    public function testRandomPalette()
    {
        for($i=1; $i < 10; $i++) {
            $palette = Palette::getRandomPalette($this->image, $i);
            $this->assertTrue(is_array($palette));
            $this->assertEquals($i, count($palette));
            $this->assertPaletteIsNumeric($palette);
        }
    }

    public function testNamedPalette()
    {
        foreach(Palette::listNamedPalettes() as $name) {
            $palette = Palette::getNamedPalette($this->image, $name);
            $this->assertTrue(is_array($palette));
            $this->assertPaletteIsNumeric($palette);
        }

        $palette = Palette::getNamedPalette($this->image, 'unexisting');
        $grey_palette = Palette::getNamedPalette($this->image, 'grey');
        $this->assertTrue(is_array($palette));
        $this->assertPaletteIsNumeric($palette);
        $this->assertEquals($grey_palette, $palette);
    }

    protected function assertPaletteIsNumeric($palette)
    {
        foreach($palette as $color) {
            $this->assertTrue(is_numeric($color));
        }
    }

}