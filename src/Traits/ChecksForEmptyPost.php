<?php

namespace Firefly\Traits;

use Firefly\Features;

trait ChecksForEmptyPost
{
    /**
     * Prepare the data for validation. Check for empty HTML post.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if (Features::enabled('wysiwyg') && $this->request->get('content') == '<p><br></p>') {
            $this->merge([
                'content' => '',
            ]);
        }
    }
}
