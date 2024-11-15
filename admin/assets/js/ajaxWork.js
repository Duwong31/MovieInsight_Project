

function showProductItems(){  
    $.ajax({
        url:"./adminView/viewAllProducts.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
function showCategory(){  
    $.ajax({
        url:"./adminView/viewCategories.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}


function showCustomers(){
    $.ajax({
        url:"./adminView/viewCustomers.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

//add movie data
function addItems(){
    var p_name = $('#p_name').val();
    var p_date = $('#p_date').val();
    var p_duration = $('#p_duration').val();
    var p_desc = $('#p_desc').val();
    var p_director = $('#p_director').val(); 
    var p_actors = $('#p_actors').val(); 
    var genres = $('#genres').val(); 
    var upload=$('#upload').val();
    var file = $('#file')[0].files[0];

    var fd = new FormData();
    fd.append('p_name', p_name);
    fd.append('p_date', p_date);
    fd.append('p_duration', p_duration);
    fd.append('p_desc', p_desc);
    fd.append('p_director', p_director); 
    fd.append('p_actors', p_actors);
    fd.append('genres', genres); // Thay category thành genres
    fd.append('file', file);
    fd.append('upload', upload);
    $.ajax({
        url: "./controller/addItemController.php",
        method: "post",
        data: fd,
        processData: false,
        contentType: false,
        success: function(data){
            alert('Movie Added successfully.');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}

//edit product data
function itemEditForm(id){
    $.ajax({
        url:"./adminView/editItemForm.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}

//update product after submit
function updateItems() {

    var movie_id = $('#movie_id').val();
    var p_name = $('#p_name').val();
    var p_date = $('#p_date').val();
    var p_duration = $('#p_duration').val();
    var p_desc = $('#p_desc').val();
    var p_director = $('#p_director').val();
    var p_actors = $('#p_actors').val(); 
    var genres = $('#genres').val();
    var existingImage = $('#existingImage').val();
    var newImage = $('#newImage')[0].files[0];

    var fd = new FormData();
    fd.append('movie_id', movie_id);
    fd.append('p_name', p_name);
    fd.append('p_date', p_date);
    fd.append('p_duration', p_duration);
    fd.append('p_desc', p_desc);
    fd.append('p_director', p_director);
    fd.append('p_actors', p_actors);
    fd.append('genres', genres);
    fd.append('existingImage', existingImage);
    fd.append('newImage', newImage);

    $.ajax({
        url: './controller/updateItemController.php',
        method: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            alert('Data Update Success.');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}

//delete movie data
function itemDelete(id){
    $.ajax({
        url:"./controller/deleteItemController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Movie Successfully deleted');
            $('form').trigger('reset');
            showProductItems();
        }
    });
}

//delete genres data
function genresDelete(id){
    $.ajax({
        url:"./controller/genresDeleteController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Genres Successfully deleted');
            $('form').trigger('reset');
            showCategory();
        }
    });
}

//delete size data
function sizeDelete(id){
    $.ajax({
        url:"./controller/deleteSizeController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            alert('Size Successfully deleted');
            $('form').trigger('reset');
            showSizes();
        }
    });
}

function search(id){
    $.ajax({
        url:"./controller/searchController.php",
        method:"post",
        data:{record:id},
        success:function(data){
            $('.eachCategoryProducts').html(data);
        }
    });
}




function checkout(){
    $.ajax({
        url:"./view/viewCheckout.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
    });
}
