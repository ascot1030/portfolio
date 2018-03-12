var $tableTasks;
$(function () {
  $tableTasks = $('#table-tasks').DataTable({
    columns: [
      {"data": "category"},
      {"data": "pubdate"},
      {"data": "type"},
      {"data": "budget", className: "text-right"},
      {"data": "client"},
      {"data": "title"},
    ],
    order: [[1, "asc"]],
    processing: true,
    serverSide: true,
    ajax: {
      url: "ajax.php",
      type: 'POST',
      data: function (d) {
        return $.extend(searchFilters, d, {
          action: 'get_tasks',
          category: $("#category").val()
        });
      },
    },
    aoColumnDefs: [
      {
        'bSortable': false,
        'aTargets': ['nosort']
      }
    ],
    responsive: true,
    filter: false,
    pageLength: 25,
    createdRow: function (row, data, index) {
      $(row).find(".task-title").click(function() {
        $(".task-description").hide();
        $desc = $(row).find(".task-description");
        if ($desc.hasClass('showblock')) {
          $desc.removeClass('showblock');
          $desc.fadeOut();
        } else {
          $desc.addClass('showblock');
          $desc.fadeIn();
        }
      })
      new Clipboard('a.task-link');
    },
  });

  setInterval(function () {
    reloadTaskTable();
  }, 300 * 1000);
});

function reloadTaskTable() {
  $tableTasks.ajax.reload(function () {
  }, false);
}