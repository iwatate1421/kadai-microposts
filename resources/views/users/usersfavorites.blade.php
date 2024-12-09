@if (isset($users))
    <ul class="list-none">
        @foreach ($users as $post)
            <li class="flex items-center gap-x-2 mb-4">
                {{-- ユーザーのメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- ユーザー詳細ページへのリンク --}}
                            <p><a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}"> {{ $user->name }} </a> Posted At {{ $post->created_at }} </p>
                            
                            <p>{{ $post->content }}</p>  {{-- Micropost の content を表示 --}}
                        </div>
                        <div>
                            @if (Auth::id() == $post->user_id)
                                {{-- お気に入り解除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('favorite.destroy', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $post->id }} ?')">お気に入り解除</button>
                                </form>
                            @endif
                        </div>                          
                    </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif