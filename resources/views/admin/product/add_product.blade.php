<!-- Add New Category Modal -->
<div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="add-coupon">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Coupon</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">                      
            <div class="form-group">
              <x-label for="couponCode" value="Coupon Code"/>
              <x-input-text type="text" name="coupon_code" id="couponCode" />
              <span class="error_coupon_code error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="couponType" value="Coupon Type"/>
              <select name="coupon_type" id="couponType" class="form-control">
                <option value="1">Fixed</option>
                <option value="2">Percentage</option>
              </select>
              <span class="error_coupon_type error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="couponAmount" value="Coupon Amount"/>
              <x-input-text type="text" name="coupon_amount" id="couponAmount" />
              <span class="error_coupon_amount error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="couponDate" value="Valid Date"/>
              <x-input-text type="date" name="coupon_date" id="couponDate" />
              <span class="error_coupon_date error-messages text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="couponStatus" value="Coupon Status"/>
              <select name="coupon_status" id="couponStatus" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
              <span class="error_coupon_type error-messages text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <x-button type="submit" class="btn btn-primary subcategory" value="Add Coupon"/>
          </div>
        </form>
      </div>
    </div>
  </div>