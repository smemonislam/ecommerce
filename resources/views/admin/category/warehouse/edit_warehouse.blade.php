<div class="modal fade" id="EditWarehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editChildCategory">     
      <form id="editWarehouse">
          @csrf
          <input type="hidden" name="id" id="warehouse_id" value="">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">          
            <div class="form-group">
              <x-label for="name" value="Warehouse Name"/>
              <input type="text" class="form-control" name="warehouse_name" id="w_name" value="" required>
              <span class="error_name error-messages text-danger"></span>
            </div>   
            <div class="form-group">
              <x-label value="Warehouse Address"/>
              <textarea name="warehouse_address" class="form-control" id="w_address" rows="5" value=""></textarea>
              <span class="error_address error-messages text-danger"></span>
            </div>     
            <div class="form-group">
              <x-label for="phone" value="Warehouse Phone"/>
              <input type="text" class="form-control" name="warehouse_phone" id="w_phone" value="" required>
              <span class="error_phone error-messages text-danger"></span>
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <x-button type="submit" class="btn btn-primary" value="Submit"/>
          </div>
      </form>
    </div>
  </div>
</div>