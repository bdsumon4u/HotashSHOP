<ul>
    @foreach($categories as $category)
        @php
            $href = '#';
            if (! $category instanceof \App\Option) {
                $href = '?active_id='.$category->id;
            }
        @endphp
        <li class="{{ request('active_id', 0) == $category->id ? 'active' : '' }}"><a href="{{ $href }}">{{ $category->name }}</a></li>
        @includeWhen(isset($category->childrens), 'components.categories.subtree', ['childrens' => $category->childrens, 'depth' => 1])
    @endforeach
</ul>