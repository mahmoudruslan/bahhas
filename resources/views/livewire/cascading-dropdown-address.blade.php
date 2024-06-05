<div>
    <div class="form-group row">
        @php
        $edit_mode = false;
            if(isset($expert)) $edit_mode = true
        @endphp
        <div class="col-md-6">
            <select name="country_id" wire:model="country_id"  class="form-control select-radius 
            @error('country_id') is-invalid @enderror">
                <option value="{{$edit_mode ? $expert->country_id : ''}}" >{{ $edit_mode ? $expert->country->name_ar : __("Choose governorate") }}</option>
                @foreach($countries as $item)
                    <option value="{{$item->id}}" >{{$item->name_ar}}</option>
                @endforeach
            </select>
            @error('country_id')
                <span class="text-danger" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </div>
        <div class="col-md-6"> 
            <select name="city_id" wire:model="city_id"  class="form-control select-radius 
            @error('city_id') is-invalid @enderror">
                <option  value="{{$edit_mode && count($cities) < 1 ? $expert->city->id : ''}}" >{{ $edit_mode && count($cities) < 1 ? $expert->city->name_ar : __("Choose city") }}</option>
                @foreach($cities as $item)
                    <option value="{{$item->id}}" >{{$item->name_ar}}</option>
                @endforeach
            </select>
            @error('city_id')
                <span class="text-danger" role="alert">
                    <small>{{ $message }}</small>
                </span>
            @enderror
        </div>
    </div>
</div>
