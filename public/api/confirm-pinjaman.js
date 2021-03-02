axios.get('api/transaction/get/' + id).then((response) => {
    // console.log(response.data.data)
    let value = response.data.data
    if (value.bukti_pembayaran == null) {
        $('#title').html(value.title)
        let month = value.created_at.substr(5, 2)
        month.length == 2 ? month = month.substr(1, 1) : ''
        let year = value.created_at.substr(0, 4)
        $('#message').html(bulan_tahun(month, year))
        let total_sub_transaction = 0
        $.each(value.sub_transaction, function(index, value) {
            total_sub_transaction += parseInt(value.besaran)
        })
        $('#total_sub_transaction').html(rupiah(total_sub_transaction))
        $('#data').removeClass('hide')
        $('#loading_data').remove()
    } else {
        window.history.back()
    }
}).catch((err) => {
    // console.log(err)
})

$('#form').submit(function(e) {
    // console.clear()
    e.preventDefault()
    addLoading()
    let formData = new FormData()
    formData.append('bukti_pembayaran', picture)
    axios.post('api/transaction/bukti_pembayaran/' + id, formData).then((response) => {
        // console.log(response)
        let url
        level == 'confirm' ? url = `pinjaman/${pinjaman}` : url = `admin/pinjaman/${user}/${pinjaman}`
        location.href = root + url
    }).catch((xhr) => {
        removeLoading('Kirim')
        let err = xhr.response.data.errors
        // console.log(err)
        if (err.bukti_pembayaran) {
            $('#picture').addClass('is-invalid')
            $('#picture-feedback').html('Masukkan foto bukti pembayaran')
        }
    })
})
