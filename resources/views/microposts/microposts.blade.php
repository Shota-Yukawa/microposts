@if (count($microposts) > 0)
    <ul class="list-unstyled">
        @foreach ($microposts as $micropost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($micropost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                    <div class="conteiner">
                        @if (Auth::id() == $micropost->user_id)
                            <div class="row">
                                <div class="col-lg-2">
                                    @if (Auth::user()->now_favorite($micropost->id))
                                        {!! form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                                            {!! form::submit('Unfavorite', ['class' => 'btn btn-danger btn-sm favorite-buttun']) !!}
                                        {!! Form::close() !!}
                                    @else
                                        {!! form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
                                            {!! form::submit('Favorite', ['class' => 'btn btn-success btn-sm favorite-buttun']) !!}
                                        {!!Form::close() !!}
                                    @endif
                                </div>
                                <div class="col-lg-2">
                                    {{-- 投稿削除ボタンのフォーム --}}
                                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @else
                             @if (Auth::user()->now_favorite($micropost->id))
                                {!! form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
                                    {!! form::submit('Unfavorite', ['class' => 'btn btn-denger btn-sm favorite-buttun']) !!}
                                {!! Form::close() !!}
                            @else
                                {!! form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
                                    {!! form::submit('Favorite', ['class' => 'btn btn-success btn-sm favorite-buttun']) !!}
                                {!!Form::close() !!}
                             @endif
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $microposts->links() }}
@endif