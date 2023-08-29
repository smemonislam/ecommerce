<div class="modal fade" id="EditCouponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editSubcategoy">
      <form id="update_coupon">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">  
          <input type="hidden" name="id" id="coupon_id" value="">
            <div class="form-group">
              <x-label for="coupon_code" value="Coupon Code"/>
              <x-input-text type="text" name="coupon_code" id="coupon_code" value="" required/>
              <span class="error_coupon_code error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="coupon_type" value="Coupon Type"/>
              <select name="coupon_type" id="coupon_type" class="form-control">
                <option value="1">Fixed</option>
                <option value="2">Percentage</option>
              </select>
              <span class="error_coupon_type error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="coupon_amount" value="Coupon Amount"/>
              <x-input-text type="text" name="coupon_amount" id="coupon_amount" value="" required/>
              <span class="error_coupon_amount error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="coupon_date" value="Valid Date"/>
              <x-input-text type="date" name="coupon_date" id="coupon_date" value="" required/>
              <span class="error_coupon_date error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="coupon_status" value="Coupon Status"/>
              <select name="coupon_status" id="coupon_status" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
              <span class="error_coupon_type error-messages text-danger"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <x-button type="submit" class="btn btn-primary" value="Update"/>
        </div>
      </form>
    </div>
  </div>
</div>