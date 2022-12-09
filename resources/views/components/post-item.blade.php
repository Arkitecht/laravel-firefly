@props(['post'])

<x-card>
    <div class="flex justify-between items-center">
        <div class="text-sm text-gray-500">
            {{ __('Posted by') }} {{ $post->user->name }} &#8226; {{ $post->created_at->diffForHumans() }}
        </div>

        <div class="flex space-x-2">
            @can ('reply', $post->discussion)
            <button @click="quote({{$post->id}})" data-tippy-content="{{ __('Quote') }}">
                <span class="sr-only">{{ __('Quote') }}</span>
                <svg class="w-5 h-5 text-gray-700 hover:text-gray-500" data-tippy-content="{{ __('Quote') }}" xmlns="http://www.w3.org/2000/svg" viewBox="3 4 19 16" fill="currentColor" aria-hidden="true">
                    <path d="M19.417 6.679C20.447 7.773 21 9 21 10.989c0 3.5-2.457 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621-.537.278-1.24.375-1.929.311-1.804-.167-3.226-1.648-3.226-3.489a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.099.49 2.748 1.179zm-10 0C10.447 7.773 11 9 11 10.989c0 3.5-2.457 6.637-6.03 8.188l-.893-1.378c3.335-1.804 3.987-4.145 4.247-5.621-.537.278-1.24.375-1.929.311C4.591 12.322 3.17 10.841 3.17 9a3.5 3.5 0 0 1 3.5-3.5c1.073 0 2.099.49 2.748 1.179z"></path>
                </svg>
            </button>
            @endcan

            @if (\Firefly\Features::enabled('correct_posts'))
                @if ($post->is_correct)
                    @can ('unmark', $post)
                        <button onclick="event.preventDefault(); document.getElementById('unmark-post-{{ $post->id }}-form').submit();">
                    @endcan
                        <span class="sr-only">{{ __('Mark as Incorrect') }}</span>
                        <svg class="w-5 h-5 text-gray-700 hover:text-gray-500"  @can ('unmark', $post) data-tippy-content="{{ __('Unmark as Correct') }}" @else data-tippy-content="{{ __('This is Correct') }}" @endcan xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    @can ('unmark', $post)
                        </button>

                        <form id="unmark-post-{{ $post->id }}-form" action="{{ route('firefly.post.incorrect', $post) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endcan
                @elseif(!$post->is_initial_post)
                    @can ('mark', $post)
                        <button onclick="event.preventDefault(); document.getElementById('mark-post-{{ $post->id }}-form').submit();">
                            <span class="sr-only">{{ __('Mark as Correct') }}</span>
                            <svg class="w-5 h-5 text-gray-700 hover:text-gray-500" data-tippy-content="{{ __('Mark as Correct') }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#ffffff" aria-hidden="true" stroke="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <form id="mark-post-{{ $post->id }}-form" action="{{ route('firefly.post.incorrect', $post) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endcan
                @endif
            @endif

            @can ('update', $post)
                <a href="{{ route('firefly.post.edit', $post) }}">
                    <span class="sr-only">{{ __('Edit') }}</span>
                    <svg class="w-5 h-5 text-gray-700 hover:text-gray-500" data-tippy-content="{{ __('Edit') }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                    </svg>
                </a>
            @endcan

            @can ('delete', $post)
                <button onclick="event.preventDefault(); document.getElementById('delete-post-{{ $post->id }}-form').submit();">
                    <span class="sr-only">{{ __('Delete') }}</span>
                    <svg class="w-5 h-5 text-red-500 hover:text-red-400" data-tippy-content="{{ __('Delete') }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>

                <form id="delete-post-{{ $post->id }}-form" action="{{ route('firefly.post.delete', [$post->discussion->id, $post->discussion->slug, $post]) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
            @endcan
        </div>
    </div>

    <div class="mt-2 unreset">
        {!! $post->formatted_content !!}
    </div>

    @can('react', $post)
        @include('firefly::posts.reactions')
    @endcan
</x-card>

