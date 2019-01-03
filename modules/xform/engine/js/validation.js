<?php

/****************************************
dolfIJn
SKruIJ 2018-11-30
/modules/xform/engine/js/validation.js
validation js library // optional / for specific jQuery validation rules
ü
*****************************************/


// allow any non-whitespace characters as the host part
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

echo "
<script>
   jQuery.validator.addMethod(
      \"isCheckedNews1\",
      function(value, element) {
         return this.getLength( value, element ) > 0;
      },
	  \"" . MOD_VAL_CHECKEDNEWS1 . "\"
   );
</script>
";


?>
