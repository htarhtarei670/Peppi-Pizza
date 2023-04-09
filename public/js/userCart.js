$(document).ready(function() {
    //when plus button
    $(".btn-plus").click(function() {
        $parentNode = $(this).parents("tr");
        // $price=$parentNode.find('.price').val();//to get value from input
        $price = Number($parentNode.find("#price").text().replace("kyats", "")); //to get value from text
        $quatity = Number($parentNode.find("#qty").val());

        $total = $price * $quatity;
        $parentNode.find("#total").html(`${$total}kyats`);

        finalpriceCal();
    });

    //when minus button
    $(".btn-minus").click(function() {
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find("#price").text().replace("kyats", ""));
        $quatity = Number($parentNode.find("#qty").val());

        $total = $price * $quatity;
        $parentNode.find("#total").html($total + "kyats");

        finalpriceCal();
    });

    //when cross button
    $(".btn-remove").click(function() {
        $parentNode = $(this).parents("tr");
        $parentNode.remove();

        $productId = $parentNode.find('.productId').val();
        $orderId = $parentNode.find('.orderId').val();


        $.ajax({
            type: 'get',
            url: '/user/ajax/acart',
            data: { 'productId': $productId, 'orderId': $orderId },
            dataType: 'json',
            success: function() {

            }
        })
    });

    // function area
    function finalpriceCal() {
        $totalPrice = 0;
        $("#dataTable tr").each(function(index, row) {
            $totalPrice += Number(
                $(row).find("#total").text().replace("kyats", "")
            );
        });
        $("#surPrice").html($totalPrice + "kyats");
        $("#finalPrice").html(`${$totalPrice + 3000} kyats`);
    }
});