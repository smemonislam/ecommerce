<script type="text/javascript">
  $(function(){
    var table = $('#ydatatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('subcategory.index') }}",
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex' },
        { data: 'category_id', name: 'category_id' },
        { data: 'subcategory_name', name: 'subcategory_name' },
        { data: 'subcategory_slug', name: 'subcategory_slug' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
    });

    // Add Sub Category
    $('body').on('click', '.subcategory', function(e){
      e.preventDefault();   
      $('.error-messages').html('');   
      $.ajax({
        url: '{{ route("subcategory.store") }}',
        type: "POST",
        data: $('#add-subcategory').serialize(),
        success: function(response){          
          table.draw();
          $('#addCategoryModal').hide();
          $('.modal-backdrop').remove();
          if(response){            
            toastr.success(response.message);
            $('#add-subcategory')[0].reset(); 
          }
        },
        error: function(error){
          if(error){
            $('.error-messages').html(error.responseJSON.errors.name);
          }
        }
      });
    });

    $('body').on('click', '.edit', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "subcategory/"+ id + "/edit",
        method: "GET",
        data: {
          id:id,
          _token: '{{ csrf_token() }}'
        },
        success: function(response){          
          $('#subcategory_id').val(response.subcategories.id);             
          $('#subcategory_name').val(response.subcategories.subcategory_name);             
          var options = '<option value="">Select Option</option>';
          $.each(response.categories, function(key, value) { 
            options += '<option value="' + key + '">' + value + '</option>';
          });
          $('#categoryList').html(options); 
          $('#categoryList option[value="'+response.subcategories.category_id+'"]').attr("selected", "selected");
        }
      });
    });
    

    $('#EditsubCategory').on('submit', function(e){
      e.preventDefault();
      const sub_id = $('#subcategory_id').val();
      $.ajax({
        url: "{{ route('subcategory.update', '') }}" + '/' + sub_id,
        method: 'PUT',
        data: $(this).serialize(),
        success: function(response){
          table.draw();
          $('#EditCategoryModal').hide();
          $('.modal-backdrop').remove();
          $('#EditsubCategory')[0].reset();
          if(response){
            toastr.success(response.message);
          }                   
        },
        error: function(error){
          if(error){
            toastr.error(error.responseJSON.errors.category_id);
            $('.errorerror_subcategory_name').html(error.responseJSON.errors.name);
          }
        }
      });
    });

    $('body').on('click', "#delete", function( e ){
      e.preventDefault();
      const id = $(this).data('id');    
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
          swal({
            title: 'Delete Confirm',
            text: '',
            type: 'success'
          }, function() {
            $.ajax({
              url: "{{ route('subcategory.destroy', '') }}" + '/' + id,
              type: "DELETE",
              data: {
                "_token": "{{ csrf_token() }}"
              },
              success: function(response){
                table.draw();
                if(response){
                  toastr.success(response.success);                         
                }
              }
            });
          });
        } else {
          swal("Cancel", "Data Safe!!", "error");
        }
      });      
    });
  });
</script>