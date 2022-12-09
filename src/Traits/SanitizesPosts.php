<?php

namespace Firefly\Traits;

use Firefly\Features;

trait SanitizesPosts
{
    /**
     * Returns sanitized content for Posts when using rich formatting and the wysiwyg editor.
     *
     * @param  array  $requestData
     * @return array
     */
    public function getSanitizedPostData(array $requestData)
    {
        $formatting = (isset($requestData['formatting'])) ? $requestData['formatting'] : 'plain';

        if (Features::enabled('wysiwyg') && $formatting === 'rich') {
            $notAllowedTags = ['script'];
            foreach ($notAllowedTags as $tag) {
                $requestData['content'] = preg_replace('/<\\/?'.$tag.'(.|\\s)*?>/i', '', $requestData['content']);
            }

            $requestData['content'] = $this->validateAndSanitizeHtml($requestData['content']);
        }

        return $requestData;
    }

    protected function validateAndSanitizeHtml($content)
    {
        $prevUseErrors = libxml_use_internal_errors(true);
        $content = mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8');

        //Set up self closing elements array
        $selfClosingElements = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];

        //Set up a dom parser with the content
        $dom = new \DOMDocument();
        $dom->loadHTML('<root>'.$content.'</root>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $xpath = new \DOMXPath($dom);

        //Remove any unclosed elements (ignoring self-closing ones)
        foreach ($xpath->query('//*[not(node())]') as $node) {
            if (! in_array($node->localName, $selfClosingElements)) {
                $node->parentNode->removeChild($node);
            }
        }

        libxml_use_internal_errors($prevUseErrors);

        return $content;
    }
}
