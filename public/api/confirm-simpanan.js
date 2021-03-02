axios.get('api/transaction/get/' + id).then((response) => {
    // console.log(response.data.data)
    let value = response.data.data
    if (user == value.user_id && value.bukti_pembayaran == null) {
        $('#title').html(value.title)
        $('#message').html(value.message)
        let sub_transaction = '', total_sub_transaction = 0
        $.each(value.sub_transaction, function(index, value) {
            besaran = rupiah(value.besaran)
            if (value.type == 'simpanan_pokok') {
                sub_transaction += `<li>Simpanan Pokok: ${besaran}</li>`
	            total_sub_transaction += parseInt(value.besaran)
            } else if (value.type == 'simpanan_wajib') {
                sub_transaction += `<li>Simpanan Wajib: ${besaran}</li>`
	            total_sub_transaction += parseInt(value.besaran)
            } else if (value.type == 'simpanan_sukarela') {
                sub_transaction += `<li>Simpanan Sukarela: ${besaran}</li>`
	            total_sub_transaction += parseInt(value.besaran)
            }
        })
        $('#sub_transaction').html(sub_transaction)
        $('#total_sub_transaction').html(rupiah(total_sub_transaction))
        $('#data').removeClass('hide')
        $('#loading_data').remove()
    } else {
        window.history.back()
    }
}).catch((err) => {
    // console.log(err.response)
    if (err.response.data.message == 'data not found') window.history.back()
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
		level == 'confirm' ? url = 'simpanan' : url = 'admin/simpanan/' + user
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
