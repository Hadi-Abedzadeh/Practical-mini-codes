<?php
ini_set('memory_limit', '999024M');
set_time_limit(0);
	$ext = array(
			//Irancell
				0930,
				0933,
				0935,
				0936,
				0937,
				0938,
				0939,
			//HamrahAval
				0910,
				0919,
			
			//add area code number
				);
foreach($ext as $ext){
for ($i = 1000000; $i <= 9999999; $i++) {
    if ($i <= 3000000) {
        file_put_contents('1'$ext.".vcf", 
"
BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
        
    } else if ($i >= 5555555) {
		file_put_contents('2'.$ext.'.vcf', 
"
BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
        
    } else if ($i <= 8000000) {
		file_put_contents('3'.$ext.'.vcf', 
"
BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
			
    } else if ($i <= 9999999) {
        file_put_contents('4'.$ext.'.vcf', 
"
BEGIN:VCARD
VERSION:2.1
N:;$ext" . $i . ";
FN:
TEL;CELL:$ext" . $i . "
END:VCARD\n\n", FILE_APPEND);
    }
}
}
?>
