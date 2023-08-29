<!-- Add New Category Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="upload_brands" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          <div class="form-group">
            <x-label for="name" value="Brand Name"/>
            <x-input-text type="text" name="brand_name" id="name" placeholder="Enter brand name." />
            <span class="error-brand_name error-messages text-danger"></span>
          </div>        
          <div class="form-group">
            <x-label for="name" value="Brand Logo"/>
            <input type="file" class="dropify" name="image" />
            <span class="error-image error-messages text-danger"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <x-button type="submit" class="btn btn-primary brands" value="Submit"/>
        </div>
      </form>
    </div>
  </div>
</div>