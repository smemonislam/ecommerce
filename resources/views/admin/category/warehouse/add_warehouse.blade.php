<!-- Add New Category Modal -->
<div class="modal fade" id="addWarehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="add_warehouse">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new Warehouse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          <div class="form-group">
            <x-label for="name" value="Warehouse Name"/>
            <x-input-text type="text" name="warehouse_name" id="name" placeholder="Enter Warehouse name." required/>
            <span class="error_name error-messages text-danger"></span>
          </div>   
          <div class="form-group">
            <x-label value="Warehouse Address"/>
            <textarea name="warehouse_address" class="form-control" rows="5" placeholder="Enter Warehouse Address."></textarea>
            <span class="error_address error-messages text-danger"></span>
          </div>     
          <div class="form-group">
            <x-label for="phone" value="Warehouse Phone"/>
            <x-input-text type="text" name="warehouse_phone" id="phone" placeholder="Enter Warehouse Phone." required/>
            <span class="error_phone error-messages text-danger"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <x-button type="submit" class="btn btn-primary warehouse" value="Save"/>
        </div>
      </form>
    </div>
  </div>
</div>