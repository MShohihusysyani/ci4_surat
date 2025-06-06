//tombol hapus
$(".tombol-logout").on("click", function (e) {
  e.preventDefault(); //matikan fungsi href nya terlebih dahulu dengan event

  const href = $(this).attr("href"); //kita ambil attribute dari html yang mau kita jadikan flashmassage disini adalah attribut href(link)

  new Swal({
    title: "Warning!",
    text: "Are you sure want to logout?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Logout!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href; //kembalikan nilai true dengan redirect document ke halaman yang dituju
    }
  });
});

const login = $(".login").data("login");

if (login) {
  new Swal({
    title: "Success",
    text: login,
    icon: "success",
    showConfirmButton: true,
  });
}

const sukses = $(".sukses").data("sukses");

if (sukses) {
  new Swal({
    title: "Success",
    text: sukses,
    icon: "success",
    showConfirmButton: false,
  });
}

const eror = $(".eror").data("eror");

if (eror) {
  new Swal({
    title: "Error",
    text: eror,
    icon: "error",
    showConfirmButton: true,
  });
}

//tombol hapus
$(".tombol-tolak").on("click", function (e) {
  e.preventDefault(); //matikan fungsi href nya terlebih dahulu dengan event

  const href = $(this).attr("href"); //kita ambil attribute dari html yang mau kita jadikan flashmassage disini adalah attribut href(link)

  new Swal({
    title: "Apakah anda yakin?",
    text: "Data akan ditolak!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Tolak!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href; //kembalikan nilai true dengan redirect document ke halaman yang dituju
    }
  });
});

//tombol hapus
$(".tombol-usul").on("click", function (e) {
  e.preventDefault(); //matikan fungsi href nya terlebih dahulu dengan event

  const href = $(this).attr("href"); //kita ambil attribute dari html yang mau kita jadikan flashmassage disini adalah attribut href(link)

  new Swal({
    title: "Forward Data?",
    text: "Data akan diforward!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Usulkan!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href; //kembalikan nilai true dengan redirect document ke halaman yang dituju
    }
  });
});

//tombol hapus
$(".tombol-validasi").on("click", function (e) {
  e.preventDefault(); //matikan fungsi href nya terlebih dahulu dengan event

  const href = $(this).attr("href"); //kita ambil attribute dari html yang mau kita jadikan flashmassage disini adalah attribut href(link)

  new Swal({
    title: "Validasi Data?",
    text: "Validasi jika sudah menerima barang pengajuan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Validasi!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href; //kembalikan nilai true dengan redirect document ke halaman yang dituju
    }
  });
});

// sweet alert2 ci4
//berhasil
const swal = $(".swal").data("swal");
if (swal) {
  Swal.fire({
    title: "Data Berhasil",
    text: swal,
    icon: "success",
  });
}

// berhasil login
const swalog = $(".swalog").data("swalog");
if (swalog) {
  Swal.fire({
    title: "Selamat",
    text: swalog,
    icon: "success",
  });
}

//berhasil logout
$(document).ready(function () {
  const swalout = $(".swalout").data("swalout");
  if (swalout) {
    Swal.fire({
      icon: "success",
      title: "Logout Berhasil",
      text: swalout,
    });
  }
});

//tombol hapus
$(".btn-hapus").on("click", function (e) {
  e.preventDefault(); //matikan fungsi href nya terlebih dahulu dengan event

  const href = $(this).attr("href"); //kita ambil attribute dari html yang mau kita jadikan flashmassage disini adalah attribut href(link)

  new Swal({
    title: "Apakah anda yakin?",
    text: "Data yang dihapus tidak bisa dikembalikan!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus Data!",
  }).then((result) => {
    if (result.value) {
      document.location.href = href; //kembalikan nilai true dengan redirect document ke halaman yang dituju
    }
  });
});

const error = $(".error").data("error");

if (error) {
  Swal.fire({
    title: "Oops...",
    text: error,
    icon: "error",
    showConfirmButton: true,
  });
}
