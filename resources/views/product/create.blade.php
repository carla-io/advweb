<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Frontend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
<body>

<div class="row">
    <div class="col-md-6 offset-3" style="margin-top: 100px">
        <!-- Button trigger modal -->
    

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-title"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" placeholder="Example input placeholder">
                        </div>
                        <div class="form-group mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" class="form-control" id="quantity" placeholder="Another input placeholder">
                        </div>
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" placeholder="Another input placeholder">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Another input placeholder">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveBtn"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h2>Product List</h2>
    
    <table id="productTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#productTable').DataTable({
        "ajax": {
            "url": "/api/products", // URL to your API endpoint
            "type": "GET",
            "dataSrc": "data" // Adjust this according to your API response
        },
        "columns": [
            { "data": "id" },
            { "data": "product_name" },
            { "data": "quantity" },
            { "data": "price" },
            { "data": "description" },
            {
                "data": null,
                "defaultContent": '<button class="editBtn">Edit</button> <button class="deleteBtn">Delete</button>'
            }
        ]
    });

    // Handle Edit Button Click
    $('#productTable tbody').on('click', '.editBtn', function() {
        var data = $('#productTable').DataTable().row($(this).parents('tr')).data();
        alert('Edit product with ID: ' + data.id);
        // Implement edit functionality here
    });

    // Handle Delete Button Click
    $('#productTable tbody').on('click', '.deleteBtn', function() {
        var data = $('#productTable').DataTable().row($(this).parents('tr')).data();
        if (confirm('Are you sure you want to delete product with ID: ' + data.id + '?')) {
            $.ajax({
                url: '/api/products/delete',
                type: 'DELETE',
                data: { product_id: data.id },
                success: function(response) {
                    alert('Product deleted successfully');
                    $('#productTable').DataTable().ajax.reload();
                },
                error: function(response) {
                    alert('Error deleting product');
                }
            });
        }
    });
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- 
  <script>
    $(document).ready(function(){
        $('#modal-title').html('Create Product');
        $('#saveBtn').html('Save Product');

        $('#saveBtn').click(function(){
            var productname = $('#product_name').val();
            console.log(productname)
        })
    });
 
  </script> -->

</body>
</html>
