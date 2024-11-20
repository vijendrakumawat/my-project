<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Product List</title>
</head>
<body>
<h1 style="text-align: center;">Product List</h1>

    <a href="{{ url('/product/create') }}" style="float:right;">Add New Product</a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">NO</th>
      <th scope="col">NAME</th>
      <th scope="col">DESCRIPTION</th>
      <th scope="col">PRICE</th>
      <th scope="col">EDIT/DELETE</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($products as $product)
    <tr>
   
      <th scope="row">{{ $product->id }}</th>
      <td>{{ $product->name }}</td>
      <td>{{ $product->description }}</td>
      <td>{{ $product->price }}</td>
      <td><a href="{{ url('/product/' . $product->id . '/edit') }}">Edit</a>
      <!-- <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $product->id }})">Delete</button> -->
      <button class="btn btn-danger deleteProduct" data-id="{{ $product->id }}">Delete</button>

                <!-- <form action="{{ url('/product/' . $product->id) }}" method="POST" style="display:inline;" class="second">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form> -->
              </td>   
    </tr>
    @endforeach
  </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
   $(".deleteProduct").click(function(){
    var btn = $(this);
    var id = $(this).data("id");
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
  
    $.ajax(
        {
            url: "/product/"+id,
            type: 'DELETE',
            dataType: "JSON",
            data: {
                "id": id,
                "_method": 'DELETE',
                "_token": '{{ csrf_token() }}'  // Laravel CSRF token for security
                ,
            },
            success: function (response)
            {
              Swal.fire(
                        'Deleted!',
                        response.message,
                        'success',
                        
                    );
                     // Or update the UI to reflect deletion

            }
          }
          )}
        });

    console.log("It failed");
});

</script>




</body>
</html>
