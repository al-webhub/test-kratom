<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="margin:0; padding:0;  font: 16px Arial,sans-serif; line-height: 24px; color: #333333;">
<style>
@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>

<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; padding:0px 0px 30px; max-width: 600px; width: 100%; font: 16px Arial,sans-serif; line-height: 24px; color: #333333;">
	@component('mail::header')
		{!! $header ?? '' !!}
	@endcomponent
	
	{{ $slot }}
	
	@component('mail::footer')
	@endcomponent
</table>

</body>
</html>
