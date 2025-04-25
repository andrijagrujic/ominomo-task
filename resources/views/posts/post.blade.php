@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div style="white-space:nowrap">
                        <label for="post-title">{{ __('Title:') }}</label>
                        <span id="post-title">{{ $post->title }}</span>
                    </div>
                    <label for="post-content">{{ __('Content:') }}</label>
                    <div id="post-content">{{ $post->content }}</div>
                    <div style="white-space:nowrap">
                        <label for="post-author">{{ __('Author:') }}</label>
                        <span id="post-author">{{ $post->user->name }}</span>
                    </div>

                    @if (Auth::user() && Auth::user()->id == $post->user->id)
                        <a
                            href="{{ route('editPost',$post->id) }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Edit
                        </a>
                    @endif
                    @if (Auth::user() && (Auth::user()->id == $post->user->id || Auth::user()->is_admin))
                        <form method="POST" action="{{ route('deletePost', $post->id) }}">
                            @csrf
                            @method('DELETE')
                        <button
                            type="submit"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                        >
                            Delete
                        </button>
                        </form>
                    @endif


                    <br>
                    {{ __('Comments:') }}
                        <ul>
                            @foreach($comments as $comment)
                                <li>
                                    <span>{{ $comment->name }}</span>
                                    <div>{{ $comment->comment }}</div>
                                    @if (Auth::user() && $comment->user)
                                        @if (Auth::user()->id == $comment->user->id || Auth::user()->id == $post->user->id || Auth::user()->is_admin)
                                        <form method="POST" action="{{ route('deleteComment', $comment->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                        @endif
                                    @elseif (Auth::user())
                                        @if (Auth::user()->is_admin)
                                            <form method="POST" action="{{ route('deleteComment', $comment->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                                                >
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </li>
                                <br>
                            @endforeach

                                <li>
                                    <form method="POST" action ="{{ route('addComment', $post->id) }}">
                                        @csrf
                                        @if (!Auth::user())
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" required name="name" autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                            @enderror
                                        @endif
                                        <textarea id="comment" class="form-control @error('content') is-invalid @enderror" required name="comment"></textarea>
                                        @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <button
                                            type="submit"
                                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                                        >
                                            Add Comment
                                        </button>
                                    </form>
                                </li>
                        </ul>


                </div>
            </div>
        </div>
    </div>
@endsection
