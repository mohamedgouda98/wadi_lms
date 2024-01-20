<div class="card-body">
    <form action="{{route('categories.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$category->id}}">
        <div class="form-group">
            <label>@translate(Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Name)" required value="{{$category->name}}">
        </div>
        @if($category->icon != null)
            <img src="{{filePath($category->icon)}}" width="80" height="80" class="img-thumbnail" alt="{{ $category->name }}">
        @endif
        <div class="form-group">
            <label>@translate(Icon/Image)</label>
            {{-- <input class="form-control-file" type="file" name="newIcon"> --}}

            <input value="{{ $category->icon }}" name="icon" class="icon" type="file">
        </div>
        <div class="form-group">
            <label>@translate(Parent Category)</label>
            <select class="form-control kt-select2 width-full" id="kt_select2_3" name="parent_category_id">
                <option value="0">@translate(No Parent Category Select)</option>
                @foreach($categories as $item)
                    @if($item->id != $category->id)
                        <option
                            value="{{$item->id}}" {{$category->parent_category_id == $item->id ? 'selected': null}}>{{$item->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>
