<?php

/****************************************
dolfIJn
SKruIJ 2018-11-30
/engine/js/validation.js
core validation js library // for additional core validation rules
ü
*****************************************/


// chechbox is checked
echo "
<script>
   jQuery.validator.addMethod(
      \"isChecked\",
      function(value, element) {
         return this.getLength( value, element ) > 0;
      },
	  \"" . DLF_VALIDATION_CHECKED . "\"
   );
</script>
";

// radio button is selected
echo "
<script>
   jQuery.validator.addMethod(
      \"isRadioSelected\",
      function(value, element) {
         return this.getLength( value, element ) > 0;
      },
	  \"" . DLF_VALIDATION_SELECTED . "\"
   );
</script>
";

// allow any non-whitespace characters as the host part
echo "
<script>
   jQuery.validator.addMethod(
      \"isEmail\",
      function(value, element) {
         return this.optional( element ) || /^[a-zA-Z0-9._%+-]+@+[a-zA-Z0-9._%+-]+$/.test( value );
      },
	  \"" . DLF_VALIDATION_ISEMAIL . "\"
   );
</script>
";


?>
