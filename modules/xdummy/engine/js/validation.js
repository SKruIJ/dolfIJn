<?php

/****************************************
dolfIJn
SKruIJ 2018-11-30
/modules/xdummy/engine/js/validation.js
validation js library // optional / for specific jQuery validation rules
ü
*****************************************/

echo "
<script>
   jQuery.validator.addMethod(
      \"isAlter\",
      function(value, element) {
         return this.optional( element ) || /^[0-9]+$/.test( value );
      },
	  \"" . MOD_VAL_ISALTER . "\"
   );
</script>
";

?>