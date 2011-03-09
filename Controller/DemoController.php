<?php

namespace Dreamcraft\WordCloudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response ;
use Dreamcraft\WordCloudBundle\WordCloud;
use Dreamcraft\WordCloudBundle\Lib\Palette;

class DemoController extends Controller
{
    /**
     * @extra:Route("/")
     */
    public function indexAction()
    {
        $font = \realpath(__DIR__ . '/../Resources/fonts/') . '/Arial.ttf';
        $text = <<<EOF
LIIP LIIP LIIP LIIP LIIP LIIP LIIP
Lausanne Lausanne Lausanne Lausanne 
LIIP DÉBARQUE SUR L'ARC LÉMANIQUE DÈS MARS 2011
Notre canal Twitter l'a laissé transparaître depuis quelques temps, aujourd'hui c'est chose faite.
Liip s'est installé en plein coeur de Lausanne, à la rue de Bourg 11-13, avec une extraordinaire équipe de développeurs. Durant le dernier semestre 2010, avant même que les travaux d'aménagement ne soient terminés, des clients renommés de la région ont eu recours à nos services et nous ont confié leurs projets. Le siège de l'UEFA à Nyon ou le CHUV à Lausanne en font partie. Les méthodes de développement web agile suscitent de plus en plus d'intérêt en Suisse Romande.
Vous serez bien sûr invités prochainement à l'inauguration de ces nouveaux bureaux par l'intermédiaire de ce canal.
EOF;
        $cloud = new WordCloud(500, 500, $font, $text);
        $palette = Palette::getPaletteFromHex($cloud->getImage(), array('FFA700', 'FFDF00', 'FF4F00', 'FFEE73'));
        $cloud->render($palette);

        $file = tempnam(getcwd(), 'img');
        imagepng($cloud->getImage(), $file);
        $img = file_get_contents($file);
        unlink($file);
        imagedestroy($cloud->getImage());

        return new Response ($img, 200, array ( 'Content-Type' => 'image/png'));
    }

}
