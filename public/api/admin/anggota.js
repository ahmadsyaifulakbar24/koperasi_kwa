get_pendidikan()

function get_user() {
    axios.get('api/user/' + id).then((response) => {
        let value = response.data.data
        // console.log(value)
        $('title').prepend(value.name)
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
        $('#data').removeClass('hide')
        $('#loading').remove()
    }).catch((err) => {
        // console.log(err.response)
    })
}

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

    axios.post('api/user/update/' + id, formData).then((response) => {
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
