@extends('admin.layouts.app')

@section('title', 'Category')

@section('admin_content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">+ Add New</button>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Category List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Icon</th>
                    <th>Show on Homepage</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach( $categories as $category )
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td></td>
                    <td> 
                      @if( $category->home_page == 1 )
                        Active
                      @else
                        Deactive
                      @endif
                    </td>
                    <td>                      
                        <button data-id="{{ $category->id }}" data-toggle="modal" data-target="#EditCategoryModal"  class="btn btn-sm btn-primary edit"><i class="fas fa-edit"></i></button>                        
                        <a href="{{ route('categories.destroy', $category->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fas fa-trash"></i></a>                      
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>


<!-- Add New Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('categories.store') }}" method="POST">
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
            <x-input-text type="text" name="name" id="name" placeholder="Enter category name." required/>
            <x-input-error :messages="$errors->get('name')"/>
          </div>       
          
          <div class="form-group">
            <x-label for="icon" value="Category Icon"/>
            <x-input-text type="file" name="icon" id="icon" class="dropify" required/>
            <x-input-error :messages="$errors->get('name')"/>
          </div>        
            
          <div class="form-group">
            <x-label for="home_page" value="Show on Homepage"/>
            <select name="home_page" id="home_page" class="custom-select form-control">
              <option value="1">Active</option>
              <option value="0">Deactive</option>
            </select>
            <x-input-error :messages="$errors->get('name')"/>
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

<!-- Edit Category Modal -->
<div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="updateCategory">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
            <div class="form-group">
              <x-label for="name" value="Category Name"/>
              <x-input-text type="text" name="name" id="category_name" value="" required/>
              <x-input-text type="hidden" name="id" id="categoryId" value="" />
              <span class="error-messages error_name text-danger"></span>
            </div>
            <div class="form-group">
              <x-label for="icon" value="Category Icon"/>
              <x-input-text type="file" name="icon" id="icon" class="dropify" required/>
              <x-input-error :messages="$errors->get('name')"/>
            </div>        
              
            <div class="form-group">
              <x-label for="home_page" value="Show on Homepage"/>
              <select name="home_page" id="home_page" class="custom-select form-control">
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
              <x-input-error :messages="$errors->get('name')"/>
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

@push('script')
  
  
<script type="text/javascript">
  // Dropify
  $('.dropify').dropify();

  // Category Edit
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    let cat_id = $(this).data('id');
    $.get("categories/"+cat_id+"/edit", function(data){      
      $('#category_name').val(data.name);
      $('#categoryId').val(data.id);
    });

    $('body').on('submit', '#updateCategory', function(e){
      e.preventDefault();
      $.ajax({
        url: "{{ route('categories.update', '') }}" + '/' + cat_id,
        method: 'PUT',
        data: $('#updateCategory').serialize(),
        dataType: 'json',
        success: function(res){
          if(res){
            toastr.success(res.message);
          }
          setInterval('location.reload()', 3000);  
          $("#updateCategory")[0].reset();
          $('#EditCategoryModal').hide();
          $('.modal-backdrop').remove();
        },
        error:function(error){          
          if(error){
            $('.error-messages').html(error.responseJSON.errors.name);
          }
        }
      });
    });
  });

  // Category Delete
  $(document).on('click', "#delete", function( e ){
    e.preventDefault();
    let link = $(this).attr('href');
    swal({
      title: "Are you sure?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete!",
      cancelButtonText: "No, cancel!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        window.location.href = link;
      } else {
        swal("Cancelled", "data safe", "error");
      }
    });      
  });
</script>

@endpush

@endsection