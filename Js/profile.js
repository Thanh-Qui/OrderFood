function toggleDropdownMenu() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    if (dropdownMenu.style.display === 'grid') {
        dropdownMenu.style.display = 'none';
    } else {
        dropdownMenu.style.display = 'grid';
    }
}

// Đóng menu khi người dùng nhấp ra ngoài menu
window.onclick = function(event) {
    if (!event.target.matches('#userIcon')) {
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu.style.display === 'grid') {
            dropdownMenu.style.display = 'none';
        }
    }
}


function isChangeInfo() {
    var hoten = document.querySelector("#formChangeInfo input[name*='hoten']").value;
    if (hoten.length === 0) {
        document.querySelector("#formChangeInfo input[name*='hoten']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Vui lòng nhập đầy đủ họ tên";
        return false;
    }

    var email = document.querySelector("#formChangeInfo input[name*='email']").value;
    if (email.length === 0) {
        document.querySelector("#formChangeInfo input[name*='email']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Vui lòng nhập địa chỉ";
        return false;
    }else if (email.indexOf('@') === -1) {
        document.querySelector("#formChangeInfo input[name*='email']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Email phải chứa ký tự '@' ";
        return false;
    }

    var sdt = document.querySelector("#formChangeInfo input[name*='sdt']").value;
    if (sdt.length === 0) {
        document.querySelector("#formChangeInfo input[name*='sdt']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Vui lòng nhập số điện thoại";
        return false;
    }else if (sdt.length < 10) {
        document.querySelector("#formChangeInfo input[name*='sdt']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Số điện thoại phải trên 10 số";
        return false;
    }

    var diachi = document.querySelector("#formChangeInfo input[name*='diachi']").value;
    if (diachi.length === 0) {
        document.querySelector("#formChangeInfo input[name*='diachi']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Vui lòng nhập địa chỉ";
        return false;
    }else if (diachi.length < 3) {
        document.querySelector("#formChangeInfo input[name*='diachi']").focus();
        document.getElementById("noteChangeInfo").innerHTML = "Địa chỉ phải từ 3 ký tự trở lên";
        return false;
    }

    return true;
}

function isMessage() {
    var message = document.querySelector("#formMessage textarea[name*='message']").value;
    if (message.length === 0) {
        document.querySelector("#formMessage textarea[name*='message']").focus();
        document.getElementById("noteMessage").innerHTML = "Vui lòng nhập tin nhắn!";
        return false;
    }

    return true;
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