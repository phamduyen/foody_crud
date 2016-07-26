/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function search(url) {

    var search_value = document.getElementsByClassName("search-value");
    var select = url + "?search=";
    var count;
    for (var i = 0; i < search_value.length; i++) {
        if (search_value[i].value != "") {
            count++;
            if (count > 1)
                select += ";";
            select += search_value[i].name + ":" + search_value[i].value;
        }
         window.location.replace(select);
      //  chuyen += search_value[i].name + ":" + search_value[i].value + ";";
    }
}
;
$(function () {
    
    $('#table_id').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "columnDefs": [ { "targets": 3, "orderable": false } ],//Remove Colum Orderable(Here Col 0 Remove)
    });
});

$(function () {  
    $('#food_table').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "columnDefs": [ { "targets": 3, "orderable": false } ],//Remove Colum Orderable(Here Col 0 Remove)
    });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(150);
        };
        reader.readAsDataURL(input.files[0]);
    }
}