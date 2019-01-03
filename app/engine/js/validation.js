<?php

/****************************************
dolfIJn
SKruIJ 2017-01-27
/app/engine/js/validation.js
validation js library // optional / for specific jQuery validation rules
ü
*****************************************/


// allow any non-whitespace characters as the host part
echo "
<script>
   jQuery.validator.addMethod(
      \"isAirbusEmail\",
      function(value, element) {
         return this.optional( element ) || /^[a-zA-Z0-9._%+-]+@airbus.com$/.test( value );
      },
	  \"" . APP_VAL_ISAIRBUSEMAIL . "\"
   );
</script>
";



?>



