// Call the dataTables jQuery plugin
$(document).ready(function() {
    $('#dataTable').DataTable({
        "language":{
            "url" : "/vendor/datatables/indonesia.json",
            "sEmptyTable" : "Tidads"
        },
        responsive: true,
    });
  });
