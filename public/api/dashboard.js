get_pendidikan()

function get_user() {
    axios.get('api/user/' + session.user_id).then((response) => {
        let value = response.data.data
        // console.log(value)
        $('#name').val(value.name)
        $('#no_id').val(value.no_id)
        $('#code').val(value.code)
        $('input[name=jenis_kelamin]').filter(`[value=${value.jenis_kelamin}]`).prop('checked', true)
        $('#tempat_lahir').val(value.tempat_lahir)
        $('#tanggal_lahir').val(value.tanggal_lahir)
        $('#alamat').val(value.alamat)
        $('#no_telp').val('0' + value.no_telp)
        $('input[name=pendidikan_id]').filter(`[value=${value.pendidikan.id}]`).prop('checked', true)
        if (value.user_koperasi_detail) {
            $('input[name=jabatan_id]').filter(`[value=${value.jabatan.id}]`).prop('checked', true)
            $('input[name=status_keluarga_id]').filter(`[value=${value.user_koperasi_detail.status_keluarga.id}]`).prop('checked', true)
            $('#nama_ahliwaris').val(value.user_koperasi_detail.nama_ahliwaris)
            $('input[name=besar_simpanan_wajib]').filter(`[value=${value.user_koperasi_detail.bersar_simpanan_wajib}]`).prop('checked', true)
            $('#ktp').attr('src', value.user_koperasi_detail.upload_ktp)
        }
        $('#username').val(value.username)
        $('#email').val(value.email)
        $('#biodata').removeClass('hide')
        $('#loading-biodata').remove()
    }).catch((err) => {
        // console.log(err.response)
    })
}

let balance = 0

main_setting()

function main_setting() {
    axios.get('api/main_setting').then((response) => {
        let value = response.data.data
        balance = value.saldo
        let saldo = rupiah(value.saldo)
        let stripe_saldo = value.saldo.substr(0, 1)
        if (stripe_saldo == '-') {
            saldo = stripe_saldo + rupiah(value.saldo.substr(1))
            $('#saldo').addClass('text-danger')
        }
        $('#saldo').html(saldo)

        let debit = rupiah(value.total_debit)
        let stripe_debit = String(value.total_debit).substr(0, 1)
        if (stripe_debit == '-') {
            debit = stripe_debit + rupiah(value.total_debit.substr(1))
            $('#debit').addClass('text-danger')
        }
        $('#debit').html(debit)

        let kredit = rupiah(value.total_kredit)
        let stripe_kredit = String(value.total_kredit).substr(0, 1)
        if (stripe_kredit == '-') {
            kredit = stripe_kredit + rupiah(value.total_kredit.substr(1))
            $('#kredit').addClass('text-danger')
        }
        $('#kredit').html(kredit)
    }).catch((err) => {
        // console.log(err.response)
    })
}

$('#download_debit').click(function() {
    if (!$(this).hasClass('active')) {
        $(this).addClass('active')
        $('#text_debit').addClass('hide')
        $('#loading_debit').removeClass('hide')
        axios.get('api/transaction/report', {
            params: {
                from: '2021-01-01',
                to: returnDate()
            }
        }).then((response) => {
            let value = response.data
            // console.log(value)
		    let kas = rupiah(value.saldo_koperasi)
		    let stripe_saldo = value.saldo_koperasi.substr(0, 1)
		    if (stripe_saldo == '-') {
		        kas = stripe_saldo + rupiah(value.saldo_koperasi.substr(1))
		    }
            let append = `<tr>
	        	<td colspan="2">TOTAL KAS SAAT INI</td>
	        	<td>${kas}</td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        </tr>
	        <tr>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td>${rupiah(value.total_debit)}</td>
	        </tr>
	        <tr>
	        	<th>TANGGAL</th>
	        	<th>NAMA NASABAH</th>
	        	<th>NIK</th>
	        	<th>SIMPANAN WAJIB</th>
	        	<th>SIMPANAN SUKARELA</th>
	        	<th>CICILAN</th>
	        	<th>SIMPANAN POKOK</th>
	        	<th>LAIN-LAIN</th>
	        	<th>JUMLAH</th>
	        </tr>`
            $.each(value.transaction, function(index, value) {
                append += `<tr>
	        		<td>${tanggal(value.date)}</td>
	        		<td>${value.name}</td>
	        		<td>'${value.nik}</td>
	        		<td>${value.sub_transaction.simpanan_wajib != null ? rupiah(value.sub_transaction.simpanan_wajib) : ''}</td>
	        		<td>${value.sub_transaction.simpanan_sukarela != null ? rupiah(value.sub_transaction.simpanan_sukarela) : ''}</td>
	        		<td>${value.sub_transaction.cicilan != null ? rupiah(value.sub_transaction.cicilan) : ''}</td>
	        		<td>${value.sub_transaction.simpanan_pokok != null ? rupiah(value.sub_transaction.simpanan_pokok) : ''}</td>
	        		<td>${value.sub_transaction.saldo_koperasi != null ? rupiah(value.sub_transaction.saldo_koperasi) : ''}</td>
	        		<td>${value.sub_transaction.total != null ? rupiah(value.sub_transaction.total) : ''}</td>
	        	</tr>`
            })
            $(this).removeClass('active')
            $('#text_debit').removeClass('hide')
            $('#loading_debit').addClass('hide')
            $('#table_debit').html(append)
            exportTableToExcel('table_debit', 'Unduh Debit')
        }).catch((err) => {
            // console.log(err)
        })
    }
})

$('#download_kredit').click(function() {
    if (!$(this).hasClass('active')) {
        $(this).addClass('active')
        $('#text_kredit').addClass('hide')
        $('#loading_kredit').removeClass('hide')
        axios.get('api/pinjaman/report', {
            params: {
                from: '2021-01-01',
                to: returnDate()
            }
        }).then((response) => {
            let value = response.data
            // console.log(value)
            let append = `<tr>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        	<td>${rupiah(value.total_kredit)}</td>
	        	<td></td>
	        	<td></td>
	        	<td></td>
	        </tr>
	        <tr>
	        	<th>TANGGAL</th>
	        	<th>NAMA NASABAH</th>
	        	<th>NIK</th>
	        	<th>JENIS TRANSAKSI</th>
	        	<th>TENOR (BULAN)</th>
	        	<th>STATUS</th>
	        	<th>JUMLAH</th>
	        	<th>SUKU BUNGA (2%)</th>
	        	<th>SETORAN/BULAN</th>
	        	<th>KETERANGAN</th>
	        </tr>`
            $.each(value.pinjaman, function(index, value) {
                append += `<tr>
        		<td>${tanggal(value.date)}</td>
        		<td>${value.name}</td>
        		<td>'${value.nik}</td>
        		<td>${value.jenis_transaksi}</td>
        		<td>${value.tenor}</td>
        		<td>Approve</td>
        		<td>${rupiah(value.jumlah)}</td>
        		<td>${rupiah(value.bunga)}</td>
        		<td>${rupiah(value.setoran_per_bulan)}</td>
        		<td>${value.keterangan}</td>
        	</tr>`
            })
	        $(this).removeClass('active')
            $('#table_kredit').html(append)
            $('#text_kredit').removeClass('hide')
            $('#loading_kredit').addClass('hide')
            exportTableToExcel('table_kredit', 'Unduh Kredit')
        }).catch((err) => {
            // console.log(err)
        })
    }
})

$('#modal-add').on('shown.bs.modal', function(e) {
    $('#besaran').focus()
})
$('#besaran').keyup(function() {
    $(this).val(convert($(this).val()))
})

$('#add_saldo').submit(function(e) {
    e.preventDefault()
    $('#add').attr('disabled', true)
    let formData = new FormData()
    formData.append('besaran', number($('#besaran').val()))
    axios.post('api/main_setting/add_saldo_koperasi', formData).then((response) => {
        // console.log(response)
        $('#add').attr('disabled', false)
        $('#modal-add').modal('hide')
        customAlert('success', 'Saldo berhasil ditambah')
        main_setting()
    }).catch((xhr) => {
        $('#add').attr('disabled', false)
        let err = xhr.response.data.errors
        // console.clear()
        console.log(xhr.response)
        if (err.besaran) {
            $('#besaran').addClass('is-invalid')
            $('#besaran-feedback').html('Masukkan jumlah saldo yang ingin ditambah')
        }
    })
})

$('#modal-add').on('hidden.bs.modal', function(e) {
    $('#besaran').val('')

    $('#besaran').removeClass('is-invalid')
    $('#besaran-feedback').html('')
})

// Min Saldo Koperasi
    $('#modal-min').on('shown.bs.modal', function(e) {
        $('#minSaldo').focus()
    })
    $('#minSaldo').keyup(function() {
        $(this).val(convert($(this).val()))
    })

    $('#modal-min').on('hidden.bs.modal', function(e) {
        $('#minSaldo').val('')

        $('#minSaldo').removeClass('is-invalid')
        $('#minSaldo-feedback').html('')

        $('#description').removeClass('is-invalid')
        $('#description-feedback').html('')
    })

    $('#min_saldo').submit(function(e) {
        e.preventDefault()
        $('#min').attr('disabled', true)
        let formData = new FormData()
        formData.append('transaction_type', 'min_admin')
        formData.append('total', number($('#minSaldo').val()))
        formData.append('description', $('#description').val())
        axios.post('api/main_setting/min_saldo_koperasi', formData).then((response) => {
            // console.log(response)
            $('#min').attr('disabled', false)
            $('#modal-min').modal('hide')
            customAlert('success', 'Saldo berhasil dikurangi')
            main_setting()
        }).catch((xhr) => {
            $('#min').attr('disabled', false)
            let err = xhr.response.data.errors
            // console.clear()
            console.log(xhr.response)
            if (err.total) {
                $('#minSaldo').addClass('is-invalid')
                $('#minSaldo-feedback').html('Masukkan jumlah saldo yang ingin dikurangi')
            }

            if (err.description) {
                $('#description').addClass('is-invalid')
                $('#description-feedback').html('Masukan keterangan')
            }
        })
    })
// End Min Saldo Koperasi
$('#form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    let name = $('#name').val()
    let jenis_kelamin = $('input[type=radio][name=jenis_kelamin]:checked').val()
    let tempat_lahir = $('#tempat_lahir').val()
    let tanggal_lahir = $('#tanggal_lahir').val()
    let alamat = $('#alamat').val()
    let no_telp = $('#no_telp').val()
    let pendidikan_id = $('input[type=radio][name=pendidikan_id]:checked').val()
    let jabatan_id = $('input[type=radio][name=jabatan_id]:checked').val()
    let status_keluarga_id = $('input[type=radio][name=status_keluarga_id]:checked').val()
    let nama_ahliwaris = $('#nama_ahliwaris').val()
    let besar_simpanan_wajib = $('input[type=radio][name=besar_simpanan_wajib]:checked').val()

    let formData = new FormData
    formData.append('name', name)
    formData.append('jenis_kelamin', jenis_kelamin)
    formData.append('tempat_lahir', tempat_lahir)
    formData.append('tanggal_lahir', tanggal_lahir)
    formData.append('alamat', alamat)
    formData.append('no_telp', no_telp)
    formData.append('pendidikan_id', pendidikan_id)
    formData.append('jabatan_id', jabatan_id)
    formData.append('status_keluarga_id', status_keluarga_id)
    formData.append('nama_ahliwaris', nama_ahliwaris)
    formData.append('besar_simpanan_wajib', besar_simpanan_wajib)

    axios.post('api/user/update/' + session.user_id, formData).then((response) => {
        // console.log(response)
        customAlert('success', 'Profil berhasil disimpan')
        removeLoading('Simpan')
    }).catch((xhr) => {
        let err = xhr.response.data.errors
        // console.clear()
        console.log(xhr)
        if (err.name) {
            $('#name').addClass('is-invalid')
            $('#name-feedback').html('Masukkan nama lengkap')
        }
        if (err.jenis_kelamin) {
            $('#jenis_kelamin').addClass('is-invalid')
            $('#jenis_kelamin-feedback').html('Pilih jenis kelamin')
        }
        if (err.tempat_lahir) {
            $('#tempat_lahir').addClass('is-invalid')
            $('#tempat_lahir-feedback').html('Masukkan tempat lahir')
        }
        if (err.tanggal_lahir) {
            $('#tanggal_lahir').addClass('is-invalid')
            $('#tanggal_lahir-feedback').html('Pilih tanggal lahir')
        }
        if (err.alamat) {
            $('#alamat').addClass('is-invalid')
            $('#alamat-feedback').html('Masukkan alamat lengkap')
        }
        if (err.no_telp) {
            if (err.no_telp == "The no telp field is required.") {
                $('#no_telp').addClass('is-invalid')
                $('#no_telp-feedback').html('Masukkan nomor telepon')
            } else if (err.no_telp == "The no telp has already been taken.") {
                $('#no_telp').addClass('is-invalid')
                $('#no_telp-feedback').html('Nomor telepon telah digunakan')
            }
        }
        if (err.pendidikan_id) {
            $('#pendidikan_id').addClass('is-invalid')
            $('#pendidikan_id-feedback').html('Pilih pendidikan terakhir')
        }
        if (err.jabatan_id) {
            $('#jabatan_id').addClass('is-invalid')
            $('#jabatan_id-feedback').html('Pilih jabatan')
        }
        if (err.status_keluarga_id) {
            $('#status_keluarga_id').addClass('is-invalid')
            $('#status_keluarga_id-feedback').html('Pilih status dalam keluarga')
        }
        if (err.nama_ahliwaris) {
            $('#nama_ahliwaris').addClass('is-invalid')
            $('#nama_ahliwaris-feedback').html('Masukkan nama ahli waris')
        }
        if (err.besar_simpanan_wajib) {
            $('#besar_simpanan_wajib').addClass('is-invalid')
            $('#besar_simpanan_wajib-feedback').html('Pilih besaran simpanan wajib')
        }
        removeLoading('Simpan')
    })
})
