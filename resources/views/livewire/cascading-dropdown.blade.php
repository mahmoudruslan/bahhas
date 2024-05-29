<div>
    <div class="form-group row">
        @php
        $edit_mode = false;
            if(isset($product)) $edit_mode = true
        @endphp
        <div class="col-md-6">
            <select name="category_id" wire:model="category_id"  class="form-control select-radius 
            @error('category_id') is-invalid @enderror">
                <option value="{{$edit_mode ? $product->category->id : ''}}" >{{ $edit_mode ? $product->category->name_ar : __("Choose category") }}</option>
                @foreach($categories as $item)
                    <option value="{{$item->id}}" >{{$item->name_ar}}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-danger" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </div>
        <div class="col-md-6"> 
            <select name="sub_category_id" wire:model="sub_category_id"  class="form-control select-radius 
            @error('sub_category_id') is-invalid @enderror">
                <option  value="{{$edit_mode  ? $product->subCategory->id : ''}}" >{{ $edit_mode ? $product->subCategory->name_ar : __("Choose sub category") }}</option>
                @foreach($sub_categories as $item)
                    <option value="{{$item->id}}" >{{$item->name_ar}}</option>
                @endforeach
            </select>
            @error('sub_category_id')
                <span class="text-danger" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </div>
    </div>
</div>
