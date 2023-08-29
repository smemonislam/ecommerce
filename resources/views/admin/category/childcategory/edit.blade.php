<form action="{{ route('childcategory.update', $childcat->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">          
      <div class="form-group">
        <x-label for="name" value="Category/Sub Category Name"/>
        @php
          $categories = DB::table('categories')->select('id', 'name')->get();    
        @endphp
        <select class="form-control" id="exampleFormControlSelect1" name="subcategory_id">                
          @foreach ($categories as $category)
          @php
            $subcategories = DB::table('sub_categories')->where('category_id', $category->id)->get();
          @endphp
          <option>{{ $category->name }}</option> 
            @foreach ($subcategories as $row)
              <option value="{{ $row->id }}" @if($row->id == $childcat->subcategory_id) selected @endif>----{{ $row->subcategory_name }}</option>                    
            @endforeach                   
          @endforeach
        </select>
      </div>        
      <div class="form-group">
        <x-label for="name" value="Child Category Name"/>
        <x-input-text type="text" name="name" id="name" value="{{ $childcat->name }}" required/>
        <span class="error-name error-messages text-danger"></span>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <x-button type="submit" class="btn btn-primary" value="Submit"/>
    </div>
</form>