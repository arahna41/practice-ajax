(function ($) {
  'use strict';
  $(function () {
    $('#loadmore_product').click(function () {
      var button = $(this),
        productCategory = document.querySelector('#product__category').value,
        productSex = document.querySelector('#product__sex').value,
        productColor = document.querySelector('#product__color').value,
        productSize = document.querySelector('#product__size').value,
        sortByName = document.querySelector('#sort_by_name').value,
        productSearch = document.querySelector('#product__search').value,
        data = {
          action: 'loadmorebutton',
          query: loadmore_products_params.posts,
          page: loadmore_products_params.current_page,
          productCategory: productCategory,
          productSex: productSex,
          productColor: productColor,
          productSize: productSize,
          sortByName: sortByName,
          productSearch: productSearch,
        };

      $.ajax({
        url: loadmore_products_params.ajaxurl,
        data: data,
        dataType: 'json',
        type: 'POST',
        beforeSend: function (xhr) {
          button.addClass('loading');
          button.text('Loading...');
        },
        success: function (data) {
          if (data) {
            $('.products_container').append(data.content);
            button.removeClass('loading');
            button.text('Load more');
            loadmore_products_params.current_page++;

            if (
              data.max_page < 2 ||
              loadmore_products_params.current_page === data.max_page
            ) {
              button.hide();
            } else {
              button.show();
            }
          }
        },
      });
    });
  });
})(jQuery);

/* Filter */
(function ($) {
  'use strict';
  $(function () {
    $('.filters select').change(function () {
      var productCategory = document.querySelector('#product__category').value,
        productSex = document.querySelector('#product__sex').value,
        productColor = document.querySelector('#product__color').value,
        productSize = document.querySelector('#product__size').value,
        sortByName = document.querySelector('#sort_by_name').value,
        productSearch = document.querySelector('#product__search').value,
        data = {
          action: 'filters',
          query: loadmore_products_params.posts,
          page: loadmore_products_params.current_page,
          productCategory: productCategory,
          productSex: productSex,
          productColor: productColor,
          productSize: productSize,
          sortByName: sortByName,
          productSearch: productSearch,
        };
      $.ajax({
        url: loadmore_products_params.ajaxurl,
        data: data,
        dataType: 'json',
        type: 'POST',
        success: function (data) {
          if (data) {
            $('.products_container').html(data.content);

            loadmore_products_params.current_page = 1;
            const button = document.querySelector('#loadmore_product');
            button.style.display = 'block';
            if (
              data.max_page < 2 ||
              loadmore_products_params.current_page === data.max_page
            ) {
              button.style.display = 'none';
            } else {
              button.style.display = 'block';
            }
          }
        },
      });
    });
  });
})(jQuery);

/* Search */
(function ($) {
  'use strict';
  $(function () {
    $('#product__search').keyup(function () {
      var productCategory = document.querySelector('#product__category').value,
        productSex = document.querySelector('#product__sex').value,
        productColor = document.querySelector('#product__color').value,
        productSize = document.querySelector('#product__size').value,
        sortByName = document.querySelector('#sort_by_name').value,
        productSearch = document.querySelector('#product__search').value,
        data = {
          action: 'search',
          query: loadmore_products_params.posts,
          page: loadmore_products_params.current_page,
          productCategory: productCategory,
          productSex: productSex,
          productColor: productColor,
          productSize: productSize,
          sortByName: sortByName,
          productSearch: productSearch,
        };
      $.ajax({
        url: loadmore_products_params.ajaxurl,
        data: data,
        dataType: 'json',
        type: 'POST',
        success: function (data) {
          if (data) {
            $('.products_container').html(data.content);

            loadmore_products_params.current_page = 1;
            const button = document.querySelector('#loadmore_product');
            button.style.display = 'block';
            if (
              data.max_page < 2 ||
              loadmore_products_params.current_page === data.max_page
            ) {
              button.style.display = 'none';
            } else {
              button.style.display = 'block';
            }
          }
        },
      });
    });
  });
})(jQuery);
