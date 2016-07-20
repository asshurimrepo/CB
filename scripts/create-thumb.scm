(define (create-thumb inFile)
	(let*
		(
			(outFile "../out/thumb.png")
			(image (car (gimp-file-load RUN-NONINTERACTIVE inFile inFile) ) )
			(drawable (car (gimp-image-get-active-layer image) ) )
			(blackColor '(0 0 0) )
			(imh (car (gimp-image-height image) ) )
			(imw (car (gimp-image-width image) ) )
			(width 400)
			(vstep 0)
			(hstep 0)
			(va 12)
			(vb 12)
			(vc 12)
			(vd 12)
			(ve 12)
			(ha 12)
			(hb 12)
			(hc 12)
			(hd 12)
			(he 12)
			(thrsh 22)
			(pickColor '(0 0 0) )
			(scale 1)
		)
		
		(gimp-message inFile)
		(gimp-image-undo-disable image)
		
		(set! hstep (floor (/ imw 4) ) )
		(set! vstep (floor (/ imh 4) ) )
		(set! va 12)
		(set! vb vstep)
		(set! vc (* vstep 2) )
		(set! vd (* vstep 3) )
		(set! ve (- imh 12) )
		(set! ha 12)
		(set! hb hstep)
		(set! hc (* hstep 2) )
		(set! hd (* hstep 3) )
		(set! he (- imw 12) )

		(set! pickColor (car (gimp-image-pick-color image drawable ha ve TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable ha vd TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable ha vc TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable ha vb TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable ha va TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable hb va TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable hc va TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable hd va TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable he va TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable he vb TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable he vc TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable he vd TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		(set! pickColor (car (gimp-image-pick-color image drawable he ve TRUE FALSE 0) ) )
		(gimp-by-color-select drawable pickColor thrsh CHANNEL-OP-ADD TRUE FALSE 0 FALSE)
		
		(gimp-selection-grow image 2)
		(gimp-selection-feather image 4)
		
		(gimp-layer-add-alpha (car (gimp-image-get-active-layer image) ) )
		(gimp-edit-clear drawable)
		(gimp-selection-none image)
		
		(set! scale (/ width imw) )
		(gimp-image-scale image (floor (* imw scale) ) (floor (* imh scale) ) )
		
		(gimp-file-save RUN-NONINTERACTIVE image drawable outFile outFile)
		(gimp-image-delete image)
	)
)
