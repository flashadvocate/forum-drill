@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">
                            {{ $thread->creator->name }}
                        </a> posted:
                        {{ $thread->title }}
                    </div>
                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
                @foreach($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}


                @if(auth()->check())
                    <form method="post" action="{{ $thread->path() . '/replies/' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                        <textarea name="body" id="body" class="form-control"
                                  placeholder="Type a reply here"
                                  rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
            </div>

            @else
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to view the discussion</p>
            @endif

            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }} by <a
                                href="#">{{ $thread->creator->name }}</a> and currently has {{ count($thread->replies) }} {{ str_plural('comment', count($thread->replies)) }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
