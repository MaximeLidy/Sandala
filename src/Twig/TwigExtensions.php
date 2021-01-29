<?php
// The namespace according to the bundle and the path
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Highlight\Highlighter;

class TwigExtensions extends AbstractExtension
{
    protected $highlighter;

    public function getFilters()
    {
        return array(
            new TwigFilter('highlightCode', array($this, 'highlightCode')),
        );
    }

    public function __construct(){
        $this->highlighter = new Highlighter();
    }

    public function highlightCode($code, $language){
        // Create highlight object
        try {
            $result = $this->highlighter->highlight($language, $code);
        } catch (\Exception $e) {
        }

        // Return ready to render markup
        return   "<pre>"
            ."<code class=\"hljs {$result->language}\">{$result->value}</code>"
            ."</pre>";
    }

    public function getName()
    {
        return 'TwigExtensions';
    }
}