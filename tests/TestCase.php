<?php

namespace Firefly\Test;

use Firefly\FireflyServiceProvider;
use Firefly\Test\Fixtures\Discussion;
use Firefly\Test\Fixtures\Group;
use Firefly\Test\Fixtures\Post;
use Firefly\Test\Fixtures\User;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use FakeModels;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations();

        $this->artisan('migrate')->run();

        $this->setupDatabase();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('firefly.api.enabled', true);
        $app['config']->set('firefly.user', User::class);
    }

    /**
     * Define environment for testing watchers.
     */
    protected function usesWatchers($app)
    {
        $app->config->set('firefly.features.watchers', true);
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [FireflyServiceProvider::class];
    }

    /**
     * Add all of the dummy models.
     *
     * @return void
     */
    protected function setupDatabase()
    {
        $this->user = User::create([
            'name' => 'Test Rat',
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        $this->group = Group::create([
            'name' => 'Example Group',
            'color' => '#2964c4',
        ]);

        $this->discussion = Discussion::create([
            'user_id' => $this->user->id,
            'title' => 'Example Discsussion',
        ]);

        $this->post = Post::create([
            'discussion_id' => $this->discussion->id,
            'user_id' => $this->user->id,
            'content' => 'Lorem ipsum',
        ]);
    }
}
