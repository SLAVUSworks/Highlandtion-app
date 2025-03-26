function copyText(element) {
    const tempInput = document.createElement("textarea");
    tempInput.value = element.textContent.trim();
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Teks telah disalin: ' + element.textContent.trim(),
        showConfirmButton: false,
        timer: 1500,
        toast: true,
        position: 'top-right'
    });
}

document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Pastikan semua data sudah benar sebelum mengirim!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, kirim!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});