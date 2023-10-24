

<?php
// pag 3
require_once 'app/Core/Core.php';

require_once 'lib/Database/Conexao.php';

require_once 'app/Controller/HomeController.php';

require_once 'app/Controller/ErroController.php';

require_once 'app/Controller/PostController.php';

require_once 'app/Controller/SobreController.php';

require_once 'app/Controller/AdminController.php';

require_once 'app/Model/Postagem.php';

require_once 'app/Model/Comentario.php';

require_once 'vendor/autoload.php';

//Link do site: http://localhost/xampp/Site_MVC_PHP/
//Link de teste Página Home: http://localhost/xampp/Site_MVC_PHP/?pagina=home
$template = file_get_contents('app/Template/estrutura.html');
//var_dump($template);

ob_start();

    $core = new Core;
    $core->Start($_GET);

    $saida = ob_get_contents();

    ob_end_clean();

    //var_dump($saida);

    $tpl_pronto = str_replace('{{area_dinamica}}', $saida , $template);
    echo($tpl_pronto);

//echo $template;
?>