<script type="text/javascript">
  $(function(){
    var table = $('#ydatatable').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ajax: {
        url: "{{ route('products.index') }}",
        data: function (d) {
          d.category_id   = $('#category_id').val()
          d.brand_id      = $('#brand_id').val()
          d.warehouse_id  = $('#warehouse_id').val()
          d.status        = $('#status').val()           
        }
      },
      columns: [
        { data: 'id', name: 'id', orderable: false, searchable: false },
        { data: 'thumbnail', name: 'thumbnail' },
        { data: 'product_name', name: 'product_name' },
        { data: 'product_code', name: 'product_code' },
        { data: 'name', name: 'name' },
        { data: 'subcategory_name', name: 'subcategory_name' },
        { data: 'brand_name', name: 'brand_name' },
        { data: 'featured', name: 'featured' },
        { data: 'today_deal', name: 'today_deal' },
        { data: 'product_slider', name: 'product_slider' },
        { data: 'trendy', name: 'trendy' },        
        { data: 'status', name: 'status' },        
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
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
              url: "{{ route('products.destroy', '') }}" + '/' + id,
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

    // Active Feartured
    $('body').on('click', '.deactive_featured', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/featured_deactive"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Dective Feartured
    $('body').on('click', '.active_featured', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/featured_active"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Active Today Deal
    $('body').on('click', '.deactive_deal', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/deal_deactive"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Dective Today Deal
    $('body').on('click', '.active_deal', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/deal_active"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Active Status
    $('body').on('click', '.active_status', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/status_active"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Dective Status
    $('body').on('click', '.deactive_status', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/status_deactive"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Active Product Slider
    $('body').on('click', '.active_slider', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/slider_active"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Dective Product Slider
    $('body').on('click', '.deactive_slider', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/slider_deactive"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });

     // Active Product trendy
     $('body').on('click', '.active_trendy', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/trendy_active"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });
    // Dective Product trendy
    $('body').on('click', '.deactive_trendy', function(){
      const id = $(this).data('id');
      $.ajax({
        url: "/trendy_deactive"+ '/' + id,
        method: "GET",
        success: function(response){   
          toastr.success(response); 
          table.draw();
        }
      });
    });

    // Filter Prodcut with yajra datatable
    $(document).on('change', '.submitable', function(){
        table.draw();
    });

  });
</script>