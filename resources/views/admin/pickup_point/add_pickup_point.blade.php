<!-- Add New Category Modal -->
<div class="modal fade" id="addPickupPointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="add-pickup-point">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Pickup Point</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">                      
            <div class="form-group">
              <x-label for="pickup_point_name" value="Pickup Point"/>
              <x-input-text type="text" name="pickup_point_name" id="pickup_point_name" />
              <span class="error_pickup_point_name error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="pickup_point_address" value="Address"/>
              <textarea name="pickup_point_address" class="form-control" id="pickup_point_address" rows="4"></textarea>
              <span class="error_pickup_point_address error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="pickup_point_phone" value="Phone Number"/>
              <x-input-text type="text" name="pickup_point_phone" id="pickup_point_phone" />
              <span class="error_pickup_point_phone error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="pickup_point_phone_two" value="Another Phone Number"/>
              <x-input-text type="text" name="pickup_point_phone_two" id="pickup_point_phone_two" />
              <span class="error_pickup_point_phone error-messages text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <x-button type="submit" class="btn btn-primary" value="Add Pickup Point"/>
          </div>
        </form>
      </div>
    </div>
  </div>