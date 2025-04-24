@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <a
                        href="{{ route('createPost') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                    >
                        Create New Post
                    </a>
                    <ul>
                    @foreach($posts as $post)
                        <li>
                            <span>{{ $post->title }}</span>
                            <div>{{ $post->content }}</div>
                            <span>{{ $post->user->name }}</span>
                            <a
                                href="{{ route('showPost',$post->id) }}"
                                class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                            >
                                View More
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
