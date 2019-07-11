require([
        'jquery',
        'jquery/ui',
    ],
    function ($) {

        var defaultFilterButton = 'Filters';
        var newtFilterButton = 'Close Filters';
        var ajaxUrl= 'http://m2stage.magento2.local/users/grid/view';

        function getOption(currentOption, defaultOption, newOption) {
            return currentOption === defaultOption ? newOption : defaultOption;
        }

        $(document).on("click", ".action-default", function () {
            var currentFilterButton = $(this).text();
            var newFilterButtonText = getOption(currentFilterButton, defaultFilterButton, newtFilterButton);
            $('.action-default').text(newFilterButtonText);
        });

        $(document).on("click", "#more_posts", function () {
            var qty = Number($(this).attr("data-qty"));
            console.log(qty);
            $.post(ajaxUrl, {
                offset: qty,
            }).done(function (posts) {
                var incQty = qty + 3;
                $('#more_posts').attr({"data-qty": incQty});
                $("#ajax-posts").append(posts);
            });
        })
    });