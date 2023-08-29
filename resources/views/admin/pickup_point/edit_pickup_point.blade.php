<div class="modal fade" id="EditPickupPointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editPickupPoint">
      <form id="update_pickup_point">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Pickup Point</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"> 
          <input type="hidden" id="pickup_id" name="id" value="">                     
          <div class="form-group">
            <x-label for="name" value="Pickup Point"/>
            <x-input-text type="text" name="pickup_point_name" id="name" value="" />
            <span class="error_pickup_point_name error-messages text-danger"></span>
          </div>
          <div class="form-group">
            <x-label for="address" value="Address"/>
            <textarea name="pickup_point_address" class="form-control" id="address" value="" rows="4"></textarea>
            <span class="error_pickup_point_address error-messages text-danger"></span>
          </div>
          <div class="form-group">
            <x-label for="phone" value="Phone Number"/>
            <x-input-text type="text" name="pickup_point_phone" id="phone" value="" />
            <span class="error_pickup_point_phone error-messages text-danger"></span>
          </div>
          <div class="form-group">
            <x-label for="phone_two" value="Another Phone Number"/>
            <x-input-text type="text" name="pickup_point_phone_two" id="phone_two" value="" />
            <span class="error_pickup_point_phone error-messages text-danger"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <x-button type="submit" class="btn btn-primary" value="Update Pickup Point"/>
        </div>
      </form>
    </div>
  </div>
</div>