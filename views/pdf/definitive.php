<?php 
    $this->layout = 'nolayout-pdf'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opp = $app->view->jsObject['opp'];
    $verifyResource = \PDFReport\Entities\Pdf::verifyResource($this->postData['idopportunityReport']);
    $claimDisabled = $app->view->jsObject['claimDisabled'];
    include_once('header-pdf.php'); 
?>
<main>
    <div class="container">
        <div class="pre-text">Resultado definitivo do certame</div>
        <div class="opportunity-info">
            <p class="text-opp">Oportunidade</p>
            <h4 class="opp-name-relatorio"><?php echo $nameOpportunity ?></h4>
        </div>
    </div>
    <?php 
        //REDIRECIONA PARA OPORTUNIDADE CASO NÃO HAJA CATEGORIA        
        $type = $opp->evaluationMethodConfiguration->type->id;
        //NAO TEM RECURSO OU DESABILITADO
        if(empty($claimDisabled) || $claimDisabled == 1) {
            // nao tem categoria, tecnica e nao tem recurso 
            if($opp->registrationCategories == "" &&  ($type == 'technical' || $type == 'technicalna' || $type == 'homolog')){
                $preliminary = false;
                include_once('technical-no-category.php');
            }elseif($opp->registrationCategories == "" &&  $type == 'simple'|| $type == 'documentary' || $type == 'homolog'){
                $preliminary = false;
                include_once('simple-documentary-no-category.php');
            }elseif($opp->registrationCategories !== "" &&  $type == 'technical' || $type == 'technicalna' || $type == 'homolog' ){
                $preliminary = false;
                include_once('technical-category.php');
            }elseif($opp->registrationCategories !== "" &&  $type == 'simple' || $type == 'documentary' || $type == 'homolog'){
                $preliminary = false;
                include_once('simple-documentary-category.php');
            }
        }

    ?>
</main>
