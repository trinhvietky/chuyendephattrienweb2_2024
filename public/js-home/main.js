
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) { window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({ scrollTop: 0 }, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    console.log('hello');
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function () {
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity', '0');
    });

    $('.js-hide-modal-search').on('click', function () {
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity', '1');
    });

    $('.container-search-header').on('click', function (e) {
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({ filter: filterValue });
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function () {
        var input = $(this).siblings('.num-product');
        var numProduct = Number($(this).next().val());
        if (numProduct > 0) $(this).next().val(numProduct - 1);
        var quantity = parseInt(input.val());
        input.val(quantity).trigger('change');
    });

    $('.btn-num-product-up').on('click', function () {
        var input = $(this).siblings('.num-product');
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
        var quantity = parseInt(input.val());
        input.val(quantity).trigger('change'); // Triggers change event để cập nhật số lượng
    });

    // Hàm cập nhật thuộc tính data-notify-count
    function updateCartCount() {
        $.ajax({
            url: '/cart/count',  // Gọi route lấy số lượng sản phẩm trong giỏ hàng
            method: 'GET',
            success: function (response) {
                var cartCount = response.count;
                // Cập nhật giá trị của data-notify-count
                $('#cart-notify').attr('data-notify', cartCount);
            },
            error: function (error) {
                console.log('Error fetching cart count', error);
            }
        });
    }

    // Gọi hàm để cập nhật số lượng giỏ hàng khi trang tải
    updateCartCount();

    // Nếu muốn cập nhật khi người dùng thay đổi số lượng trong giỏ hàng
    $('.num-product-cart').on('change', function () {
        updateCartCount();  // Cập nhật số lượng khi thay đổi số lượng sản phẩm
    });

    $(document).ready(function () {
        // Khi thay đổi số lượng sản phẩm
        $('.num-product-cart').on('change', function () {
            var quantity = $(this).val(); // Số lượng mới
            var cartId = $(this).data('cart-id'); // ID giỏ hàng


            // Gửi yêu cầu AJAX để cập nhật số lượng
            $.ajax({
                url: '/shoping-cart/update/' + cartId, // URL của route cập nhật
                method: 'PATCH',
                data: {
                    quantity: quantity, // Số lượng mới
                    _token: $('meta[name="csrf-token"]').attr('content') // Lấy token từ meta tag
                },

                success: function (response) {
                    // Cập nhật lại tổng tiền sau khi thay đổi số lượng
                    $('.total[data-cart-id="' + cartId + '"]').text(response.totalFormatted);
                    updateCartTotal();

                },
                error: function (response) {

                    alert('Lỗi khi cập nhật số lượng.');
                }
            });

        });
    });


    function updateCartTotal() {
        let cartTotal = 0;
        var totalElement = document.querySelectorAll('.total'); // Lấy phần tử chứa giá
        totalElement.forEach(element => {
            var totalText = element.textContent.trim(); // Lấy nội dung văn bản trong phần tử
            var total = parseFloat(totalText.replace(/,/g, '')); // Loại bỏ dấu phẩy và chuyển thành số
            cartTotal += total

        });

        // Hiển thị tổng giỏ hàng
        document.querySelector('#cart-total').innerText = cartTotal.toLocaleString();
    }


    // Chọn tất cả checkbox
    const selectAll = document.getElementById('select-all');
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            let isChecked = this.checked;
            // Cập nhật tất cả checkbox của các sản phẩm
            document.querySelectorAll('.select-item').forEach(function (checkbox) {
                checkbox.checked = isChecked;
            });
        });
    }

    // Cập nhật hành động khi thay đổi checkbox sản phẩm
    document.querySelectorAll('.select-item').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            // Lấy danh sách các checkbox đã chọn
            let selectedItems = document.querySelectorAll('.select-item:checked');

            // Lấy hoặc làm gì với các item được chọn, ví dụ xóa hoặc tính tổng
            console.log(selectedItems.length + " items selected");
        });
    });

    document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Ngừng hành động mặc định của button

            const cartId = this.getAttribute('id'); // Lấy ID của sản phẩm trong giỏ
            const deleteButton = this;


            // Gửi yêu cầu AJAX để xóa sản phẩm khỏi giỏ
            fetch(`/shoping-cart/${cartId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    id: cartId
                }) // Nếu cần, bạn có thể gửi dữ liệu thêm
            })
                .then(response => {
                    deleteButton.closest('tr').remove();
                    updateCartCount();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong!');
                });

        });
    });


    const addToCartButton = document.querySelector(".add-to-cart");

    addToCartButton.addEventListener("click", (event) => {
        if (event.target.classList.contains("add-to-cart")) {
            const colorSelect = document.getElementById("colorSelect");
            const sizeSelect = document.getElementById("sizeSelect");
            const quantityInput = document.querySelector(".num-product");

            const colorId = colorSelect.value;
            const sizeId = sizeSelect.value;
            const quantity = parseInt(quantityInput.value, 10);


            $.ajax({
                url: '/cart', // URL của route cập nhật
                method: 'POST',
                data: {
                    color_id: colorId,
                    size_id: sizeId,
                    quantity: quantity,
                    _token: $('meta[name="csrf-token"]').attr('content') // Lấy token từ meta tag
                },

                success: function (response) {
                    updateCartCount();
                    swal({
                        title: "",  // Tiêu đề
                        text: response.message,  // Nội dung
                        icon: "success",  // Icon
                        buttons: {
                            cancel: "Tiếp tục mua sắm",  // Nút Hủy
                            confirm: "Xem giỏ hàng"  // Nút Xác nhận
                        }
                    }).then((value) => {
                        if (value === true) {
                            window.location.href = '/shoping-cart';  // Chuyển hướng đến giỏ hàng
                        } else {
                            // Nếu người dùng nhấn "Tiếp tục mua sắm"
                            console.log("Tiếp tục mua sắm");
                        }
                    });


                },
                error: function (xhr) {
                    if (xhr.status === 401) {
                        // Hiển thị thông báo yêu cầu đăng nhập
                        swal({
                            title: "Thông báo",
                            text: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.",
                            icon: "warning",
                            buttons: {
                                cancel: "Đóng",
                                confirm: "Đăng nhập"
                            }
                        }).then((value) => {
                            if (value === true) {
                                // Chuyển hướng đến trang đăng nhập
                                window.location.href = '/login';
                            }
                        });
                    } else {
                        // Hiển thị lỗi khác
                        alert("Có lỗi xảy ra: " + xhr.responseText);
                    }
                }
            });
        }
    });


    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function () {
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function () {
            var index = item.index(this);
            var i = 0;
            for (i = 0; i <= index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on('mouseleave', function () {
            var i = 0;
            for (i = 0; i <= rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/
    $('.js-show-modal1').on('click', function (e) {
        e.preventDefault();
        $('.js-modal1').addClass('show-modal1');
    });

    $('.js-hide-modal1').on('click', function () {
        $('.js-modal1').removeClass('show-modal1');
    });





})(jQuery);