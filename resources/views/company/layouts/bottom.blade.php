<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->

<script>
    function passtotext() {
        var x = document.getElementById("password");
        var hapusclass = document.getElementById("showpass");
        if (x.type != "password") {
            document.getElementById('password').type = 'password';
            document.getElementById('password_lama').type = 'password';
            document.getElementById('confirm-password').type = 'password';
            hapusclass.classList.remove("bi-eye");
            hapusclass.classList.add("bi-eye-slash");
        } else {
            document.getElementById('password').type = 'text';
            document.getElementById('password_lama').type = 'text';
            document.getElementById('confirm-password').type = 'text';
            hapusclass.classList.add("bi-eye");
            hapusclass.classList.remove("bi-eye-slash");
        }
    }


    
    // function favoriteklik(){
    //     var y = document.getElementsByClassName("bi-star")[0];
    //     if (y != "putih") {
    //         y.classList.remove("bi-star");
    //         y.classList.add("bi-star-fill");
    //     } else {
    //         y.classList.add("bi-star");
    //         y.classList.remove("bi-star-fill");
    //     }
    // }
</script>