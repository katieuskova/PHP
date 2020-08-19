<pre>
<?php

if (($handle = fopen("users.csv", "r")) !== FALSE) { 
	while(($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		$list[] = $data;
    };
fclose($handle);

$newUsers = [];
$head = $list[0];

foreach ($list as $string) {

    if(preg_match('/(^[a-z0-9]+[a-z0-9.-]*[a-z0-9]+@[a-z0-9.-]+\.[a-z]{2,}$)/', $string[1])){

        if(preg_match('/(^([А-ЯЁ][а-яёА-ЯЁ]*)\s([А-ЯЁ][а-яёА-ЯЁ]*)\s([а-яёА-ЯЁ]*)$)|(([А-ЯЁ][а-яё]*)\s([А-ЯЁ][а-яё]*))|(^[а-яёА-ЯЁ]{10,}$)/', $string[2])){

            if(preg_match('/[0-9]{10,12}/', $string[3])) {
                $string[2] = mb_convert_case($string[2], MB_CASE_TITLE, "UTF-8");
                $string[3] = preg_replace('/^([8])(\d{3})(\d{3})(\d{2})(\d{2})$/', '$1-$2-$3-$4-$5', preg_replace('/^(\+79|79|89|98|9)(\d{9})$/', '89$2', $string[3]));
                array_push($newUsers,$string);  
            };
        };
    };
};

$handle = fopen('newUsers.csv', 'w'); 
array_unshift($newUsers,$head); 

foreach ($newUsers as $line)
    fputcsv($handle, $line,';');
};
    
    fclose($handle);
?>
</pre>
