$('.mdi-check-all').click(function(){
	if($(this).hasClass('mdi-minus-box')){
		$('.mdi-check').addClass('mdi-checkbox-blank-outline')
		$('.mdi-check').removeClass('mdi-checkbox-marked')
		$(this).removeClass('mdi-minus-box')
		$(this).addClass('mdi-checkbox-blank-outline')
		$('.mdi-trash-all').hide()
	}
	else if($(this).hasClass('mdi-checkbox-blank-outline')){
		$('.mdi-check').removeClass('mdi-checkbox-blank-outline')
		$('.mdi-check').addClass('mdi-checkbox-marked')
		$(this).removeClass('mdi-checkbox-blank-outline')
		$(this).addClass('mdi-checkbox-marked')
		$('.mdi-trash-all').show()
	}
	else if($(this).hasClass('mdi-checkbox-marked')){
		$('.mdi-check').addClass('mdi-checkbox-blank-outline')
		$('.mdi-check').removeClass('mdi-checkbox-marked')
		$(this).removeClass('mdi-checkbox-marked')
		$(this).addClass('mdi-checkbox-blank-outline')
		$('.mdi-trash-all').hide()
	}
})
$(document).on('click','.mdi-check',function(){
	$(this).toggleClass('mdi-checkbox-blank-outline')
	$(this).toggleClass('mdi-checkbox-marked')
	if($('.mdi-check').hasClass('mdi-checkbox-marked')){
		$('.mdi-check-all').addClass('mdi-minus-box')
		$('.mdi-check-all').removeClass('mdi-checkbox-marked')
		$('.mdi-check-all').removeClass('mdi-checkbox-blank-outline')
		$('.mdi-trash-all').show()
	}
	else if(!$('.mdi-check').hasClass('mdi-checkbox-marked')){
		$('.mdi-check-all').removeClass('mdi-minus-box')
		$('.mdi-check-all').removeClass('mdi-checkbox-marked')
		$('.mdi-check-all').addClass('mdi-checkbox-blank-outline')
		$('.mdi-trash-all').hide()
		}
	if(!$('.mdi-check').hasClass('mdi-checkbox-blank-outline')){
		$('.mdi-check-all').removeClass('mdi-minus-box')
		$('.mdi-check-all').addClass('mdi-checkbox-marked')
		$('.mdi-check-all').removeClass('mdi-checkbox-blank-outline')
		$('.mdi-trash-all').show()
	}
})