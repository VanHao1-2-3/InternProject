$(document).ready(function () {
  // gửi dữ liệu khi load trang lần đầu
  let filter = "Tất cả";
  let min = 100000;
  let max = 0;
  let search = "";
  let sort = 0;
  $.ajax({
    url: `./ajax/products.php`,
    method: "POST",
    dataType: "json",
    data: { filter: "Tất cả" },
    success: function (data) {
      $(".products_show").html(data['product']);
      $(".product__pagination").html(data['pagination']);
      $(".start").html(data["start"] > 0 ? data["start"] : 1);
      $(".limit").html(data["limit"] + data['start'] <= data['all'] ?data["limit"] + data['start']  : data['all']);
      $(".all").html(data["all"]);
    },
  });
  // gửi dữ liệu khi nhấn vào fillter
  $(".filter").click(function () {
    filter = $(this).data("filter");
    $.ajax({
      url: `./ajax/products.php`,
      method: "POST",
      dataType: "json",
      data: { filter: filter },
      success: function (data) {
        $(".products_show").html(data['product']);
        $(".product__pagination").html(data['pagination']);
        $(".start").html(data["start"] > 0 ? data["start"] : 1);
         $(".limit").html(data["limit"] + data['start'] <= data['all'] ?data["limit"] + data['start']  : data['all']);
        $(".all").html(data["all"]);
      },
    });
  });
  //   sắp xếp lại theo thứ tự tăng giá và giảm giá
  $("#sort").change(function () {
    sort = $("#sort").val();
    $.ajax({
      url: `./ajax/products.php`,
      method: "POST",
      data: { sort: sort, filter, search },
      success: function (data) {
        $(".products_show").html(data['product']);
      },
    });
  });
  // Tìm kiếm sản phẩm theo tên

  $(".search").keyup(function () {
    search = $(".search").val();
    $.ajax({
      url: `./ajax/products.php`,
      method: "POST",
      data: { search, filter },
      success: function (data) {
        $(".products_show").html(data['product']);
        $(".product__pagination").html(data['pagination']);
        $(".start").html(data["start"] > 0 ? data["start"] : 1);
         $(".limit").html(data["limit"] + data['start'] <= data['all'] ?data["limit"] + data['start']  : data['all']);
        $(".all").html(data["all"]);
      },
    });
  });
  //   Lọc sản phẩm khi nhấn vào mức giá nhất định
  $(".sortprice").click(function (e) {
    min = $(this).data("min");
    max = $(this).data("max") > 0 ? $(this).data("max") : 0;
    $.ajax({
      url: `./ajax/products.php`,
      method: "POST",
      data: { min: Number(min), max: Number(max) },
      dataType: "json",
      success: function (data) {
        // let start = data[2] == 0 ? 1 :data[2];
        $(".products_show").html(data['product']);
        $(".product__pagination").html(data['pagination']);
        $(".start").html(data["start"] > 0 ? data["start"] : 1);
         $(".limit").html(data["limit"] + data['start'] <= data['all'] ?data["limit"] + data['start']  : data['all']);
        $(".all").html(data["all"]);
      },
    });
  });
  $(document).on("click", ".pagination", function (e) {
    let page = $(this).data("page");
    $.ajax({
      url: `./ajax/products.php`,
      method: "POST",
      data: { page: Number(page), filter, min, max, search, sort },
      dataType: "json",
      success: function (data) {
        $(".products_show").html(data['product']);
        $(".product__pagination").html(data['pagination']);
        $(".start").html(data["start"] > 0 ? data["start"] : 1);
         $(".limit").html(data["limit"] + data['start'] <= data['all'] ?data["limit"] + data['start']  : data['all']);
        $(".all").html(data["all"]);
      },
    });
  });
});
