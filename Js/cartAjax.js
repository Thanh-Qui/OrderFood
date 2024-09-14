function updateQuantity(idcart) {
    var soluong = document.getElementById("soluong_" + idcart).value; // Lấy giá trị số lượng từ input

    $.ajax({
        url: 'update-cart.php', // URL của file xử lý cập nhật giỏ hàng
        type: 'POST',
        data: {
            idcart: idcart,
            soluong: soluong
        },
        success: function(response) {
            // Xử lý phản hồi từ server, ví dụ: cập nhật lại giỏ hàng hoặc thông báo thành công
            // console.log('Cập nhật số lượng thành công!');
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu có
            console.error(xhr.responseText);
        }
    });
}


function ratingFood(idmonan, iduser, rating) {
    if (!iduser) {
        alert("Bạn cần phải đăng nhập để đánh giá món ăn");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "rating.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Xử lý phản hồi từ server
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            if (xhr.responseText.trim() === "success") {
                alert("Đã đánh giá thành công!");
            } else {
                alert("Lỗi: " + xhr.responseText);  // Hiển thị lỗi từ server
            }
        }
    };

    // Gửi dữ liệu qua AJAX
    xhr.send("idmonan=" + idmonan + "&iduser=" + iduser + "&rating=" + rating);
}
