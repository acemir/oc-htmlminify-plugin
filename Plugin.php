<?php

namespace DmitryBykov\Htmlminify;

use nochso\HtmlCompressTwig\Extension;
use Event;

class Plugin extends \System\Classes\PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'HTML minify Plugin',
            'description' => 'Any HTML, inline CSS and Javascript will be compressed.',
            'author' => 'Dmitry Bykov',
            'icon' => 'icon-compress',
            'iconSVG' => 'plugins/DmitryBykov/htmlminify/assets/images/logo.png',
            'homepage' => 'https://github.com/Cryden/oc-htmlminify-plugin'
        ];
    }

    public function boot()
    {
        // Event::listen('cms.page.beforeRenderPage', function($controller, $page) {
        //     $twig = $controller->getTwig();
        //     $twig->addExtension(new Extension(true));
        // });

        Event::listen('cms.page.display', function($controller, $path, $page, $content) {
            $htmlcompress = new Extension(true);
            return $htmlcompress->compress($controller->getTwig(), $content);
        }, 10);
    }
}
