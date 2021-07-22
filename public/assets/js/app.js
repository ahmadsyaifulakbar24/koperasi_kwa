axios.defaults.baseURL = 'https://localhost/koperasi_kwa/public/'
// axios.defaults.baseURL = 'https://koperasi.lekarlwig.com/'
axios.defaults.withCredentials = true

const session = JSON.parse(localStorage.getItem('session'))
if (session) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + session.token
    $('.name').html(session.name)
}

function get_pendidikan() {
    let append
    if (localStorage.getItem('pendidikan_id') == null) {
        axios.get('api/param/pendidikan').then((response) => {
            // console.log(response.data.data)
            let pendidikan_id = []
            $.each(response.data.data, function(index, value) {
                pendidikan_id[index] = {
                    id: value.id,
                    pendidikan: value.pendidikan
                }
                append = `<div class="form-check">
					<input class="form-check-input" type="radio" name="pendidikan_id" id="p${value.id}" value="${value.id}">
					<label class="form-check-label" for="p${value.id}" role="button">${value.pendidikan}</label>
				</div>`
                $('#pendidikan_id').append(append)
            })
            localStorage.setItem('pendidikan_id', JSON.stringify(pendidikan_id))
        }).catch((err) => {
            // console.log(err.response)
        })
    } else {
        let pendidikan_id = JSON.parse(localStorage.getItem('pendidikan_id'))
        $.each(pendidikan_id, function(index, value) {
            append = `<div class="form-check">
				<input class="form-check-input" type="radio" name="pendidikan_id" id="p${value.id}" value="${value.id}">
				<label class="form-check-label" for="p${value.id}" role="button">${value.pendidikan}</label>
			</div>`
            $('#pendidikan_id').append(append)
        })
    }
    get_jabatan()
}

function get_jabatan() {
    let append
    if (localStorage.getItem('pendidikan_id') == null) {
        axios.get('api/param/jabatan').then((response) => {
            // console.log(response.data.data)
            let jabatan_id = []
            $.each(response.data.data, function(index, value) {
                jabatan_id[index] = {
                    id: value.id,
                    jabatan: value.jabatan
                }
                append = `<div class="form-check">
					<input class="form-check-input" type="radio" name="jabatan_id" id="j${value.id}" value="${value.id}">
					<label class="form-check-label text-capitalize" for="j${value.id}" role="button">${value.jabatan}</label>
				</div>`
                $('#jabatan_id').append(append)
            })
            localStorage.setItem('jabatan_id', JSON.stringify(jabatan_id))
        }).catch((err) => {
            // console.log(err.response)
        })
    } else {
        let jabatan_id = JSON.parse(localStorage.getItem('jabatan_id'))
        $.each(jabatan_id, function(index, value) {
            append = `<div class="form-check">
				<input class="form-check-input" type="radio" name="jabatan_id" id="j${value.id}" value="${value.id}">
				<label class="form-check-label text-capitalize" for="j${value.id}" role="button">${value.jabatan}</label>
			</div>`
            $('#jabatan_id').append(append)
        })
    }
    get_status_keluarga()
}

function get_status_keluarga() {
    let append
    if (localStorage.getItem('pendidikan_id') == null) {
        axios.get('api/param/status_keluarga').then((response) => {
            // console.log(response.data.data)
            let status_keluarga_id = []
            $.each(response.data.data, function(index, value) {
                status_keluarga_id[index] = {
                    id: value.id,
                    status_keluarga: value.status_keluarga
                }
                append = `<div class="form-check">
					<input class="form-check-input" type="radio" name="status_keluarga_id" id="k${value.id}" value="${value.id}">
					<label class="form-check-label" for="k${value.id}" role="button">${value.status_keluarga}</label>
				</div>`
                $('#status_keluarga_id').append(append)
            })
            localStorage.setItem('status_keluarga_id', JSON.stringify(status_keluarga_id))
            if (document.URL.indexOf('daftar') <= 0) {
                get_user()
            } else {
                $('#data').removeClass('hide')
                $('#loading').remove()
            }
        }).catch((err) => {
            // console.log(err.response)
        })
    } else {
        let status_keluarga_id = JSON.parse(localStorage.getItem('status_keluarga_id'))
        $.each(status_keluarga_id, function(index, value) {
            append = `<div class="form-check">
				<input class="form-check-input" type="radio" name="status_keluarga_id" id="k${value.id}" value="${value.id}">
				<label class="form-check-label" for="k${value.id}" role="button">${value.status_keluarga}</label>
			</div>`
            $('#status_keluarga_id').append(append)
        })
        if (document.URL.indexOf('daftar') <= 0) {
            get_user()
        } else {
            $('#data').removeClass('hide')
            $('#loading').remove()
        }
    }
}

function customAlert(status, param) {
    let icon = ''
    switch (status) {
        case 'success':
            icon = '<i class="mdi mdi-18px mdi-check-circle text-success"></i>'
            break;
        case 'warning':
            icon = '<i class="mdi mdi-18px mdi-alert text-warning"></i>'
            break;
        case 'danger':
            icon = '<i class="mdi mdi-18px mdi-alert-circle text-danger"></i>'
            break;
        case 'trash':
            icon = '<i class="mdi mdi-18px mdi-trash-can-outline"></i>'
    }
    if ($('.customAlert').hasClass('active')) {
        $('.customAlert').removeClass('active')
        $('.customAlert').animate({ bottom: "-=120px" }, 150)
    }
    $('.customAlert').html(icon + param)
    $('.customAlert').addClass('active')
    $('.customAlert').animate({ bottom: "+=120px" }, 150)
    if (status != 'warning') {
        setTimeout(function() {
            $('.customAlert').removeClass('active')
            $('.customAlert').animate({ bottom: "-=120px" }, 150)
        }, 2500)
    }
}

function tanggal(date) {
    let d = date.substr(8, 2)
    let m = date.substr(5, 2)
    let y = date.substr(0, 4)
    if (d.toString().length < 2) d = '0' + d
    if (m.toString().length < 2) m = '0' + m
    return (d + '/' + m + '/' + y)
}

function addLoading(attr, param) {
    let path
    param == undefined ? path = 'path' : path = 'path-' + param
    let append = `<div class="loader loader-sm btn-loading">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="${path}" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="1"/>
		</svg>
	</div>`
    if (attr == undefined) {
        $('#submit').html(append)
        $('#submit').attr('disabled', true)
    } else {
        $(attr).html(append)
        $(attr).attr('disabled', true)
    }
}

function removeLoading(html, attr) {
    if (attr == undefined) {
        $('#submit').attr('disabled', false)
        $('#submit').html(html)
    } else {
        $(attr).attr('disabled', false)
        $(attr).html(html)
    }
}

function pagination(links, meta, path) {
    let current = meta.current_page
    let replace = path + '?page='

    let first = links.first.replace(replace, '')
    if (first != current) {
        $('#first').removeClass('disabled')
        $('#first').data('id', first)
    } else {
        $('#first').addClass('disabled')
    }

    if (links.prev != null) {
        $('#prev').removeClass('disabled')
        let prev = links.prev.replace(replace, '')
        $('#prev').data('id', prev)

        $('#prevCurrent').show()
        $('#prevCurrent span').html(prev)
        $('#prevCurrent').data('id', prev)

        let prevCurrentDouble = prev - 1
        if (prevCurrentDouble > 0) {
            $('#prevCurrentDouble').show()
            $('#prevCurrentDouble span').html(prevCurrentDouble)
            $('#prevCurrentDouble').data('id', prevCurrentDouble)
        } else {
            $('#prevCurrentDouble').hide()
        }
    } else {
        $('#prev').addClass('disabled')
        $('#prevCurrent').hide()
        $('#prevCurrentDouble').hide()
    }

    $('#current').addClass('active')
    $('#current span').html(current)

    if (links.next != null) {
        $('#next').removeClass('disabled')
        let next = links.next.replace(replace, '')
        $('#next').data('id', next)

        $('#nextCurrent').show()
        $('#nextCurrent span').html(next)
        $('#nextCurrent').data('id', next)

        let nextCurrentDouble = ++next
        if (nextCurrentDouble <= meta.last_page) {
            $('#nextCurrentDouble').show()
            $('#nextCurrentDouble span').html(nextCurrentDouble)
            $('#nextCurrentDouble').data('id', nextCurrentDouble)
        } else {
            $('#nextCurrentDouble').hide()
        }
    } else {
        $('#next').addClass('disabled')
        $('#nextCurrent').hide()
        $('#nextCurrentDouble').hide()
    }

    let last = links.last.replace(replace, '')
    if (last != current) {
        $('#last').removeClass('disabled')
        $('#last').data('id', last)
    } else {
        $('#last').addClass('disabled')
    }

    $('#pagination').removeClass('hide')
    $('#pagination-label').html(`Showing ${meta.from} to ${meta.to} of ${meta.total} entries`)
}

$('.page').click(function() {
    if (!$(this).is('.active, .disabled')) {
        let page = $(this).data('id')
        $('#pagination').addClass('hide')
        $('#loading_table').removeClass('hide')
        get_data(page)
    }
})

$('.page_transaction').click(function() {
    if (!$(this).is('.active, .disabled')) {
        let page = $(this).data('id')
        $('#pagination').addClass('hide')
        $('#loading_table').removeClass('hide')
        get_data(page, day, month, year, approved)
    }
})

function get_status(param) {
    let status
    switch (param) {
        case 'pending':
            status = '<span class="text-warning">Pending</span>'
            break;
        case 'approved':
            status = '<span class="text-primary">Disetujui</span>'
            break;
        case 'rejected':
            status = '<span class="text-danger">Ditolak</span>'
            break;
        case 'paid_off':
            status = '<span class="text-success">Lunas</span>'
            // break;
    }
    return status
}

function currentDate() {
	let d = new Date()
    let date = d.getDate()
	let month = d.getMonth() + 1
	let year = d.getFullYear()
	if (date < 10) date = '0' + date
	if (month < 10) month = '0' + month
	let maxDate = year + '-' + month + '-' + date
	let maxMonth = year + '-' + month
	$('input[type="date"]').attr('max', maxDate)
	$('input[type="month"]').attr('max', maxMonth)
	$('#date').val(maxDate)
	$('#month').val(maxMonth)
}

function returnDate() {
	let d = new Date()
    let date = d.getDate()
	let month = d.getMonth() + 1
	let year = d.getFullYear()
	if (date < 10) date = '0' + date
	return year + '-' + month + '-' + date
}

function bulan_tahun(month, year) {
    let bulan = []
    bulan['1'] = 'Januari'
    bulan['2'] = 'Februari'
    bulan['3'] = 'Maret'
    bulan['4'] = 'April'
    bulan['5'] = 'Mei'
    bulan['6'] = 'Juni'
    bulan['7'] = 'Juli'
    bulan['8'] = 'Agustus'
    bulan['9'] = 'September'
    bulan['10'] = 'Oktober'
    bulan['11'] = 'November'
    bulan['12'] = 'Desember'
    return `${bulan[month]} ${year}`
}

function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

$('#logout').click(function() {
    axios.post('api/auth/logout').then((response) => {
        localStorage.removeItem('session')
	    $.ajax({
	        url: root + 'session/logout',
	        type: 'GET',
	        success: function() {
		        location.href = root
	        }
	    })
    }).catch((err) => {
        console.log(err)
    })
})

$('#menu').click(function() {
    if (!$('.sidebar').hasClass('show')) {
        $('.sidebar').addClass('show')
        $('.sidebar').css('left', '0px')
        $('.overlay').show()
    } else {
        $('.sidebar').removeClass('show')
        $('.sidebar').css('left', '-230px')
        $('.overlay').hide()
    }
})

$('.overlay').click(function() {
    $('.sidebar').removeClass('show')
    $('.sidebar').css('left', '-230px')
    $(this).hide()
})

$('.password').click(function() {
    if ($(this).hasClass('mdi-eye')) {
        $(this).removeClass('mdi-eye')
        $(this).addClass('mdi-eye-off')
        if ($(this).data('id') == 'password') {
            $('#password').attr('type', 'password')
        } else if ($(this).data('id') == 'npassword') {
            $('#npassword').attr('type', 'password')
        } else {
            $('#cpassword').attr('type', 'password')
        }
    } else {
        $(this).addClass('mdi-eye')
        $(this).removeClass('mdi-eye-off')
        if ($(this).data('id') == 'password') {
            $('#password').attr('type', 'text')
        } else if ($(this).data('id') == 'npassword') {
            $('#npassword').attr('type', 'text')
        } else {
            $('#cpassword').attr('type', 'text')
        }
    }
})
