
<?php
ini_set('memory_limit', '999024M');
set_time_limit(0);
$ext = 09;
for ($i = 1000000; $i <= 3000000; $i++) {
	file_put_contents("1-1000000-3000000.vcf", "BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";;;
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
}
for ($i = 3000001; $i <= 5555555; $i++) {
	file_put_contents("2-3000001-5555555.vcf", "BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";;;
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
}
for ($i = 5555556; $i <= 8000000; $i++) {
	file_put_contents("3-5555556-8000000.vcf", "BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";;;
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
}
for ($i = 8000001; $i <= 9999999; $i++) {
	file_put_contents("4-8000001-9999999.vcf", "BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";;;
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
}
?>
