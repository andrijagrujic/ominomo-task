@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                                <span>{{ $post->title }}</span>
                                <div>{{ $post->content }}</div>
                                <span>{{ $post->user->name }}</span>

                    <a
                        href="{{ route('editPost',$post->id) }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                    >
                        Edit
                    </a>
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

                        <ul>
                            @foreach($comments as $comment)
                                <li>
                                    <span>{{ $comment->user->name }}</span>
                                    <div>{{ $comment->comment }}</div>
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
                                </li>
                            @endforeach
                            <li>
                                <form method="POST" action ="{{ route('addComment', $post->id) }}">
                                    @csrf
                                    <textarea id="comment" class="form-control" name="comment"></textarea>
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
