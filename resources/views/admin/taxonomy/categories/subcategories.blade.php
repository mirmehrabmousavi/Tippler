<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}">{{$subcategory->type.' : '}}{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->categories))
        @include('admin.taxonomy.categories.subcategories', ['subcategories' => $subcategory->categories])
    @endif
@endforeach
