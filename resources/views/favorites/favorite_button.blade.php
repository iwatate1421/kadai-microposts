    @if (Auth::user()->is_favorite($micropost->id))
        {{-- アンフォローボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-block normal-case">お気に入り解除</button>
        </form>
    @else
        {{-- フォローボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">お気に入り登録</button>
        </form>
    @endif
