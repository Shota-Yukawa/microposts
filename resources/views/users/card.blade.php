<div class="card">
    <div class="card-header">
        <h3 class="card-title"> {!! link_to_route('users.show',  $user->name, ['user' => Auth::id()], ['class' => 'black-color', 'style' => 'color:black;']) !!}
        <!--{{ $user->name }}-->
        </h3>
    </div>
    <div class="card-body">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </div>
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')