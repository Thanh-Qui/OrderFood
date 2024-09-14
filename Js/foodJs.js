function isUser(){

    var hoten = document.querySelector("#formUser input[name*='hoten']").value;
    if (hoten.length === 0) {
        document.querySelector("#formUser input[name*='hoten']").focus();
        document.getElementById('noteUser').innerHTML = "Vui lòng nhập đầy đủ họ tên";
        // event.preventDefault();
        return false;
    }

    var username = document.querySelector("#formUser input[name*='username']").value;
    if (username.length === 0) {
        document.querySelector("#formUser input[name*='username']").focus();
        document.getElementById('noteUser').innerHTML = "Vui lòng nhập tài khoản";
        // event.preventDefault();
        return false;
    }
    else if (username.length < 8) {
        document.querySelector("#formUser input[name*='username']").focus();
        document.getElementById('noteUser').innerHTML = "Tài khoản phải có từ 8 ký tự trở lên";
        // event.preventDefault();
        return false;
    }

    var password = document.querySelector("#formUser input[name*='password']").value;
    if (password.length === 0) {
        document.querySelector("#formUser input[name*='password']").focus();
        document.getElementById('noteUser').innerHTML = "Vui lòng nhập mật khẩu";
        // event.preventDefault();
        return false;
    }
    else if (password.length < 6) {
        document.querySelector("#formUser input[name*='password']").focus();
        document.getElementById("noteUser").innerHTML = "Mật khẩu phải từ 6 ký tự trở lên";
        // event.preventDefault();
        return false;
    }

    return true;
}

function isUpdateUser(){

    var hoten = document.querySelector("#formUpdateUser input[name*='hoten']").value;
    if (hoten.length === 0) {
        document.querySelector("#formUpdateUser input[name*='hoten']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập đầy đủ họ tên";
        return false;
    }

    var UpdateUsername = document.querySelector("#formUpdateUser input[name*='username']").value;
    if (UpdateUsername.length === 0) {
        document.querySelector("#formUpdateUser input[name*='username']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập tài khoản!";
        return false;
    } else if (UpdateUsername.length < 8) {
        document.querySelector("#formUpdateUser input[name*='username']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Tài khoản phải từ 8 ký tự trở lên";
        return false;
    }

    return true;

}

function isChangePw() {

    var old_password = document.querySelector("#formChangePass input[name*='old_password']").value;
    if (old_password.length === 0) {
        document.querySelector("#formChangePass  input[name*='old_password']").focus();
        document.getElementById("noteChange").innerHTML = "Vui lòng nhập mật khẩu cũ";
        return false;
    }

    var new_password = document.querySelector("#formChangePass input[name*='new_password']").value;
    if (new_password.length === 0) {
        document.querySelector("#formChangePass  input[name*='new_password']").focus();
        document.getElementById("noteChange").innerHTML = "Vui lòng nhập mật khẩu mới";
        return false;
    } else if (new_password.length < 6) {
        document.querySelector("#formChangePass  input[name*='new_password']").focus();
        document.getElementById("noteChange").innerHTML = "Mật khẩu phải từ 6 ký tự trở lên";
        return false;
    }

    var confirm_password = document.querySelector("#formChangePass input[name*='confirm_password']").value;
    if (confirm_password.length === 0) {
        document.querySelector("#formChangePass  input[name*='confirm_password']").focus();
        document.getElementById("noteChange").innerHTML = "Vui lòng nhập lại mật khẩu mới";
        return false;
    }


    return true;
}

function isAddLoaiMon(){
    
    var tenloai = document.querySelector("#formAddLoaiMon input[name*='tenloai']").value;
    if (tenloai.length === 0) {
        document.querySelector("#formAddLoaiMon input[name*='tenloai']").focus();
        document.getElementById("noteAddLoaiMon").innerHTML = "Vui lòng nhập tên loại món!";
        return false;
    }

    var image = document.querySelector("#formAddLoaiMon input[name*='image']").value;
    if (image.length === 0) {
        document.querySelector("#formAddLoaiMon input[name*='image']").focus();
        document.getElementById("noteAddLoaiMon").innerHTML = "Vui lòng nhập hình ảnh minh hoạ!";
        return false;
    }

    return true;
}

function isUpdateLoaiMon() {

    var tenloai = document.querySelector("#formUpdateLoaiMon input[name*='tenloai']").value;
    if (tenloai.length === 0) {
        document.querySelector("#formUpdateLoaiMon input[name*='tenloai']").focus();
        document.getElementById("noteUpdateLM").innerHTML = "Vui lòng nhập tên loại món!";
        return false;
    }

    return true;
}

function isAddMonAn() {

    var tenmon = document.querySelector("#formAddMonAn input[name*='tenmon']").value;
    if (tenmon.length === 0) {
        document.querySelector("#formAddMonAn input[name*='tenmon']").focus();
        document.getElementById("noteAddMonAn").innerHTML = "Vui lòng nhập tên món ăn!";
        return false;
    }else if (tenmon.length < 3) {
        document.querySelector("#formAddMonAn input[name*='tenmon']").focus();
        document.getElementById("noteAddMonAn").innerHTML = "Tên món ăn phải lớn hơn!";
        return false;
    }

    var mota = document.querySelector("#formAddMonAn textarea[name*='mota']").value;
    if (mota.length === 0) {
        document.querySelector("#formAddMonAn textarea[name*='mota']").focus();
        document.getElementById("noteAddMonAn").innerHTML = "Vui lòng nhập mô tả cho món ăn!";
        return false;
    }

    var gia = document.querySelector("#formAddMonAn input[name*='gia']").value;
    if (gia.length === 0) {
        document.querySelector("#formAddMonAn input[name*='gia']").focus();
        document.getElementById("noteAddMonAn").innerHTML = "Vui lòng nhập đơn giá hợp lệ cho món ăn!";
        return false;
    } else if (Number(gia) <= 0) {
        document.querySelector("#formAddMonAn input[name*='gia']").focus();
        document.getElementById("noteAddMonAn").innerHTML = "Đơn giá phải là số dương!";
        return false;
    }

    var image_monan = document.querySelector("#formAddMonAn input[name*='image_monan']").value;
    if (image_monan.length === 0) {
        document.querySelector("#formAddMonAn input[name*='image_monan']").focus();
        document.getElementById("noteAddMonAn").innerHTML = " Vui lòng chọn hình ảnh minh hoạ cho món ăn!";
        return false;
    }
    

    return true;
}

function isUpdateMonAn() {

    var tenmon = document.querySelector("#formUpdateMonAn input[name*='tenmon']").value;
    if (tenmon.length === 0) {
        document.querySelector("#formUpdateMonAn input[name*='tenmon']").focus();
        document.getElementById("noteUpdateMonAn").innerHTML = "Vui lòng nhập tên món ăn!";
        return false;
    }else if (tenmon.length < 3) {
        document.querySelector("#formUpdateMonAn input[name*='tenmon']").focus();
        document.getElementById("noteUpdateMonAn").innerHTML = "Tên món ăn phải lớn hơn!";
        return false;
    }

    var mota = document.querySelector("#formUpdateMonAn textarea[name*='mota']").value;
    if (mota.length === 0) {
        document.querySelector("#formUpdateMonAn textarea[name*='mota']").focus();
        document.getElementById("noteUpdateMonAn").innerHTML = "Vui lòng nhập mô tả cho món ăn!";
        return false;
    }

    var gia = document.querySelector("#formUpdateMonAn input[name*='gia']").value;
    if (gia.length === 0) {
        document.querySelector("#formUpdateMonAn input[name*='gia']").focus();
        document.getElementById("noteUpdateMonAn").innerHTML = "Vui lòng nhập đơn giá hợp lệ cho món ăn!";
        return false;
    } else if (Number(gia) <= 0) {
        document.querySelector("#formUpdateMonAn input[name*='gia']").focus();
        document.getElementById("noteUpdateMonAn").innerHTML = "Đơn giá phải là số dương!";
        return false;
    }


    return true;
}

function isUpdateOrder(){
    
    var soluong = document.querySelector("#formUpdateOrder input[name*='soluong']").value;
    if (soluong.length === 0) {
        document.querySelector("#formUpdateOrder input[name*='soluong']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Vui lòng nhập số lượng món ăn!";
        return false;
    }else if (Number(soluong) <= 0) {
        document.querySelector("#formUpdateOrder input[name*='soluong']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Số lượng phải là số dương";
        return false;
    }

    var tenkh = document.querySelector("#formUpdateOrder input[name*='tenkh']").value;
    if (tenkh.length === 0) {
        document.querySelector("#formUpdateOrder input[name*='tenkh']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Vui lòng nhập họ tên khách hàng!";
        return false;
    }

    var contact = document.querySelector("#formUpdateOrder input[name*='contact']").value;
    if (contact.length === 0) {
        document.querySelector("#formUpdateOrder input[name*='contact']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Vui lòng số điện thoại liên lạc!";
        return false;
    } else if (contact.length < 9) {
        document.querySelector("#formUpdateOrder input[name*='contact']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Số điện thoại không hợp lệ!";
        return false;
    }

    var email = document.querySelector("#formUpdateOrder input[name*='email']").value;
    if (email.length === 0) {
        document.querySelector("#formUpdateOrder input[name*='email']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Vui lòng nhập Email!";
        return false;
    }else if (email.indexOf('@') === -1) {
        document.querySelector("#formUpdateOrder input[name*='email']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Email phải chứa ký tự '@'!";
        return false;
    }

    var diachi = document.querySelector("#formUpdateOrder textarea[name*='diachi']").value;
    if (diachi.length === 0) {
        document.querySelector("#formUpdateOrder textarea[name*='diachi']").focus();
        document.getElementById("noteUpdateOrder").innerHTML = "Vui lòng nhập nhập địa chỉ giao hàng!";
        return false;
    }


    return true;
}

function isAddUser() {

    var hoten = document.querySelector("#formAddUser input[name*='hoten']").value;
    if (hoten.length === 0) {
        document.querySelector("#formAddUser input[name*='hoten']").focus();
        document.getElementById("noteAddUser").innerHTML = "Vui lòng nhập đầy đủ họ tên!";
        return false;
    }
    
    var username = document.querySelector("#formAddUser input[name*='username']").value;
    if (username.length === 0) {
        document.querySelector("#formAddUser input[name*='username']").focus();
        document.getElementById("noteAddUser").innerHTML = "Vui lòng nhập tài khoản đăng nhập";
        return false;
    }else if (username.length < 8) {
        document.querySelector("#formAddUser input[name*='username']").focus();
        document.getElementById("noteAddUser").innerHTML = "Tài khoản phải từ 8 ký tự trở lên";
        return false;
    }

    var password = document.querySelector("#formAddUser input[name*='password']").value;
    if (password.length === 0) {
        document.querySelector("#formAddUser input[name*='password']").focus();
        document.getElementById("noteAddUser").innerHTML = "Vui lòng nhập mật khẩu";
        return false;
    } else if (password.length < 6) {
        document.querySelector("#formAddUser input[name*='password']").focus();
        document.getElementById("noteAddUser").innerHTML = "Mật khẩu phải từ 6 ký tự trở lên";
        return false;
    }

    var email = document.querySelector("#formAddUser input[name*='email']").value;
    if (email.length === 0) {
        document.querySelector("#formAddUser input[name*='email']").focus();
        document.getElementById("noteAddUser").innerHTML = "Vui lòng nhập email";
        return false;
    } else if (email.indexOf('@') === -1) {
        document.querySelector("#formAddUser input[name*='email']").focus();
        document.getElementById("noteAddUser").innerHTML = "Email phải chứa ký tự '@' ";
        return false;
    }

    var sdt = document.querySelector("#formAddUser input[name*='sdt']").value;
    if (sdt.length === 0) {
        document.querySelector("#formAddUser input[name*='sdt']").focus();
        document.getElementById("noteAddUser").innerHTML = "Vui lòng nhập số điện thoại";
        return false;
    } else if (sdt.length < 10) {
        document.querySelector("#formAddUser input[name*='sdt']").focus();
        document.getElementById("noteAddUser").innerHTML = "Mật khẩu phải từ 10 số trở lên";
        return false;
    }
    
    var diachi = document.querySelector("#formAddUser input[name*='diachi']").value;
    if (diachi.length === 0) {
        document.querySelector("#formAddUser input[name*='diachi']").focus();
        document.getElementById("noteAddUser").innerHTML = "Vui lòng nhập địa chỉ";
        return false;
    }
    
    return true;
}

function isUpdateUser() {

    var hoten = document.querySelector("#formUpdateUser input[name*='hoten']").value;
    if (hoten.length === 0) {
        document.querySelector("#formUpdateUser input[name*='hoten']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập đầy đủ họ tên!";
        return false;
    }

    var username = document.querySelector("#formUpdateUser input[name*='username']").value;
    if (username.length === 0) {
        document.querySelector("#formUpdateUser input[name*='username']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập tài khoản đăng nhập";
        return false;
    }else if (username.length < 8) {
        document.querySelector("#formUpdateUser input[name*='username']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Tài khoản phải từ 8 ký tự trở lên";
        return false;
    }

    var email = document.querySelector("#formUpdateUser input[name*='email']").value;
    if (email.length === 0 ) {
        document.querySelector("#formUpdateUser input[name*='email']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập email!";
        return false;
    }else if (email.indexOf('@') === -1) {
        document.querySelector("#formUpdateUser input[name*='email']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Email phải chứa ký tự '@' ";
        return false;
    }

    var sdt = document.querySelector("#formUpdateUser input[name*='sdt']").value;
    if (sdt.length === 0) {
        document.querySelector("#formUpdateUser input[name*='sdt']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập số điện thoại liên lạc!";
        return false;
    }else if (sdt.length < 10) {
        document.querySelector("#formUpdateUser input[name*='sdt']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Số điện thoại phải từ 10 số trở lên!";
        return false;
    }

    var diachi = document.querySelector("#formUpdateUser input[name*='diachi']").value;
    if (diachi.length === 0) {
        document.querySelector("#formUpdateUser input[name*='diachi']").focus();
        document.getElementById("noteUpdateUser").innerHTML = "Vui lòng nhập địa chỉ!";
        return false;
    }

    return true;
}

function isChangePWUser() {

    var old_password = document.querySelector("#formChangePWUser input[name*='old_password']").value;
    if (old_password.length === 0) {
        document.querySelector("#formChangePWUser input[name*='old_password']").focus();
        document.getElementById("noteChangePWUser").innerHTML = " Vui lòng nhập mật khẩu cũ!";
        return false;
    }

    var new_password = document.querySelector("#formChangePWUser input[name*='new_password']").value;
    if (new_password.length === 0) {
        document.querySelector("#formChangePWUser input[name*='new_password']").focus();
        document.getElementById("noteChangePWUser").innerHTML = " Vui lòng nhập mật khẩu cũ!";
        return false;
    }

    var confirm_password = document.querySelector("#formChangePWUser input[name*='confirm_password']").value;
    if (confirm_password.length === 0) {
        document.querySelector("#formChangePWUser input[name*='confirm_password']").focus();
        document.getElementById("noteChangePWUser").innerHTML = " Vui lòng nhập mật khẩu cũ!";
        return false;
    }

    return true;
}

// function isShowMessage() {
//     var messageBox = document.getElementById("messageBox");
//     messageBox.style.display = "flex";
//     document.getElementById("show").style.display = "none";
// }

function isShowMessage(idmes) {
    var messageBox = document.getElementById("messageBox-" + idmes);
    messageBox.style.display = "flex";
    document.getElementById("show-" + idmes).style.display = "none";
}

function isDelete(){

    var confirmation = confirm("Bạn có muốn xoá thông tin này không?");
    if (confirmation == true) {
        // alert("Bạn đã xoá loại món này");
        return true;
    }else{
        // alert("Không xoá loại món này");
        return false;
    }
}