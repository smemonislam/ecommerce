<!-- Add New Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="add-subcategory">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">  
            <div class="form-group">
              <x-label for="name" value="Category Name"/>
              @php
                $categories = DB::table('categories')->select('id', 'name')->get();    
              @endphp
              <select class="form-control" id="exampleFormControlSelect1" name="category_id">                
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" >{{ $category->name }}</option>                    
                @endforeach
              </select>
            </div>        
            <div class="form-group">
              <x-label for="name" value="Sub Category Name"/>
              <x-input-text type="text" name="name" id="name" placeholder="Enter sub category name." required/>
              <span class="error-name error-messages text-danger"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <x-button type="submit" class="btn btn-primary subcategory" value="Submit"/>
          </div>
        </form>
      </div>
    </div>
  </div>