<form action="{{ route('brands.update', $brnads->id) }}" method="POST" enctype="multipart/form-data">
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
        <x-label for="name" value="Brand Name"/>
        <x-input-text type="text" name="brand_name" id="name" value="{{ $brnads->brand_name }}" />
        <span class="error-brand_name error-messages text-danger"></span>
      </div>        
      <div class="form-group">
        <x-label for="name" value="Brand Logo"/>
        <input type="file" class="dropify" name="image" data-height="140" id="input-file-now" required/>
        <input type="hidden" class="form-control" name="old_image" value="{{ $brnads->brand_logo }}">
        <span class="error-image error-messages text-danger"></span>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <x-button type="submit" class="btn btn-primary" value="Submit"/>
    </div>
</form>

<script>
  $('.dropify').dropify({
    messages: {
      'default': 'Drag and drop or click',
      'replace': 'Drag and drop or click to replace',
      'remove':  'Remove',
      'error':   'Ooops, something wrong happended.'
    }
  });
</script>