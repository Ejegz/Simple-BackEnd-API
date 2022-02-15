document.addEventListener("DOMContentLoaded", (c) => {
    $("button#btn-login").on("click", () => {
        //Buat event tombol login di click
        var email = $("input[name=email]").val(); //dapatkan isi text email
        var sandi = $("input[name=password]").val(); //dapatkan isi text password

        $.ajax({
            url: "/api/auth",
            dataType: "json",
            method: "GET",
            headers: {
                // Kirim header Authorization = base base64encode {email:password}
                Authorization: "basic " + window.btoa(email + ":" + sandi),
            },
            success: (msg) => {
                alert(
                    `Selamat datang ${msg.data.first_name} ${msg.data.last_name}`
                );
                window.localStorage.setItem("token", msg.data.token); //simpan token dari server
                window.location = "/list-order"; //pindah ke list order
            },
            error: (req, status, err) => {
                console.log(req); // tampilkan log agar dapat dibaca di console web develope tools
                alert(req.responseJSON.error[0]); //tampilkan pesan error dari server
            },
        });
    });
});
