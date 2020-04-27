<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head></head><body>
	<p>
		{{ $Name }}先生<br />
		いつも大変お世話になっております。
		{Topic}の査読依頼をさせていただければと思います。
		以下のリンクより、ご確認してくださいませ。<br><br>
		@foreach($Link as $key => $value)
		@php
			$no = $key + 1;
		@endphp
		    {{ $no }}: <a href="{{ $value }}">{{ $value }}</a><br>
		@endforeach
	</p>
</body></html>