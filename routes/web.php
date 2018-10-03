<?php

Route::get('/', 'ForumController@index')->name('forum.index');

// Groups...
Route::get('{tag}', 'GroupController@show')->name('group.show');

// Discussions...
Route::get('{discussion}-{slug}', 'DiscussionController@show')->name('discussion.show');
Route::put('{discussion}-{slug}/lock', 'DiscussionController@lock')->name('discussion.lock');
Route::put('{discussion}-{slug}/unlock', 'DiscussionController@unlock')->name('discussion.unlock');
Route::put('{discussion}-{slug}/stick', 'DiscussionController@stick')->name('discussion.stick');
Route::put('{discussion}-{slug}/unstick', 'DiscussionController@unstick')->name('discussion.unstick');
Route::get('{tag}/discussion/create', 'DiscussionController@create')->name('discussion.create');
Route::post('{tag}/discussion', 'DiscussionController@store')->name('discussion.store');
Route::put('{discussion}-{slug}', 'DiscussionController@update')->name('discussion.update');
Route::delete('{discussion}-{slug}', 'DiscussionController@delete')->name('discussion.delete');
Route::patch('discussions/{discussion}/hide', 'DiscussionController@hide')->name('discussion.hide');
Route::patch('discussions/{discussion}/unhide', 'DiscussionController@unhide')->name('discussion.unhide');

// Posts...
Route::post('{discussion}-{slug}', 'PostController@store')->name('post.store');
Route::put('{discussion}-{slug}/{post}', 'PostController@update')->name('post.update');
Route::delete('{discussion}-{slug}/{post}', 'PostController@delete')->name('post.delete');
Route::patch('posts/{post}/hide', 'PostController@hide')->name('post.hide');
Route::patch('posts/{post}/unhide', 'PostController@unhide')->name('post.unhide');
