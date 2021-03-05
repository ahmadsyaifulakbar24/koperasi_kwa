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