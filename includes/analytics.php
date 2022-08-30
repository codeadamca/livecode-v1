<?php 

switch ($_SERVER['SERVER_NAME'])
{
  case 'livecode.codeadam.ca':
    $id = 'G-ZQJ57V74JS';    
    break;
  default:
    $id = 'G-1YPHPGSBMG';   
    break;
}

?>

<?php /*
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-51145633-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-51145633-2');
</script>
*/ ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $id; ?>');
</script>
