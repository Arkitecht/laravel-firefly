<?php

namespace Firefly\Events;

use Firefly\Models\Discussion;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DiscussionWatched
{
    use Dispatchable, SerializesModels;

    /**
     * Discussion being watched
     *
     * @var Discussion
     */
    public $discussion;

    /**
     * User associated
     *
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Discussion $discussion
     * @param User       $user
     *
     * @return void
     */
    public function __construct(Discussion $discussion, $user)
    {
        $this->discussion = $discussion;
        $this->user = $user;
    }
}
