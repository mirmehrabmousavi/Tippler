@if(!empty($category->categories))
    <ol class="dd-list">
        @foreach($category->categories as $kk => $sub_category)
            <li class="dd-item" data-id="{{ $sub_category['id'] }}">
                <div class="dd-handle">
                    <span>{{ $sub_category['name'] }}</span>
                    <a href="{{route('admin.categories.destroy', [$sub_category['id']])}}" class="float-left text-danger dd-nodrag" onclick="event.preventDefault(); document.getElementById('destroy-{{$sub_category['id']}}').submit();"><i class="fa fa-trash text-danger px-1"></i>حذف</a>
                    <form id="destroy-{{$sub_category['id']}}" action="{{ route('admin.categories.destroy', [$sub_category['id']]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    <a href="{{route('admin.categories.edit', [$sub_category['id']])}}" class="float-left text-primary dd-nodrag"><i class="fa fa-pencil text-primary px-1"></i>ویرایش</a>
                </div>
            </li>

            @include('admin.taxonomy.categories.product-subcategory', ['category' => $sub_category])
        @endforeach
    </ol>
@endif
