<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="addInventoryLabel">Add Inventory</h3>
</div>

@if(!$inventory)
    <form method="POST" action="{{action('ProjectsController@anyManageInventory', $project->uuid)}}">
        @else
            <form method="POST" action="{{action('ProjectsController@anyManageInventory', [$project->uuid, $inventory->uuid])}}">
                @endif

<div class="modal-body">
    <div class="form-group">

        <div class="col-md-12">
            <label class="control-label" for="itemName">Item Name</label>
            <input type="text" class="form-control" id="itemName" name="item_name"
                   value="{{$inventory ? $inventory->item_name : ''}}">
            <span class="text-danger itemNameError" style="display: none">The name field is required.</span>
        </div>

        <div class="col-md-12" style="padding-bottom: 15px"></div>

        <div class="col-md-4">
            <label class="control-label" for="quantity">Quantity</label>
            <input type="text" class="form-control" id="quantity" name="quantity"
                   value="{{$inventory ? $inventory->quantity : ''}}">

            <span class="text-danger quantityError" style="display: none">The quantity field is required.</span>
        </div>

        <div class="col-md-4">
            <label class="control-label" for="unit">Unit</label>
            <select class="form-control" id="unit" name="unit_id">
                @foreach($units as $unit)
                    <option value="{{$unit->id}}"
                    <? $inventory ? ($unit->id === $inventory->unit_id ? 'selected' :
                            '') : ''?>>
                        {{$unit->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="control-label" for="price">Item Price</label>
            <input type="text" class="form-control" id="price" name="contact_number"
                   value="{{$inventory ? $inventory->price : ''}}">

            <span class="text-danger priceError" style="display: none">The price field is required.</span>
        </div>

        <div class="col-md-12" style="padding-bottom: 15px"></div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary btn-save-item">Save changes</button>
</div>

@if(!$inventory)
    </form>
    @else
    </form>
@endif
