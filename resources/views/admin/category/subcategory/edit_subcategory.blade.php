<div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="editSubcategoy">
      <form id="EditsubCategory">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">  
          <input type="hidden" name="id" id="subcategory_id" value="">        
          <div class="form-group">
            <label for="subcategoryName">Categroy Name</label>
            <select class="form-control" id="categoryList" name="category_id">
              
            </select> 
          </div>            
          <div class="form-group">
            <label for="subcategoryName">Sub Categroy</label>
            <input class="form-control" type="text" name="name" id="subcategory_name" value="" required/>
            <span class="error_subcategory_name error-messages text-danger"></span>
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