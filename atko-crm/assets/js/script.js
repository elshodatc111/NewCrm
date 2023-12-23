

$(function () {
    $('#dataTable').DataTable({
    "pageLength": 10,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true
    });
});
$(document).ready(function(){
    $('.phone').inputmask('999 99 999 9999');
    $('.pasport').inputmask('AA 9999999');
    $('.pnfl').inputmask('99999999999999');
});

var select_box_element = document.querySelector('#select_box');
dselect(select_box_element, {
    search: true
});
var select_box_element = document.querySelector('#select_box2');
dselect(select_box_element, {
    search: true
});

